/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package jaxwebservices;

import entities.Neighborhood;
import entities.Stocktaking;
import entities.Transaction;
import entities.User;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.Base64;
import static java.util.Collections.list;
import java.util.Date;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.annotation.Resource;
import javax.jws.WebService;
import javax.jws.WebMethod;
import javax.jws.WebParam;
import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;
import javax.persistence.PersistenceContext;
import javax.transaction.HeuristicMixedException;
import javax.transaction.HeuristicRollbackException;
import javax.transaction.NotSupportedException;
import javax.transaction.RollbackException;
import javax.transaction.SystemException;

/**
 *
 * @author berserker
 */
@WebService(serviceName = "CocoJAXWS")
public class CocoJAXWS {

//    @PersistenceContext(unitName = "CocoLocoWSPU")
//    private EntityManager em;
//    @Resource
//    private javax.transaction.UserTransaction utx;
    /**
     * Web service operation
     */
    @WebMethod(operationName = "registrarUser")
    public String registrarUser(@WebParam(name = "User_Name") String User_Name,
            @WebParam(name = "Password") String Password, @WebParam(name = "Mail") String Mail,
            @WebParam(name = "Amount") int Amount, @WebParam(name = "Type_User") int Type_User,
            @WebParam(name = "Name") String Name, @WebParam(name = "Last_Name") String Last_Name,
            @WebParam(name = "Phone_Number") int Phone_Number, @WebParam(name = "Adress") String Adress,
            @WebParam(name = "Neighborhood_Code") Integer Neighborhood_Code) {

        EntityManagerFactory emf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        EntityManager em = emf.createEntityManager();
        em.getTransaction().begin();

        User usr = new User();
        Neighborhood nh = new Neighborhood();
        usr.setUserName(User_Name);
        usr.setPassword(Password);
        usr.setMail(Mail);
        usr.setAmount(Amount);
        usr.setTypeUser(Type_User);
        usr.setName(Name);
        usr.setLastName(Last_Name);
        String ph = Integer.toString(Phone_Number);
        usr.setPhoneNumber(ph);
        usr.setAdress(Adress);

        nh.setCode(Neighborhood_Code);
        usr.setNeighborhoodCode(nh);
        usr.setSesion("1B");

        try {
            em.persist(usr);
            em.getTransaction().commit();
            em.clear();
            em.close();
            return "Exito";
        } catch (IllegalStateException | SecurityException e) {
            e.printStackTrace();
            em.getTransaction().rollback();
            Logger.getLogger(getClass().getName()).log(Level.SEVERE, "exception caught", e);
            throw new RuntimeException(e);
        }

    }
    
    /**
     * Web service operation
     */
    @WebMethod(operationName = "updateSession")
    public String updateSession (@WebParam(name = "User_Name") String User_Name,
            @WebParam(name = "Password") String Password, @WebParam(name = "Mail") String Mail,
            @WebParam(name = "Amount") int Amount, @WebParam(name = "Type_User") int Type_User,
            @WebParam(name = "Name") String Name, @WebParam(name = "Last_Name") String Last_Name,
            @WebParam(name = "Phone_Number") int Phone_Number, @WebParam(name = "Adress") String Adress,
            @WebParam(name = "Neighborhood_Code") Integer Neighborhood_Code, @WebParam(name = "Session") String Sesion) {

        EntityManagerFactory emf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        EntityManager em = emf.createEntityManager();
        em.getTransaction().begin();

        User usr = new User();
        Neighborhood nh = new Neighborhood();
        usr.setUserName(User_Name);
        usr.setPassword(Password);
        usr.setMail(Mail);
        usr.setAmount(Amount);
        usr.setTypeUser(Type_User);
        usr.setName(Name);
        usr.setLastName(Last_Name);
        String ph = Integer.toString(Phone_Number);
        usr.setPhoneNumber(ph);
        usr.setAdress(Adress);

        nh.setCode(Neighborhood_Code);
        usr.setNeighborhoodCode(nh);
        usr.setSesion(Sesion);

        try {
            em.merge(usr);
            em.getTransaction().commit();
            em.clear();
            em.close();
            return "Exito";
        } catch (IllegalStateException | SecurityException e) {
            e.printStackTrace();
            em.getTransaction().rollback();
            Logger.getLogger(getClass().getName()).log(Level.SEVERE, "exception caught", e);
            throw new RuntimeException(e);
        }

    }

