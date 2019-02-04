/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Controladores;

import Controladores.exceptions.IllegalOrphanException;
import Controladores.exceptions.NonexistentEntityException;
import Controladores.exceptions.RollbackFailureException;
import entities.Neighborhood;
import java.io.Serializable;
import javax.persistence.Query;
import javax.persistence.EntityNotFoundException;
import javax.persistence.criteria.CriteriaQuery;
import javax.persistence.criteria.Root;
import entities.User;
import java.util.ArrayList;
import java.util.List;
import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.transaction.UserTransaction;

/**
 *
 * @author berserker
 */
public class NeighborhoodJpaController implements Serializable {

    public NeighborhoodJpaController(UserTransaction utx, EntityManagerFactory emf) {
        this.utx = utx;
        this.emf = emf;
    }
    private UserTransaction utx = null;
    private EntityManagerFactory emf = null;

    public EntityManager getEntityManager() {
        return emf.createEntityManager();
    }

    public void create(Neighborhood neighborhood) throws RollbackFailureException, Exception {
        if (neighborhood.getUserList() == null) {
            neighborhood.setUserList(new ArrayList<User>());
        }
        EntityManager em = null;
        try {
            utx.begin();
            em = getEntityManager();
            List<User> attachedUserList = new ArrayList<User>();
            for (User userListUserToAttach : neighborhood.getUserList()) {
                userListUserToAttach = em.getReference(userListUserToAttach.getClass(), userListUserToAttach.getUserName());
                attachedUserList.add(userListUserToAttach);
            }
            neighborhood.setUserList(attachedUserList);
            em.persist(neighborhood);
            for (User userListUser : neighborhood.getUserList()) {
                Neighborhood oldNeighborhoodCodeOfUserListUser = userListUser.getNeighborhoodCode();
                userListUser.setNeighborhoodCode(neighborhood);
                userListUser = em.merge(userListUser);
                if (oldNeighborhoodCodeOfUserListUser != null) {
                    oldNeighborhoodCodeOfUserListUser.getUserList().remove(userListUser);
                    oldNeighborhoodCodeOfUserListUser = em.merge(oldNeighborhoodCodeOfUserListUser);
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

    public void edit(Neighborhood neighborhood) throws IllegalOrphanException, NonexistentEntityException, RollbackFailureException, Exception {
        EntityManager em = null;
        try {
            utx.begin();
            em = getEntityManager();
            Neighborhood persistentNeighborhood = em.find(Neighborhood.class, neighborhood.getCode());
            List<User> userListOld = persistentNeighborhood.getUserList();
            List<User> userListNew = neighborhood.getUserList();
            List<String> illegalOrphanMessages = null;
            for (User userListOldUser : userListOld) {
                if (!userListNew.contains(userListOldUser)) {
                    if (illegalOrphanMessages == null) {
                        illegalOrphanMessages = new ArrayList<String>();
                    }
                    illegalOrphanMessages.add("You must retain User " + userListOldUser + " since its neighborhoodCode field is not nullable.");
                }
            }
            if (illegalOrphanMessages != null) {
                throw new IllegalOrphanException(illegalOrphanMessages);
            }
            List<User> attachedUserListNew = new ArrayList<User>();
            for (User userListNewUserToAttach : userListNew) {
                userListNewUserToAttach = em.getReference(userListNewUserToAttach.getClass(), userListNewUserToAttach.getUserName());
                attachedUserListNew.add(userListNewUserToAttach);
            }
            userListNew = attachedUserListNew;
            neighborhood.setUserList(userListNew);
            neighborhood = em.merge(neighborhood);
            for (User userListNewUser : userListNew) {
                if (!userListOld.contains(userListNewUser)) {
                    Neighborhood oldNeighborhoodCodeOfUserListNewUser = userListNewUser.getNeighborhoodCode();
                    userListNewUser.setNeighborhoodCode(neighborhood);
                    userListNewUser = em.merge(userListNewUser);
                    if (oldNeighborhoodCodeOfUserListNewUser != null && !oldNeighborhoodCodeOfUserListNewUser.equals(neighborhood)) {
                        oldNeighborhoodCodeOfUserListNewUser.getUserList().remove(userListNewUser);
                        oldNeighborhoodCodeOfUserListNewUser = em.merge(oldNeighborhoodCodeOfUserListNewUser);
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
                Integer id = neighborhood.getCode();
                if (findNeighborhood(id) == null) {
                    throw new NonexistentEntityException("The neighborhood with id " + id + " no longer exists.");
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
            Neighborhood neighborhood;
            try {
                neighborhood = em.getReference(Neighborhood.class, id);
                neighborhood.getCode();
            } catch (EntityNotFoundException enfe) {
                throw new NonexistentEntityException("The neighborhood with id " + id + " no longer exists.", enfe);
            }
            List<String> illegalOrphanMessages = null;
            List<User> userListOrphanCheck = neighborhood.getUserList();
            for (User userListOrphanCheckUser : userListOrphanCheck) {
                if (illegalOrphanMessages == null) {
                    illegalOrphanMessages = new ArrayList<String>();
                }
                illegalOrphanMessages.add("This Neighborhood (" + neighborhood + ") cannot be destroyed since the User " + userListOrphanCheckUser + " in its userList field has a non-nullable neighborhoodCode field.");
            }
            if (illegalOrphanMessages != null) {
                throw new IllegalOrphanException(illegalOrphanMessages);
            }
            em.remove(neighborhood);
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

    public List<Neighborhood> findNeighborhoodEntities() {
        return findNeighborhoodEntities(true, -1, -1);
    }

    public List<Neighborhood> findNeighborhoodEntities(int maxResults, int firstResult) {
        return findNeighborhoodEntities(false, maxResults, firstResult);
    }

    private List<Neighborhood> findNeighborhoodEntities(boolean all, int maxResults, int firstResult) {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            cq.select(cq.from(Neighborhood.class));
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

    public Neighborhood findNeighborhood(Integer id) {
        EntityManager em = getEntityManager();
        try {
            return em.find(Neighborhood.class, id);
        } finally {
            em.close();
        }
    }

    public int getNeighborhoodCount() {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            Root<Neighborhood> rt = cq.from(Neighborhood.class);
            cq.select(em.getCriteriaBuilder().count(rt));
            Query q = em.createQuery(cq);
            return ((Long) q.getSingleResult()).intValue();
        } finally {
            em.close();
        }
    }
    
}
