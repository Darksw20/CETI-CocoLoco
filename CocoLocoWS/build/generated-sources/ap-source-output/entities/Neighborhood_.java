package entities;

import entities.User;
import javax.annotation.Generated;
import javax.persistence.metamodel.ListAttribute;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="EclipseLink-2.5.2.v20140319-rNA", date="2018-12-10T08:06:38")
@StaticMetamodel(Neighborhood.class)
public class Neighborhood_ { 

    public static volatile SingularAttribute<Neighborhood, Integer> code;
    public static volatile SingularAttribute<Neighborhood, Integer> pc;
    public static volatile ListAttribute<Neighborhood, User> userList;
    public static volatile SingularAttribute<Neighborhood, String> name;

}