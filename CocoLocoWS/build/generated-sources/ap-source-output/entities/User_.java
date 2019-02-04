package entities;

import entities.Neighborhood;
import entities.Stocktaking;
import entities.Transaction;
import javax.annotation.Generated;
import javax.persistence.metamodel.ListAttribute;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="EclipseLink-2.5.2.v20140319-rNA", date="2018-12-10T08:06:38")
@StaticMetamodel(User.class)
public class User_ { 

    public static volatile SingularAttribute<User, String> lastName;
    public static volatile SingularAttribute<User, Integer> amount;
    public static volatile SingularAttribute<User, String> mail;
    public static volatile SingularAttribute<User, String> sesion;
    public static volatile SingularAttribute<User, String> adress;
    public static volatile SingularAttribute<User, String> userName;
    public static volatile SingularAttribute<User, String> password;
    public static volatile SingularAttribute<User, String> phoneNumber;
    public static volatile SingularAttribute<User, Neighborhood> neighborhoodCode;
    public static volatile SingularAttribute<User, Integer> typeUser;
    public static volatile ListAttribute<User, Stocktaking> stocktakingList;
    public static volatile SingularAttribute<User, String> name;
    public static volatile ListAttribute<User, Transaction> transactionList;

}