    /**
     * Web service operation
     */
    @WebMethod(operationName = "editAdmin")
    public String editAdmin(@WebParam(name = "ID") Integer ID, @WebParam(name = "Texto") String Texto) {

        EntityManagerFactory emf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        EntityManager em = emf.createEntityManager();
        em.getTransaction().begin();

        Stocktaking stk = new Stocktaking();
        stk.setId(ID);
        stk.setProductDescription(Texto);

        try {
            em.merge(stk);
            em.getTransaction().commit();
            em.clear();
            em.close();
            return "Exito ";
        } catch (IllegalStateException | SecurityException e) {
            e.printStackTrace();
            em.getTransaction().rollback();
            Logger.getLogger(getClass().getName()).log(Level.SEVERE, "exception caught", e);
            throw new RuntimeException(e);
        }

    }

    /**
     * Web service operation
     *
     * @return
     */
    @WebMethod(operationName = "fetchIndex")
    public List<Stocktaking> fetchIndex() {

        EntityManager et;
        EntityManagerFactory etf;
        etf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        et = etf.createEntityManager();
        et.getTransaction().begin();

        List<Stocktaking> list;
        list = et.createNamedQuery("Stocktaking.findSeven", Stocktaking.class).setMaxResults(12).getResultList();
        et.getTransaction().commit();

        return list;
    }

    /**
     * Web service operation
     */
    @WebMethod(operationName = "fetch")
    public List<Stocktaking> fetch() {

        EntityManager et;
        EntityManagerFactory etf;
        etf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        et = etf.createEntityManager();
        et.getTransaction().begin();

        List<Stocktaking> list;
        list = et.createNamedQuery("Stocktaking.findSeven", Stocktaking.class).getResultList();
        et.getTransaction().commit();

        return list;
    }

    /**
     * Web service operation
     */
    @WebMethod(operationName = "agregarProducto")
    public byte[] agregarProducto(
            @WebParam(name = "Product_Name") String Product_Name,
            @WebParam(name = "Lot") int Lot,
            @WebParam(name = "Rate") int Rate,
            @WebParam(name = "Product_Description") String Product_Description,
            @WebParam(name = "Class") String Class,
            @WebParam(name = "SubClass") String SubClass,
            @WebParam(name = "User_User_Name") String User_User_Name,
            @WebParam(name = "Image") byte[] Image) {

        EntityManagerFactory emf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        EntityManager em = emf.createEntityManager();
        em.getTransaction().begin();

        Stocktaking stock = new Stocktaking();
        User usr = new User();

        stock.setProductName(Product_Name);
        stock.setLot(Lot);
        stock.setRate(Rate);
        stock.setProductDescription(Product_Description);
        stock.setClass1(Class);
        stock.setSubClass(SubClass);

        usr.setUserName(User_User_Name);
        stock.setUserUserName(usr);
        stock.setImage(Image);

        try {
            em.persist(stock);
            em.getTransaction().commit();
            em.clear();
            em.close();
            //return "Exito";
        } catch (IllegalStateException | SecurityException e) {
            e.printStackTrace();
            em.getTransaction().rollback();
            Logger.getLogger(getClass().getName()).log(Level.SEVERE, "exception caught", e);
            throw new RuntimeException(e);
        }
        return Image;
    }

    /**
     * Web service operation
     */
    @WebMethod(operationName = "procesLgn")
    public List<User> procesLgn(@WebParam(name = "MailUser") String MailUser, @WebParam(name = "Password") String Password) {

        EntityManager et;
        EntityManagerFactory etf;
        etf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        et = etf.createEntityManager();
        et.getTransaction().begin();

        List<User> listUser;
        listUser = et.createNamedQuery("User.findByMail", User.class).setParameter("mail", MailUser).getResultList();
        et.getTransaction().commit();
        et.clear();
        et.close();

        return listUser;

    }
    
    /**
     * Web service operation
     */
    @WebMethod(operationName = "consultaAmount")
    public List<User> consultaAmount(@WebParam(name = "User_Name") String User_Name) {
        EntityManager et;
        EntityManagerFactory etf;
        etf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        et = etf.createEntityManager();
        et.getTransaction().begin();

        List<User> listAm;
        listAm = et.createNamedQuery("User.findByUserName", User.class).setParameter("userName", User_Name).getResultList();
        et.getTransaction().commit();
        et.clear();
        et.close();

        return listAm;
    }

    /**
     * Web service operation
     */
    @WebMethod(operationName = "consultaAmountAdmin")
    public List<User> consultaAmountAdmin(@WebParam(name = "User_Name") String User_Name) {
        EntityManager et;
        EntityManagerFactory etf;
        etf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        et = etf.createEntityManager();
        et.getTransaction().begin();

        List<User> listAm;
        listAm = et.createNamedQuery("User.findByUserName", User.class).setParameter("userName", User_Name).getResultList();
        et.getTransaction().commit();
        et.clear();
        et.close();

        return listAm;
    }

