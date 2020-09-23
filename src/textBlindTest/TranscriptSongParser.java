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
	private List<Song> listeQuotestoCheck;
	private List<Song> listeSongs;
	
	public TranscriptSongParser() {
		this.setListeQuotestoCheck(new ArrayList<Song>());
		
	}
	
	public static List<Song> ParseEnglish() throws IOException {
		
		Pattern pattern = Pattern.compile("^*@.+?@$"); //Regex to get all Strings of type "{any text}@{Song lyric}@"
		Matcher matcher;
		
		BufferedReader in = new BufferedReader(new FileReader("./textFiles/quotes_base_unformatted.txt"));
		String line; String[] o;
		List<Song> listeQuotesChecked = new ArrayList<Song>();
		while ((line = in.readLine()) != null)
		{
			o = line.split(";");
			matcher = pattern.matcher(o[3]);
			
			if(matcher.find()) {
				listeQuotesChecked.add(new Song("english", o[3].substring(1, o[3].length()-1), Integer.parseInt(o[0].substring(1)), Integer.parseInt(o[1].substring(1))));
			}
			
		}
		in.close();
		return listeQuotesChecked;
	}
	
	public static void writeEnglish(List<Song> l) throws IOException {
		File fichier = new File("./textFiles/englishSongs.txt");
		fichier.delete();
		fichier.createNewFile();
		PrintWriter writer = new PrintWriter("./textFiles/englishSongs.txt", "UTF-8");
		
		String s = new String();
		
		for (Song song : l) {
			s = "SongName;" + song.getLyric() + ";S" + song.getSeason() + ";E" + song.getEpisode();
			writer.println(s);
			System.out.println("Writing with format for lyric " + song.getLyric() + ".");
		}
		
		
		writer.close();
	}
	
public static List<Song> fillList() throws IOException {
		
		BufferedReader in = new BufferedReader(new FileReader("./textFiles/englishSongsWithName.txt"));
		String line; String[] o;
		List<Song> list = new ArrayList<Song>();
		while ((line = in.readLine()) != null)
		{
			if(line.charAt(0) != '#') {
				o = line.split(";");
				//Song Name;Song Lyric; Season; Episode
				list.add(new Song(o[0],"english",o[1], Integer.parseInt(o[2].substring(1)), Integer.parseInt(o[3].substring(1))));
			}
		}

		int i = (int)(Math.random()*460);
		int max = i+3;
		while(i < max) {
			System.out.println(list.get(i).toString());
			i++;
		}

		
		in.close();
		return list;
	}
	
	public static void main(String[] args) throws IOException {
		TranscriptSongParser tsp = new TranscriptSongParser();
		tsp.setListeQuotestoCheck(ParseEnglish());
		writeEnglish(tsp.getListeQuotestoCheck());
		tsp.setListeSongs(fillList());
	}

	public List<Song> getListeSongs() {
		return listeSongs;
	}

	public void setListeSongs(List<Song> listeSongs) {
		this.listeSongs = listeSongs;
	}

	public List<Song> getListeQuotestoCheck() {
		return this.listeQuotestoCheck;
	}

	public void setListeQuotestoCheck(List<Song> listeQuotestoCheck) {
		this.listeQuotestoCheck = listeQuotestoCheck;
	}
	
	
}
