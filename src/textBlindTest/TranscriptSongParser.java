package textBlindTest;

import java.io.FileReader;
import java.util.List;
import java.util.regex.Pattern;
import java.io.BufferedReader;
import java.io.IOException;
//import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.regex.*;

public class TranscriptSongParser {

	public static void readEnglish() throws IOException {
		
		Pattern pattern = Pattern.compile("^*@.+?@$");
		Matcher matcher;
		
		BufferedReader in = new BufferedReader(new FileReader("./textFiles/quotes_base_unformatted.txt"));
		//PrintWriter writer = new PrintWriter("./textFiles/songs.txt", "UTF-8");
		String line;
		String[] o;
		List<Song> listeQuotestoCheck = new ArrayList<Song>();
		while ((line = in.readLine()) != null)
		{
			o = line.split(";");
			matcher = pattern.matcher(o[3]);
			
			if(matcher.find()) {
				listeQuotestoCheck.add(new Song("english", o[3].substring(1, o[3].length()-1), Integer.parseInt(o[0].substring(1)), Integer.parseInt(o[1].substring(1))));
			}
			
		}
		System.out.println(listeQuotestoCheck.toString());
		in.close();
	}
	
	public static void main(String[] args) throws IOException {
		readEnglish();
	}
	
	
}
