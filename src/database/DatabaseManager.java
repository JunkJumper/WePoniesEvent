package database;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

public class DatabaseManager {
	
	private final static String url = "jdbc:mysql://localhost:3306/WePoniesDatabase";
    private final static String user = "WPmanager";
    private final static String password = "snowpearl1234";
    private static Connection connection;
    
	 public static void connect() throws SQLException {
		 if(connection == null || connection.isClosed()) {
			 connection = DriverManager.getConnection(url, user, password);
	 		}
	  }
	 
	 public static List<Record> remplirLocalTable(String query) {
		 List<Record> list = new ArrayList<Record>();
		 	
		 //int i, String n, String l, int s, int e
		 	try{
		 		connect();
	            //System.out.println("Connected to PostgreSQL database!");
	            Statement statement = connection.createStatement();
	            //System.out.println("Reading records...");
	            ResultSet retour = statement.executeQuery(query);
	            while (retour.next()) {
	            	list.add(new Record(retour.getInt(0), retour.getString(1), retour.getString(2), retour.getInt(3), retour.getInt(4)));
	            }
	        } catch (SQLException e) {
	            System.err.println("Connection failure.");
	            e.printStackTrace();
	        }
		 return list;
	 }	
}
