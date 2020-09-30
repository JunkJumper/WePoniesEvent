package textBlindTest;

/**
 * @Author: JunkJumper
 * @Link: https://github.com/JunkJumper
 * @Copyright: Creative Common 4.0 (CC BY 4.0)
 */

import java.io.FileReader;
import java.util.List;
import java.util.regex.Pattern;
import java.io.BufferedReader;
import java.io.File;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.regex.*;

public class TranscriptSongParser {
	private List<SongLine> listeQuotestoCheck;
	private List<SongLine> listeSongLines;
	
	protected TranscriptSongParser() {
		this.setListeQuotestoCheck(new ArrayList<SongLine>());
		
	}
	
	protected static void initialise(TranscriptSongParser tsp) throws IOException {
		/**
		 * Call it only one time
		 */
		tsp.setListeQuotestoCheck(ParseEnglish());
		writeEnglish(tsp.getListeQuotestoCheck());
		
	}
	
	protected static List<SongLine> ParseEnglish() throws IOException {
		
		Pattern pattern = Pattern.compile("^*@.+?@$"); //Regex to get all Strings of type "{any text}@{SongLine lyric}@"
		Matcher matcher;
		
		BufferedReader in = new BufferedReader(new FileReader("./textFiles/quotes_base_unformatted.txt"));
		String line; String[] o;
		List<SongLine> listeQuotesChecked = new ArrayList<SongLine>();
		while ((line = in.readLine()) != null)
		{
			o = line.split(";");
			matcher = pattern.matcher(o[3]);
			
			if(matcher.find()) {
				listeQuotesChecked.add(new SongLine("english", o[3].substring(1, o[3].length()-1), Integer.parseInt(o[0].substring(1)), Integer.parseInt(o[1].substring(1))));
			}
			
		}
		in.close();
		return listeQuotesChecked;
	}
	
	protected static void writeEnglish(List<SongLine> l) throws IOException {
		File fichier = new File("./textFiles/englishSongLines.txt");
		fichier.delete();
		fichier.createNewFile();
		PrintWriter writer = new PrintWriter("./textFiles/englishSong.txt", "UTF-8");
		
		String s = new String();
		
		for (SongLine SongLine : l) {
			s = "SongLineName;" + SongLine.getLyric() + ";S" + SongLine.getSeason() + ";E" + SongLine.getEpisode();
			writer.println(s);
			System.out.println("Writing with format for lyric " + SongLine.getLyric() + ".");
		}
		
		
		writer.close();
	}
	
	protected static List<SongLine> fillList() throws IOException {
		
		BufferedReader in = new BufferedReader(new FileReader("./textFiles/englishSongsWithName.txt"));
		String line; String[] o;
		List<SongLine> list = new ArrayList<SongLine>();
		while ((line = in.readLine()) != null)
		{
			if(line.charAt(0) != '#') {
				o = line.split(";");
				//SongLine Name;SongLine Lyric; Season; Episode
				list.add(new SongLine(o[0],"english",o[1], Integer.parseInt(o[2].substring(1)), Integer.parseInt(o[3].substring(1))));
			}
		}

		/*
		int i = (int)(Math.random()*list.size());
		int max = i+2;
		while(i < max) {
			System.out.println(list.get(i).toString());
			i++;
		}
		 */
		//testing only

		
		in.close();
		return list;
	}
	
		
	@Override
	public String toString() {
		return this.getListeSongLines().toString();
	}

	protected List<SongLine> getListeSongLines() {
		return listeSongLines;
	}

	protected void setListeSongLines(List<SongLine> listeSongLines) {
		this.listeSongLines = listeSongLines;
	}

	private List<SongLine> getListeQuotestoCheck() {
		return this.listeQuotestoCheck;
	}

	protected void setListeQuotestoCheck(List<SongLine> listeQuotestoCheck) {
		this.listeQuotestoCheck = listeQuotestoCheck;
	}
	
	
}
