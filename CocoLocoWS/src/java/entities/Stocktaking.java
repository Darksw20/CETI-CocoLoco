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
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.Lob;
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
@Table(name = "Stocktaking")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "Stocktaking.findAll", query = "SELECT s FROM Stocktaking s")
    , @NamedQuery(name = "Stocktaking.findSeven", query = "SELECT s FROM Stocktaking s ORDER BY s.id DESC")
    , @NamedQuery(name = "Stocktaking.findById", query = "SELECT s FROM Stocktaking s WHERE s.id = :id")
    , @NamedQuery(name = "Stocktaking.findByProductName", query = "SELECT s FROM Stocktaking s WHERE s.productName = :productName")
    , @NamedQuery(name = "Stocktaking.findByLot", query = "SELECT s FROM Stocktaking s WHERE s.lot = :lot")
    , @NamedQuery(name = "Stocktaking.findByRate", query = "SELECT s FROM Stocktaking s WHERE s.rate = :rate")
    , @NamedQuery(name = "Stocktaking.findByProductDescription", query = "SELECT s FROM Stocktaking s WHERE s.productDescription = :productDescription")
    , @NamedQuery(name = "Stocktaking.findByClass1", query = "SELECT s FROM Stocktaking s WHERE s.class1 = :class1")
    , @NamedQuery(name = "Stocktaking.findBySubClass", query = "SELECT s FROM Stocktaking s WHERE s.subClass = :subClass")})
public class Stocktaking implements Serializable {

    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Basic(optional = false)
    @Column(name = "ID")
    private Integer id;
    @Size(max = 45)
    @Column(name = "Product_Name")
    private String productName;
    @Column(name = "Lot")
    private Integer lot;
    @Column(name = "Rate")
    private Integer rate;
    @Size(max = 120)
    @Column(name = "Product_Description")
    private String productDescription;
    @Size(max = 50)
    @Column(name = "Class")
    private String class1;
    @Size(max = 50)
    @Column(name = "SubClass")
    private String subClass;
    @Basic(optional = false)
    @NotNull
    @Lob
    @Column(name = "Image")
    private byte[] image;
    @OneToMany(cascade = CascadeType.ALL, mappedBy = "stocktakingID")
    private List<Transaction> transactionList;
    @JoinColumn(name = "User_User_Name", referencedColumnName = "User_Name")
    @ManyToOne(optional = false)
    private User userUserName;

    public Stocktaking() {
    }

    public Stocktaking(Integer id) {
        this.id = id;
    }

    public Stocktaking(Integer id, byte[] image) {
        this.id = id;
        this.image = image;
    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getProductName() {
        return productName;
    }

    public void setProductName(String productName) {
        this.productName = productName;
    }

    public Integer getLot() {
        return lot;
    }

    public void setLot(Integer lot) {
        this.lot = lot;
    }

    public Integer getRate() {
        return rate;
    }

    public void setRate(Integer rate) {
        this.rate = rate;
    }

    public String getProductDescription() {
        return productDescription;
    }

    public void setProductDescription(String productDescription) {
        this.productDescription = productDescription;
    }

    public String getClass1() {
        return class1;
    }

    public void setClass1(String class1) {
        this.class1 = class1;
    }

    public String getSubClass() {
        return subClass;
    }

    public void setSubClass(String subClass) {
        this.subClass = subClass;
    }

    public byte[] getImage() {
        return image;
    }

    public void setImage(byte[] image) {
        this.image = image;
    }

    @XmlTransient
    public List<Transaction> getTransactionList() {
        return transactionList;
    }

    public void setTransactionList(List<Transaction> transactionList) {
        this.transactionList = transactionList;
    }

    public User getUserUserName() {
        return userUserName;
    }

    public void setUserUserName(User userUserName) {
        this.userUserName = userUserName;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (id != null ? id.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof Stocktaking)) {
            return false;
        }
        Stocktaking other = (Stocktaking) object;
        if ((this.id == null && other.id != null) || (this.id != null && !this.id.equals(other.id))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "entities.Stocktaking[ id=" + id + " ]";
    }
    
}
