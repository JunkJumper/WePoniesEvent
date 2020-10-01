package database;

/**
 * @Author: JunkJumper
 * @Link: https://github.com/JunkJumper
 * @Copyright: Creative Common 4.0 (CC BY 4.0)
 */

import java.io.IOException;

public class DatabaseTesting {
    public static void main(String[] args) throws IOException {
    	Table a = new Table("a");
    	
    	a.fillList(QueryGenerator.AllFrom(""));
    	System.out.println(a.toString());
    	
    	
    	
    }
}

