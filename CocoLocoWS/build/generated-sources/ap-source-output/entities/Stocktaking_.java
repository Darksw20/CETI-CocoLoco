package entities;

import entities.Transaction;
import entities.User;
import javax.annotation.Generated;
import javax.persistence.metamodel.ListAttribute;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="EclipseLink-2.5.2.v20140319-rNA", date="2018-12-10T08:06:38")
@StaticMetamodel(Stocktaking.class)
public class Stocktaking_ { 

    public static volatile SingularAttribute<Stocktaking, Integer> lot;
    public static volatile SingularAttribute<Stocktaking, byte[]> image;
    public static volatile SingularAttribute<Stocktaking, User> userUserName;
    public static volatile SingularAttribute<Stocktaking, Integer> rate;
    public static volatile SingularAttribute<Stocktaking, String> subClass;
    public static volatile SingularAttribute<Stocktaking, String> class1;
    public static volatile ListAttribute<Stocktaking, Transaction> transactionList;
    public static volatile SingularAttribute<Stocktaking, Integer> id;
    public static volatile SingularAttribute<Stocktaking, String> productName;
    public static volatile SingularAttribute<Stocktaking, String> productDescription;

}