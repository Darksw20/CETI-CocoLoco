/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package entities;

import java.io.Serializable;
import java.util.List;
import javax.persistence.Basic;
import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.NamedQueries;
import javax.persistence.NamedQuery;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;

/**
 *
 * @author berserker
 */
@Entity
@Table(name = "User")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "User.findAll", query = "SELECT u FROM User u")
    , @NamedQuery(name = "User.findByUserName", query = "SELECT u FROM User u WHERE u.userName = :userName")
    , @NamedQuery(name = "User.findActiveSession", query = "SELECT COALESCE(COUNT(u.sesion),0) FROM User u WHERE u.userName = :userName AND u.sesion = :sesion")
    , @NamedQuery(name = "User.findByPassword", query = "SELECT u FROM User u WHERE u.password = :password")
    , @NamedQuery(name = "User.findByMail", query = "SELECT u FROM User u WHERE u.mail = :mail")
    , @NamedQuery(name = "User.findByAmount", query = "SELECT u FROM User u WHERE u.amount = :amount")
    , @NamedQuery(name = "User.findByTypeUser", query = "SELECT u FROM User u WHERE u.typeUser = :typeUser")
    , @NamedQuery(name = "User.findByName", query = "SELECT u FROM User u WHERE u.name = :name")
    , @NamedQuery(name = "User.findByLastName", query = "SELECT u FROM User u WHERE u.lastName = :lastName")
    , @NamedQuery(name = "User.findByPhoneNumber", query = "SELECT u FROM User u WHERE u.phoneNumber = :phoneNumber")
    , @NamedQuery(name = "User.findByAdress", query = "SELECT u FROM User u WHERE u.adress = :adress")
    , @NamedQuery(name = "User.findBySesion", query = "SELECT u FROM User u WHERE u.sesion = :sesion")})
public class User implements Serializable {

    private static final long serialVersionUID = 1L;
    @Id
    @Basic(optional = false)
    @NotNull
    @Size(min = 1, max = 30)
    @Column(name = "User_Name")
    private String userName;
    @Size(max = 20)
    @Column(name = "Password")
    private String password;
    @Size(max = 35)
    @Column(name = "Mail")
    private String mail;
    @Column(name = "Amount")
    private Integer amount;
    @Column(name = "Type_User")
    private int typeUser;
    @Size(max = 30)
    @Column(name = "Name")
    private String name;
    @Size(max = 45)
    @Column(name = "Last_Name")
    private String lastName;
    @Size(max = 10)
    @Column(name = "Phone_Number")
    private String phoneNumber;
    @Size(max = 200)
    @Column(name = "Adress")
    private String adress;
    @Basic(optional = false)
    @NotNull
    @Size(min = 1, max = 100)
    @Column(name = "Sesion")
    private String sesion;
    @JoinColumn(name = "Neighborhood_Code", referencedColumnName = "Code")
    @ManyToOne(optional = false)
    private Neighborhood neighborhoodCode;
    @OneToMany(cascade = CascadeType.ALL, mappedBy = "userUserName")
    private List<Transaction> transactionList;
    @OneToMany(cascade = CascadeType.ALL, mappedBy = "userUserName")
    private List<Stocktaking> stocktakingList;

    public User() {
    }

    public User(String userName) {
        this.userName = userName;
    }

    public User(String userName, String sesion) {
        this.userName = userName;
        this.sesion = sesion;
    }

    public String getUserName() {
        return userName;
    }

    public void setUserName(String userName) {
        this.userName = userName;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getMail() {
        return mail;
    }

    public void setMail(String mail) {
        this.mail = mail;
    }

    public Integer getAmount() {
        return amount;
    }

    public void setAmount(Integer amount) {
        this.amount = amount;
    }

    public int getTypeUser() {
        return typeUser;
    }

    public void setTypeUser(int typeUser) {
        this.typeUser = typeUser;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getLastName() {
        return lastName;
    }

    public void setLastName(String lastName) {
        this.lastName = lastName;
    }

    public String getPhoneNumber() {
        return phoneNumber;
    }

    public void setPhoneNumber(String phoneNumber) {
        this.phoneNumber = phoneNumber;
    }

    public String getAdress() {
        return adress;
    }

    public void setAdress(String adress) {
        this.adress = adress;
    }

    public String getSesion() {
        return sesion;
    }

    public void setSesion(String sesion) {
        this.sesion = sesion;
    }

    public Neighborhood getNeighborhoodCode() {
        return neighborhoodCode;
    }

    public void setNeighborhoodCode(Neighborhood neighborhoodCode) {
        this.neighborhoodCode = neighborhoodCode;
    }
   

    @XmlTransient
    public List<Transaction> getTransactionList() {
        return transactionList;
    }

    public void setTransactionList(List<Transaction> transactionList) {
        this.transactionList = transactionList;
    }

    @XmlTransient
    public List<Stocktaking> getStocktakingList() {
        return stocktakingList;
    }

    public void setStocktakingList(List<Stocktaking> stocktakingList) {
        this.stocktakingList = stocktakingList;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (userName != null ? userName.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof User)) {
            return false;
        }
        User other = (User) object;
        if ((this.userName == null && other.userName != null) || (this.userName != null && !this.userName.equals(other.userName))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "entities.User[ userName=" + userName + " ]";
    }
    
}