    /**
     * Web service operation
     */
    @WebMethod(operationName = "consultaLot")
    public List<Stocktaking> consultaStock(@WebParam(name = "Product_Name") String Product_Name) {
        EntityManager et;
        EntityManagerFactory etf;
        etf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        et = etf.createEntityManager();
        et.getTransaction().begin();

        List<Stocktaking> listLot;
        listLot = et.createNamedQuery("Stocktaking.findByProductName", Stocktaking.class).setParameter("productName", Product_Name).getResultList();
        et.getTransaction().commit();
        et.clear();
        et.close();

        return listLot;
    }

    /**
     * Web service operation
     */
    @WebMethod(operationName = "insertTransaction")
    public String insertTransaction(@WebParam(name = "Date") Date Date, @WebParam(name = "Amount") Integer Amount, 
            @WebParam(name = "User_User_Name") String User_User_Name, 
            @WebParam(name = "Stocktaking_ID") Integer Stocktaking_ID) {
        EntityManagerFactory emf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        EntityManager em = emf.createEntityManager();
        em.getTransaction().begin();

        Transaction trn = new Transaction();
        User usr = new User();
        Stocktaking stk = new Stocktaking();

        trn.setDate(Date);
        trn.setAmount(Amount);
        usr.setUserName(User_User_Name);
        trn.setUserUserName(usr);
        stk.setId(Stocktaking_ID);
        trn.setStocktakingID(stk);

        try {
            em.persist(trn);
            em.getTransaction().commit();
            em.clear();
            em.close();
            //return "Exito";
        } catch (IllegalStateException | SecurityException e) {
            e.printStackTrace();
            em.getTransaction().rollback();
            Logger.getLogger(getClass().getName()).log(Level.SEVERE, "exception caught", e);
            throw new RuntimeException(e);
        }
        return "Exito";

    }

    /**
     * Web service operation
     */
    @WebMethod(operationName = "updateUser")
    public String updateUser(@WebParam(name = "User_Name") String User_Name,
            @WebParam(name = "Password") String Password, @WebParam(name = "Mail") String Mail,
            @WebParam(name = "Amount") int Amount, @WebParam(name = "Type_User") int Type_User,
            @WebParam(name = "Name") String Name, @WebParam(name = "Last_Name") String Last_Name,
            @WebParam(name = "Phone_Number") int Phone_Number, @WebParam(name = "Adress") String Adress,
            @WebParam(name = "Neighborhood_Code") Integer Neighborhood_Code,
            @WebParam(name = "Sesion") String Sesion) {

        EntityManagerFactory emf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        EntityManager em = emf.createEntityManager();
        em.getTransaction().begin();

        User usr = new User();
        Neighborhood nh = new Neighborhood();
        usr.setUserName(User_Name);
        usr.setPassword(Password);
        usr.setMail(Mail);
        usr.setAmount(Amount);
        usr.setTypeUser(Type_User);
        usr.setName(Name);
        usr.setLastName(Last_Name);
        String ph = Integer.toString(Phone_Number);
        usr.setPhoneNumber(ph);
        usr.setAdress(Adress);

        nh.setCode(Neighborhood_Code);
        usr.setNeighborhoodCode(nh);
        usr.setSesion(Sesion);

        try {
            em.merge(usr);
            em.getTransaction().commit();
            em.clear();
            em.close();
            return "Exito";
        } catch (IllegalStateException | SecurityException e) {
            e.printStackTrace();
            em.getTransaction().rollback();
            Logger.getLogger(getClass().getName()).log(Level.SEVERE, "exception caught", e);
            throw new RuntimeException(e);
        }

    }
    
    /**
     * Web service operation
     */
    @WebMethod(operationName = "amountUser")
    public String amountUser(@WebParam(name = "User_Name") String User_Name,
            @WebParam(name = "Password") String Password, @WebParam(name = "Mail") String Mail,
            @WebParam(name = "Amount") int Amount, @WebParam(name = "Type_User") int Type_User,
            @WebParam(name = "Name") String Name, @WebParam(name = "Last_Name") String Last_Name,
            @WebParam(name = "Phone_Number") int Phone_Number, @WebParam(name = "Adress") String Adress,
            @WebParam(name = "Neighborhood_Code") Integer Neighborhood_Code,
            @WebParam(name = "Sesion") String Sesion) {

        EntityManagerFactory emf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        EntityManager em = emf.createEntityManager();
        em.getTransaction().begin();

        User usr = new User();
        Neighborhood nh = new Neighborhood();
        usr.setUserName(User_Name);
        usr.setPassword(Password);
        usr.setMail(Mail);
        usr.setAmount(Amount);
        usr.setTypeUser(Type_User);
        usr.setName(Name);
        usr.setLastName(Last_Name);
        String ph = Integer.toString(Phone_Number);
        usr.setPhoneNumber(ph);
        usr.setAdress(Adress);

        nh.setCode(Neighborhood_Code);
        usr.setNeighborhoodCode(nh);
        usr.setSesion(Sesion);

        try {
            em.merge(usr);
            em.getTransaction().commit();
            em.clear();
            em.close();
            return "Exito";
        } catch (IllegalStateException | SecurityException e) {
            e.printStackTrace();
            em.getTransaction().rollback();
            Logger.getLogger(getClass().getName()).log(Level.SEVERE, "exception caught", e);
            throw new RuntimeException(e);
        }

    }

