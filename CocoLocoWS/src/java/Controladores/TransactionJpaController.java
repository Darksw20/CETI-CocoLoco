/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controladores;

import Controladores.exceptions.NonexistentEntityException;
import Controladores.exceptions.RollbackFailureException;
import java.io.Serializable;
import javax.persistence.Query;
import javax.persistence.EntityNotFoundException;
import javax.persistence.criteria.CriteriaQuery;
import javax.persistence.criteria.Root;
import entities.Stocktaking;
import entities.Transaction;
import entities.User;
import java.util.List;
import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.transaction.UserTransaction;

/**
 *
 * @author berserker
 */
public class TransactionJpaController implements Serializable {

    public TransactionJpaController(UserTransaction utx, EntityManagerFactory emf) {
        this.utx = utx;
        this.emf = emf;
    }
    private UserTransaction utx = null;
    private EntityManagerFactory emf = null;

    public EntityManager getEntityManager() {
        return emf.createEntityManager();
    }

    public void create(Transaction transaction) throws RollbackFailureException, Exception {
        EntityManager em = null;
        try {
            utx.begin();
            em = getEntityManager();
            Stocktaking stocktakingID = transaction.getStocktakingID();
            if (stocktakingID != null) {
                stocktakingID = em.getReference(stocktakingID.getClass(), stocktakingID.getId());
                transaction.setStocktakingID(stocktakingID);
            }
            User userUserName = transaction.getUserUserName();
            if (userUserName != null) {
                userUserName = em.getReference(userUserName.getClass(), userUserName.getUserName());
                transaction.setUserUserName(userUserName);
            }
            em.persist(transaction);
            if (stocktakingID != null) {
                stocktakingID.getTransactionList().add(transaction);
                stocktakingID = em.merge(stocktakingID);
            }
            if (userUserName != null) {
                userUserName.getTransactionList().add(transaction);
                userUserName = em.merge(userUserName);
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

    public void edit(Transaction transaction) throws NonexistentEntityException, RollbackFailureException, Exception {
        EntityManager em = null;
        try {
            utx.begin();
            em = getEntityManager();
            Transaction persistentTransaction = em.find(Transaction.class, transaction.getFolio());
            Stocktaking stocktakingIDOld = persistentTransaction.getStocktakingID();
            Stocktaking stocktakingIDNew = transaction.getStocktakingID();
            User userUserNameOld = persistentTransaction.getUserUserName();
            User userUserNameNew = transaction.getUserUserName();
            if (stocktakingIDNew != null) {
                stocktakingIDNew = em.getReference(stocktakingIDNew.getClass(), stocktakingIDNew.getId());
                transaction.setStocktakingID(stocktakingIDNew);
            }
            if (userUserNameNew != null) {
                userUserNameNew = em.getReference(userUserNameNew.getClass(), userUserNameNew.getUserName());
                transaction.setUserUserName(userUserNameNew);
            }
            transaction = em.merge(transaction);
            if (stocktakingIDOld != null && !stocktakingIDOld.equals(stocktakingIDNew)) {
                stocktakingIDOld.getTransactionList().remove(transaction);
                stocktakingIDOld = em.merge(stocktakingIDOld);
            }
            if (stocktakingIDNew != null && !stocktakingIDNew.equals(stocktakingIDOld)) {
                stocktakingIDNew.getTransactionList().add(transaction);
                stocktakingIDNew = em.merge(stocktakingIDNew);
            }
            if (userUserNameOld != null && !userUserNameOld.equals(userUserNameNew)) {
                userUserNameOld.getTransactionList().remove(transaction);
                userUserNameOld = em.merge(userUserNameOld);
            }
            if (userUserNameNew != null && !userUserNameNew.equals(userUserNameOld)) {
                userUserNameNew.getTransactionList().add(transaction);
                userUserNameNew = em.merge(userUserNameNew);
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
                Integer id = transaction.getFolio();
                if (findTransaction(id) == null) {
                    throw new NonexistentEntityException("The transaction with id " + id + " no longer exists.");
                }
            }
            throw ex;
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void destroy(Integer id) throws NonexistentEntityException, RollbackFailureException, Exception {
        EntityManager em = null;
        try {
            utx.begin();
            em = getEntityManager();
            Transaction transaction;
            try {
                transaction = em.getReference(Transaction.class, id);
                transaction.getFolio();
            } catch (EntityNotFoundException enfe) {
                throw new NonexistentEntityException("The transaction with id " + id + " no longer exists.", enfe);
            }
            Stocktaking stocktakingID = transaction.getStocktakingID();
            if (stocktakingID != null) {
                stocktakingID.getTransactionList().remove(transaction);
                stocktakingID = em.merge(stocktakingID);
            }
            User userUserName = transaction.getUserUserName();
            if (userUserName != null) {
                userUserName.getTransactionList().remove(transaction);
                userUserName = em.merge(userUserName);
            }
            em.remove(transaction);
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

    public List<Transaction> findTransactionEntities() {
        return findTransactionEntities(true, -1, -1);
    }

    public List<Transaction> findTransactionEntities(int maxResults, int firstResult) {
        return findTransactionEntities(false, maxResults, firstResult);
    }

    private List<Transaction> findTransactionEntities(boolean all, int maxResults, int firstResult) {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            cq.select(cq.from(Transaction.class));
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

    public Transaction findTransaction(Integer id) {
        EntityManager em = getEntityManager();
        try {
            return em.find(Transaction.class, id);
        } finally {
            em.close();
        }
    }

    public int getTransactionCount() {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            Root<Transaction> rt = cq.from(Transaction.class);
            cq.select(em.getCriteriaBuilder().count(rt));
            Query q = em.createQuery(cq);
            return ((Long) q.getSingleResult()).intValue();
        } finally {
            em.close();
        }
    }
    
}
