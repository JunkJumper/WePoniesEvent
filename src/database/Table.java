package database;

/**
 * @Author: JunkJumper
 * @Link: https://github.com/JunkJumper
 * @Copyright: Creative Common 4.0 (CC BY 4.0)
 */

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

public class Table {
	
	private String name;
	private List<Record> list = new ArrayList<Record>();
	
	public Table() {
		this("");
	}
	
	public Table(String JavaTableName) {
		this.setName(JavaTableName);
	}

	public void fillList(String query) {
		this.list = DatabaseManager.remplirLocalTable(query);
	}
	
	public void remplirTableQuery(String query) {
		try (Connection connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/WePoniesDatabase", "WPmanager", "snowpearl1234")) {

            Statement statement = connection.createStatement();

            ResultSet retour = statement.executeQuery(query);
            while (retour.next()) {
            	list.add(new Record(retour.getInt(0), retour.getString(1), retour.getString(2), retour.getInt(3), retour.getInt(4)));
            }

        } catch (SQLException e) {
            System.out.println("Connection failure.");
            e.printStackTrace();
        }
	}

	protected String getName() {
		return name;
	}

	protected void setName(String name) {
		this.name = name;
	}

	protected List<Record> getList() {
		return list;
	}
	
	public String toString() {
		return this.getList().toString();
	}
	
	protected boolean isEmpty() {
		return this.getList().isEmpty();
	}
}
