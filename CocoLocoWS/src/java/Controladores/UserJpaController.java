/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controladores;

import Controladores.exceptions.IllegalOrphanException;
import Controladores.exceptions.NonexistentEntityException;
import Controladores.exceptions.PreexistingEntityException;
import Controladores.exceptions.RollbackFailureException;
import java.io.Serializable;
import javax.persistence.Query;
import javax.persistence.EntityNotFoundException;
import javax.persistence.criteria.CriteriaQuery;
import javax.persistence.criteria.Root;
import entities.Neighborhood;
import entities.Transaction;
import java.util.ArrayList;
import java.util.List;
import entities.Stocktaking;
import entities.User;
import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.transaction.UserTransaction;

/**
 *
 * @author berserker
 */
public class UserJpaController implements Serializable {

    public UserJpaController(UserTransaction utx, EntityManagerFactory emf) {
        this.utx = utx;
        this.emf = emf;
    }
    private UserTransaction utx = null;
    private EntityManagerFactory emf = null;

    public EntityManager getEntityManager() {
        return emf.createEntityManager();
    }

    public void create(User user) throws PreexistingEntityException, RollbackFailureException, Exception {
        if (user.getTransactionList() == null) {
            user.setTransactionList(new ArrayList<Transaction>());
        }
        if (user.getStocktakingList() == null) {
            user.setStocktakingList(new ArrayList<Stocktaking>());
        }
        EntityManager em = null;
        try {
            utx.begin();
            em = getEntityManager();
            Neighborhood neighborhoodCode = user.getNeighborhoodCode();
            if (neighborhoodCode != null) {
                neighborhoodCode = em.getReference(neighborhoodCode.getClass(), neighborhoodCode.getCode());
                user.setNeighborhoodCode(neighborhoodCode);
            }
            List<Transaction> attachedTransactionList = new ArrayList<Transaction>();
            for (Transaction transactionListTransactionToAttach : user.getTransactionList()) {
                transactionListTransactionToAttach = em.getReference(transactionListTransactionToAttach.getClass(), transactionListTransactionToAttach.getFolio());
                attachedTransactionList.add(transactionListTransactionToAttach);
            }
            user.setTransactionList(attachedTransactionList);
            List<Stocktaking> attachedStocktakingList = new ArrayList<Stocktaking>();
            for (Stocktaking stocktakingListStocktakingToAttach : user.getStocktakingList()) {
                stocktakingListStocktakingToAttach = em.getReference(stocktakingListStocktakingToAttach.getClass(), stocktakingListStocktakingToAttach.getId());
                attachedStocktakingList.add(stocktakingListStocktakingToAttach);
            }
            user.setStocktakingList(attachedStocktakingList);
            em.persist(user);
            if (neighborhoodCode != null) {
                neighborhoodCode.getUserList().add(user);
                neighborhoodCode = em.merge(neighborhoodCode);
            }
            for (Transaction transactionListTransaction : user.getTransactionList()) {
                User oldUserUserNameOfTransactionListTransaction = transactionListTransaction.getUserUserName();
                transactionListTransaction.setUserUserName(user);
                transactionListTransaction = em.merge(transactionListTransaction);
                if (oldUserUserNameOfTransactionListTransaction != null) {
                    oldUserUserNameOfTransactionListTransaction.getTransactionList().remove(transactionListTransaction);
                    oldUserUserNameOfTransactionListTransaction = em.merge(oldUserUserNameOfTransactionListTransaction);
                }
            }
            for (Stocktaking stocktakingListStocktaking : user.getStocktakingList()) {
                User oldUserUserNameOfStocktakingListStocktaking = stocktakingListStocktaking.getUserUserName();
                stocktakingListStocktaking.setUserUserName(user);
                stocktakingListStocktaking = em.merge(stocktakingListStocktaking);
                if (oldUserUserNameOfStocktakingListStocktaking != null) {
                    oldUserUserNameOfStocktakingListStocktaking.getStocktakingList().remove(stocktakingListStocktaking);
                    oldUserUserNameOfStocktakingListStocktaking = em.merge(oldUserUserNameOfStocktakingListStocktaking);
                }
            }
            utx.commit();
        } catch (Exception ex) {
            try {
                utx.rollback();
            } catch (Exception re) {
                throw new RollbackFailureException("An error occurred attempting to roll back the transaction.", re);
            }
            if (findUser(user.getUserName()) != null) {
                throw new PreexistingEntityException("User " + user + " already exists.", ex);
            }
            throw ex;
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void edit(User user) throws IllegalOrphanException, NonexistentEntityException, RollbackFailureException, Exception {
        EntityManager em = null;
        try {
            utx.begin();
            em = getEntityManager();
            User persistentUser = em.find(User.class, user.getUserName());
            Neighborhood neighborhoodCodeOld = persistentUser.getNeighborhoodCode();
            Neighborhood neighborhoodCodeNew = user.getNeighborhoodCode();
            List<Transaction> transactionListOld = persistentUser.getTransactionList();
            List<Transaction> transactionListNew = user.getTransactionList();
            List<Stocktaking> stocktakingListOld = persistentUser.getStocktakingList();
            List<Stocktaking> stocktakingListNew = user.getStocktakingList();
            List<String> illegalOrphanMessages = null;
            for (Transaction transactionListOldTransaction : transactionListOld) {
                if (!transactionListNew.contains(transactionListOldTransaction)) {
                    if (illegalOrphanMessages == null) {
                        illegalOrphanMessages = new ArrayList<String>();
                    }
                    illegalOrphanMessages.add("You must retain Transaction " + transactionListOldTransaction + " since its userUserName field is not nullable.");
                }
            }
            for (Stocktaking stocktakingListOldStocktaking : stocktakingListOld) {
                if (!stocktakingListNew.contains(stocktakingListOldStocktaking)) {
                    if (illegalOrphanMessages == null) {
                        illegalOrphanMessages = new ArrayList<String>();
                    }
                    illegalOrphanMessages.add("You must retain Stocktaking " + stocktakingListOldStocktaking + " since its userUserName field is not nullable.");
                }
            }
            if (illegalOrphanMessages != null) {
                throw new IllegalOrphanException(illegalOrphanMessages);
            }
            if (neighborhoodCodeNew != null) {
                neighborhoodCodeNew = em.getReference(neighborhoodCodeNew.getClass(), neighborhoodCodeNew.getCode());
                user.setNeighborhoodCode(neighborhoodCodeNew);
            }
            List<Transaction> attachedTransactionListNew = new ArrayList<Transaction>();
            for (Transaction transactionListNewTransactionToAttach : transactionListNew) {
                transactionListNewTransactionToAttach = em.getReference(transactionListNewTransactionToAttach.getClass(), transactionListNewTransactionToAttach.getFolio());
                attachedTransactionListNew.add(transactionListNewTransactionToAttach);
            }
            transactionListNew = attachedTransactionListNew;
            user.setTransactionList(transactionListNew);
            List<Stocktaking> attachedStocktakingListNew = new ArrayList<Stocktaking>();
            for (Stocktaking stocktakingListNewStocktakingToAttach : stocktakingListNew) {
                stocktakingListNewStocktakingToAttach = em.getReference(stocktakingListNewStocktakingToAttach.getClass(), stocktakingListNewStocktakingToAttach.getId());
                attachedStocktakingListNew.add(stocktakingListNewStocktakingToAttach);
            }
            stocktakingListNew = attachedStocktakingListNew;
            user.setStocktakingList(stocktakingListNew);
            user = em.merge(user);
            if (neighborhoodCodeOld != null && !neighborhoodCodeOld.equals(neighborhoodCodeNew)) {
                neighborhoodCodeOld.getUserList().remove(user);
                neighborhoodCodeOld = em.merge(neighborhoodCodeOld);
            }
            if (neighborhoodCodeNew != null && !neighborhoodCodeNew.equals(neighborhoodCodeOld)) {
                neighborhoodCodeNew.getUserList().add(user);
                neighborhoodCodeNew = em.merge(neighborhoodCodeNew);
            }
            for (Transaction transactionListNewTransaction : transactionListNew) {
                if (!transactionListOld.contains(transactionListNewTransaction)) {
                    User oldUserUserNameOfTransactionListNewTransaction = transactionListNewTransaction.getUserUserName();
                    transactionListNewTransaction.setUserUserName(user);
                    transactionListNewTransaction = em.merge(transactionListNewTransaction);
                    if (oldUserUserNameOfTransactionListNewTransaction != null && !oldUserUserNameOfTransactionListNewTransaction.equals(user)) {
                        oldUserUserNameOfTransactionListNewTransaction.getTransactionList().remove(transactionListNewTransaction);
                        oldUserUserNameOfTransactionListNewTransaction = em.merge(oldUserUserNameOfTransactionListNewTransaction);
                    }
                }
            }
            for (Stocktaking stocktakingListNewStocktaking : stocktakingListNew) {
                if (!stocktakingListOld.contains(stocktakingListNewStocktaking)) {
                    User oldUserUserNameOfStocktakingListNewStocktaking = stocktakingListNewStocktaking.getUserUserName();
                    stocktakingListNewStocktaking.setUserUserName(user);
                    stocktakingListNewStocktaking = em.merge(stocktakingListNewStocktaking);
                    if (oldUserUserNameOfStocktakingListNewStocktaking != null && !oldUserUserNameOfStocktakingListNewStocktaking.equals(user)) {
                        oldUserUserNameOfStocktakingListNewStocktaking.getStocktakingList().remove(stocktakingListNewStocktaking);
                        oldUserUserNameOfStocktakingListNewStocktaking = em.merge(oldUserUserNameOfStocktakingListNewStocktaking);
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
                String id = user.getUserName();
                if (findUser(id) == null) {
                    throw new NonexistentEntityException("The user with id " + id + " no longer exists.");
                }
            }
            throw ex;
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void destroy(String id) throws IllegalOrphanException, NonexistentEntityException, RollbackFailureException, Exception {
        EntityManager em = null;
        try {
            utx.begin();
            em = getEntityManager();
            User user;
            try {
                user = em.getReference(User.class, id);
                user.getUserName();
            } catch (EntityNotFoundException enfe) {
                throw new NonexistentEntityException("The user with id " + id + " no longer exists.", enfe);
            }
            List<String> illegalOrphanMessages = null;
            List<Transaction> transactionListOrphanCheck = user.getTransactionList();
            for (Transaction transactionListOrphanCheckTransaction : transactionListOrphanCheck) {
                if (illegalOrphanMessages == null) {
                    illegalOrphanMessages = new ArrayList<String>();
                }
                illegalOrphanMessages.add("This User (" + user + ") cannot be destroyed since the Transaction " + transactionListOrphanCheckTransaction + " in its transactionList field has a non-nullable userUserName field.");
            }
            List<Stocktaking> stocktakingListOrphanCheck = user.getStocktakingList();
            for (Stocktaking stocktakingListOrphanCheckStocktaking : stocktakingListOrphanCheck) {
                if (illegalOrphanMessages == null) {
                    illegalOrphanMessages = new ArrayList<String>();
                }
                illegalOrphanMessages.add("This User (" + user + ") cannot be destroyed since the Stocktaking " + stocktakingListOrphanCheckStocktaking + " in its stocktakingList field has a non-nullable userUserName field.");
            }
            if (illegalOrphanMessages != null) {
                throw new IllegalOrphanException(illegalOrphanMessages);
            }
            Neighborhood neighborhoodCode = user.getNeighborhoodCode();
            if (neighborhoodCode != null) {
                neighborhoodCode.getUserList().remove(user);
                neighborhoodCode = em.merge(neighborhoodCode);
            }
            em.remove(user);
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

    public List<User> findUserEntities() {
        return findUserEntities(true, -1, -1);
    }

    public List<User> findUserEntities(int maxResults, int firstResult) {
        return findUserEntities(false, maxResults, firstResult);
    }

    private List<User> findUserEntities(boolean all, int maxResults, int firstResult) {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            cq.select(cq.from(User.class));
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

    public User findUser(String id) {
        EntityManager em = getEntityManager();
        try {
            return em.find(User.class, id);
        } finally {
            em.close();
        }
    }

    public int getUserCount() {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            Root<User> rt = cq.from(User.class);
            cq.select(em.getCriteriaBuilder().count(rt));
            Query q = em.createQuery(cq);
            return ((Long) q.getSingleResult()).intValue();
        } finally {
            em.close();
        }
    }
    
}
