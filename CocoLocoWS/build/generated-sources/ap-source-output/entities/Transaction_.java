package entities;

import entities.Stocktaking;
import entities.User;
import java.util.Date;
import javax.annotation.Generated;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="EclipseLink-2.5.2.v20140319-rNA", date="2018-12-10T08:06:38")
@StaticMetamodel(Transaction.class)
public class Transaction_ { 

    public static volatile SingularAttribute<Transaction, Date> date;
    public static volatile SingularAttribute<Transaction, Integer> amount;
    public static volatile SingularAttribute<Transaction, User> userUserName;
    public static volatile SingularAttribute<Transaction, Integer> folio;
    public static volatile SingularAttribute<Transaction, Stocktaking> stocktakingID;

}