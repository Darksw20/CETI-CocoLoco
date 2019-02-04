/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controladores;

import Controladores.exceptions.IllegalOrphanException;
import Controladores.exceptions.NonexistentEntityException;
import Controladores.exceptions.RollbackFailureException;
import entities.Stocktaking;
import java.io.Serializable;
import javax.persistence.Query;
import javax.persistence.EntityNotFoundException;
import javax.persistence.criteria.CriteriaQuery;
import javax.persistence.criteria.Root;
import entities.User;
import entities.Transaction;
import java.util.ArrayList;
import java.util.List;
import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.transaction.UserTransaction;

/**
 *
 * @author berserker
 */
public class StocktakingJpaController implements Serializable {

    public StocktakingJpaController(UserTransaction utx, EntityManagerFactory emf) {
        this.utx = utx;
        this.emf = emf;
    }
    private UserTransaction utx = null;
    private EntityManagerFactory emf = null;

    public EntityManager getEntityManager() {
        return emf.createEntityManager();
    }

    public void create(Stocktaking stocktaking) throws RollbackFailureException, Exception {
        if (stocktaking.getTransactionList() == null) {
            stocktaking.setTransactionList(new ArrayList<Transaction>());
        }
        EntityManager em = null;
        try {
            utx.begin();
            em = getEntityManager();
            User userUserName = stocktaking.getUserUserName();
            if (userUserName != null) {
                userUserName = em.getReference(userUserName.getClass(), userUserName.getUserName());
                stocktaking.setUserUserName(userUserName);
            }
            List<Transaction> attachedTransactionList = new ArrayList<Transaction>();
            for (Transaction transactionListTransactionToAttach : stocktaking.getTransactionList()) {
                transactionListTransactionToAttach = em.getReference(transactionListTransactionToAttach.getClass(), transactionListTransactionToAttach.getFolio());
                attachedTransactionList.add(transactionListTransactionToAttach);
            }
            stocktaking.setTransactionList(attachedTransactionList);
            em.persist(stocktaking);
            if (userUserName != null) {
                userUserName.getStocktakingList().add(stocktaking);
                userUserName = em.merge(userUserName);
            }
            for (Transaction transactionListTransaction : stocktaking.getTransactionList()) {
                Stocktaking oldStocktakingIDOfTransactionListTransaction = transactionListTransaction.getStocktakingID();
                transactionListTransaction.setStocktakingID(stocktaking);
                transactionListTransaction = em.merge(transactionListTransaction);
                if (oldStocktakingIDOfTransactionListTransaction != null) {
                    oldStocktakingIDOfTransactionListTransaction.getTransactionList().remove(transactionListTransaction);
                    oldStocktakingIDOfTransactionListTransaction = em.merge(oldStocktakingIDOfTransactionListTransaction);
                }
            }
            utx.commit();
        } catch (Exception ex) {
            try {
                utx.rollback();
            } catch (Exception re) {
                throw new RollbackFailureException("An error occurred attempting to roll back the transaction.", re);
            }
            throw ex;
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void edit(Stocktaking stocktaking) throws IllegalOrphanException, NonexistentEntityException, RollbackFailureException, Exception {
        EntityManager em = null;
        try {
            utx.begin();
            em = getEntityManager();
            Stocktaking persistentStocktaking = em.find(Stocktaking.class, stocktaking.getId());
            User userUserNameOld = persistentStocktaking.getUserUserName();
            User userUserNameNew = stocktaking.getUserUserName();
            List<Transaction> transactionListOld = persistentStocktaking.getTransactionList();
            List<Transaction> transactionListNew = stocktaking.getTransactionList();
            List<String> illegalOrphanMessages = null;
            for (Transaction transactionListOldTransaction : transactionListOld) {
                if (!transactionListNew.contains(transactionListOldTransaction)) {
                    if (illegalOrphanMessages == null) {
                        illegalOrphanMessages = new ArrayList<String>();
                    }
                    illegalOrphanMessages.add("You must retain Transaction " + transactionListOldTransaction + " since its stocktakingID field is not nullable.");
                }
            }
            if (illegalOrphanMessages != null) {
                throw new IllegalOrphanException(illegalOrphanMessages);
            }
            if (userUserNameNew != null) {
                userUserNameNew = em.getReference(userUserNameNew.getClass(), userUserNameNew.getUserName());
                stocktaking.setUserUserName(userUserNameNew);
            }
            List<Transaction> attachedTransactionListNew = new ArrayList<Transaction>();
            for (Transaction transactionListNewTransactionToAttach : transactionListNew) {
                transactionListNewTransactionToAttach = em.getReference(transactionListNewTransactionToAttach.getClass(), transactionListNewTransactionToAttach.getFolio());
                attachedTransactionListNew.add(transactionListNewTransactionToAttach);
            }
            transactionListNew = attachedTransactionListNew;
            stocktaking.setTransactionList(transactionListNew);
            stocktaking = em.merge(stocktaking);
            if (userUserNameOld != null && !userUserNameOld.equals(userUserNameNew)) {
                userUserNameOld.getStocktakingList().remove(stocktaking);
                userUserNameOld = em.merge(userUserNameOld);
            }
            if (userUserNameNew != null && !userUserNameNew.equals(userUserNameOld)) {
                userUserNameNew.getStocktakingList().add(stocktaking);
                userUserNameNew = em.merge(userUserNameNew);
            }
            for (Transaction transactionListNewTransaction : transactionListNew) {
                if (!transactionListOld.contains(transactionListNewTransaction)) {
                    Stocktaking oldStocktakingIDOfTransactionListNewTransaction = transactionListNewTransaction.getStocktakingID();
                    transactionListNewTransaction.setStocktakingID(stocktaking);
                    transactionListNewTransaction = em.merge(transactionListNewTransaction);
                    if (oldStocktakingIDOfTransactionListNewTransaction != null && !oldStocktakingIDOfTransactionListNewTransaction.equals(stocktaking)) {
                        oldStocktakingIDOfTransactionListNewTransaction.getTransactionList().remove(transactionListNewTransaction);
                        oldStocktakingIDOfTransactionListNewTransaction = em.merge(oldStocktakingIDOfTransactionListNewTransaction);
                    }
                }
            }
            utx.commit();
        } catch (Exception ex) {
            try {
                utx.rollback();
            } catch (Exception re) {
                throw new RollbackFailureException("An error occurred attempting to roll back the transaction.", re);
            }
            String msg = ex.getLocalizedMessage();
            if (msg == null || msg.length() == 0) {
                Integer id = stocktaking.getId();
                if (findStocktaking(id) == null) {
                    throw new NonexistentEntityException("The stocktaking with id " + id + " no longer exists.");
                }
            }
            throw ex;
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void destroy(Integer id) throws IllegalOrphanException, NonexistentEntityException, RollbackFailureException, Exception {
        EntityManager em = null;
        try {
            utx.begin();
            em = getEntityManager();
            Stocktaking stocktaking;
            try {
                stocktaking = em.getReference(Stocktaking.class, id);
                stocktaking.getId();
            } catch (EntityNotFoundException enfe) {
                throw new NonexistentEntityException("The stocktaking with id " + id + " no longer exists.", enfe);
            }
            List<String> illegalOrphanMessages = null;
            List<Transaction> transactionListOrphanCheck = stocktaking.getTransactionList();
            for (Transaction transactionListOrphanCheckTransaction : transactionListOrphanCheck) {
                if (illegalOrphanMessages == null) {
                    illegalOrphanMessages = new ArrayList<String>();
                }
                illegalOrphanMessages.add("This Stocktaking (" + stocktaking + ") cannot be destroyed since the Transaction " + transactionListOrphanCheckTransaction + " in its transactionList field has a non-nullable stocktakingID field.");
            }
            if (illegalOrphanMessages != null) {
                throw new IllegalOrphanException(illegalOrphanMessages);
            }
            User userUserName = stocktaking.getUserUserName();
            if (userUserName != null) {
                userUserName.getStocktakingList().remove(stocktaking);
                userUserName = em.merge(userUserName);
            }
            em.remove(stocktaking);
            utx.commit();
        } catch (Exception ex) {
            try {
                utx.rollback();
            } catch (Exception re) {
                throw new RollbackFailureException("An error occurred attempting to roll back the transaction.", re);
            }
            throw ex;
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public List<Stocktaking> findStocktakingEntities() {
        return findStocktakingEntities(true, -1, -1);
    }

    public List<Stocktaking> findStocktakingEntities(int maxResults, int firstResult) {
        return findStocktakingEntities(false, maxResults, firstResult);
    }

    private List<Stocktaking> findStocktakingEntities(boolean all, int maxResults, int firstResult) {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            cq.select(cq.from(Stocktaking.class));
            Query q = em.createQuery(cq);
            if (!all) {
                q.setMaxResults(maxResults);
                q.setFirstResult(firstResult);
            }
            return q.getResultList();
        } finally {
            em.close();
        }
    }

    public Stocktaking findStocktaking(Integer id) {
        EntityManager em = getEntityManager();
        try {
            return em.find(Stocktaking.class, id);
        } finally {
            em.close();
        }
    }

    public int getStocktakingCount() {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            Root<Stocktaking> rt = cq.from(Stocktaking.class);
            cq.select(em.getCriteriaBuilder().count(rt));
            Query q = em.createQuery(cq);
            return ((Long) q.getSingleResult()).intValue();
        } finally {
            em.close();
        }
    }
    
}
