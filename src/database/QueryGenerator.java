package database;

/**
 * @Author: JunkJumper
 * @Link: https://github.com/JunkJumper
 * @Copyright: Creative Common 4.0 (CC BY 4.0)
 */

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class QueryGenerator {
	
	private final static String url = "jdbc:postgresql://localhost:3306/WePoniesDatabase";
    private final static String user = "WPmanager";
    private final static String password = "snowpearl1234";

    public static String getTable(String tableName) {
		return "public." + '"' + tableName + '"';
	}
    
	public static String AllFrom(String tableName) {
		return "SELECT * FROM " + getTable(tableName);
	}
	
	public static String WithId(String tableName, int d) {
		return "SELECT * FROM " + getTable(tableName) + "WHERE id =" + d;
	}
	
	public static String WithName(String tableName, String name) {
		return "SELECT * FROM " + getTable(tableName) + "WHERE nom ='" + name + "'";
	}
	
	public static String getIdWithNameFrom(String table, String name) {
		return "SELECT 'id' FROM " + getTable(table) + "WHERE nom ='" + name + "'";
	}
	
	public static String getNameWithIdFrom(String table, int d) {
		return "SELECT name FROM " + getTable(table) + "WHERE id =" + d;
	}
	
	public static String selectObjectWithId(int id, String tableName) {
		return "SELECT objet FROM" + getTable(tableName) + " WHERE id =" + id;
	}
	
	 public static Connection connect() throws SQLException {
	        return DriverManager.getConnection(url, user, password);
	 }
	
}
