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
import javax.persistence.NamedQueries;
import javax.persistence.NamedQuery;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.validation.constraints.Size;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;

/**
 *
 * @author berserker
 */
@Entity
@Table(name = "Neighborhood")
@XmlRootElement
@NamedQueries({
    @NamedQuery(name = "Neighborhood.findAll", query = "SELECT n FROM Neighborhood n")
    , @NamedQuery(name = "Neighborhood.findByCode", query = "SELECT n FROM Neighborhood n WHERE n.code = :code")
    , @NamedQuery(name = "Neighborhood.findByName", query = "SELECT n FROM Neighborhood n WHERE n.name = :name")
    , @NamedQuery(name = "Neighborhood.findByPc", query = "SELECT n FROM Neighborhood n WHERE n.pc = :pc")})
public class Neighborhood implements Serializable {

    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Basic(optional = false)
    @Column(name = "Code")
    private Integer code;
    @Size(max = 45)
    @Column(name = "Name")
    private String name;
    @Column(name = "PC")
    private Integer pc;
    @OneToMany(cascade = CascadeType.ALL, mappedBy = "neighborhoodCode")
    private List<User> userList;

    public Neighborhood() {
    }

    public Neighborhood(Integer code) {
        this.code = code;
    }

    public Integer getCode() {
        return code;
    }

    public void setCode(Integer code) {
        this.code = code;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public Integer getPc() {
        return pc;
    }

    public void setPc(Integer pc) {
        this.pc = pc;
    }

    @XmlTransient
    public List<User> getUserList() {
        return userList;
    }

    public void setUserList(List<User> userList) {
        this.userList = userList;
    }

    @Override
    public int hashCode() {
        int hash = 0;
        hash += (code != null ? code.hashCode() : 0);
        return hash;
    }

    @Override
    public boolean equals(Object object) {
        // TODO: Warning - this method won't work in the case the id fields are not set
        if (!(object instanceof Neighborhood)) {
            return false;
        }
        Neighborhood other = (Neighborhood) object;
        if ((this.code == null && other.code != null) || (this.code != null && !this.code.equals(other.code))) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "entities.Neighborhood[ code=" + code + " ]";
    }
    
}