    /**
     * Web service operation
     */
    @WebMethod(operationName = "updateAmount")
    public String updateAdmin(@WebParam(name = "User_Name") String User_Name,
            @WebParam(name = "Password") String Password, @WebParam(name = "Mail") String Mail,
            @WebParam(name = "Amount") int Amount, @WebParam(name = "Type_User") int Type_User,
            @WebParam(name = "Name") String Name, @WebParam(name = "Last_Name") String Last_Name,
            @WebParam(name = "Phone_Number") int Phone_Number, @WebParam(name = "Adress") String Adress,
            @WebParam(name = "Neighborhood_Code") Integer Neighborhood_Code,
            @WebParam(name = "Sesion") String Sesion) {

        EntityManagerFactory emf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        EntityManager em = emf.createEntityManager();
        em.getTransaction().begin();

        User usr = new User();
        Neighborhood nh = new Neighborhood();
        usr.setUserName(User_Name);
        usr.setPassword(Password);
        usr.setMail(Mail);
        usr.setAmount(Amount);
        usr.setTypeUser(Type_User);
        usr.setName(Name);
        usr.setLastName(Last_Name);
        String ph = Integer.toString(Phone_Number);
        usr.setPhoneNumber(ph);
        usr.setAdress(Adress);

        nh.setCode(Neighborhood_Code);
        usr.setNeighborhoodCode(nh);
        usr.setSesion(Sesion);

        try {
            em.merge(usr);
            em.getTransaction().commit();
            em.clear();
            em.close();
            return "Exito";
        } catch (IllegalStateException | SecurityException e) {
            e.printStackTrace();
            em.getTransaction().rollback();
            Logger.getLogger(getClass().getName()).log(Level.SEVERE, "exception caught", e);
            throw new RuntimeException(e);
        }

    }

    /**
     * Web service operation
     */
    @WebMethod(operationName = "updateStock")
    public String updateStock(
            @WebParam(name = "ID") Integer ID,
            @WebParam(name = "Product_Name") String Product_Name,
            @WebParam(name = "Lot") Integer Lot,
            @WebParam(name = "Rate") Integer Rate,
            @WebParam(name = "Product_Description") String Product_Description,
            @WebParam(name = "Class") String Class,
            @WebParam(name = "SubClass") String SubClass,
            @WebParam(name = "User_User_Name") String User_User_Name,
            @WebParam(name = "Image") byte[] Image) {

        EntityManagerFactory emf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        EntityManager em = emf.createEntityManager();
        em.getTransaction().begin();

        Stocktaking stock = new Stocktaking();
        User usr = new User();

        stock.setId(ID);
        stock.setProductName(Product_Name);
        stock.setLot(Lot);
        stock.setRate(Rate);
        stock.setProductDescription(Product_Description);
        stock.setClass1(Class);
        stock.setSubClass(SubClass);

        usr.setUserName(User_User_Name);
        stock.setUserUserName(usr);
        stock.setImage(Image);

        try {
            em.merge(stock);
            em.getTransaction().commit();
            em.clear();
            em.close();
            return "Exito";
        } catch (IllegalStateException | SecurityException e) {
            e.printStackTrace();
            em.getTransaction().rollback();
            Logger.getLogger(getClass().getName()).log(Level.SEVERE, "exception caught", e);
            throw new RuntimeException(e);
        }
        //return Image;
    }
    
        /**
     * Web service operation
     */
    @WebMethod(operationName = "checkSession")
    public List<User> checkSession(@WebParam(name = "User_Name") String User_Name, @WebParam(name = "Session") String Sesion) {
        EntityManager et;
        EntityManagerFactory etf;
        etf = Persistence.createEntityManagerFactory("CocoLocoWSPU");
        et = etf.createEntityManager();
        et.getTransaction().begin();

        List<User> listAm;
        listAm = et.createNamedQuery("User.findActiveSession", User.class).setParameter("userName", User_Name).setParameter("sesion", Sesion).getResultList();
        et.getTransaction().commit();
        et.clear();
        et.close();

        return listAm;
    }

}
