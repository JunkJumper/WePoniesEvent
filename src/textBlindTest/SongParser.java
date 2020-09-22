package textBlindTest;

import java.io.FileReader;
import java.io.BufferedReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class SongParser{
	
	private static List<Song> songs = new ArrayList<Song>();

	public static void readEnglish() throws IOException {
		BufferedReader in = new BufferedReader(new FileReader("./textFiles/songsEN.csv"));
		String line;
		String[] o;
		while ((line = in.readLine()) != null)
		{
			if(line.charAt(0) != '#') {
				o = line.split(";");
				SongParser.songs.add(new Song(o[0], "english", o[1], Integer.parseInt(o[2])));
				
				
				/*for (int i = 0; i < 3; i++) {
					System.out.print(o[i] + " - ");
				}
				System.out.println();*/
			}
			
		}
		in.close();
	}
	
	public static void readFrench() throws IOException {
		BufferedReader in = new BufferedReader(new FileReader("./textFiles/songsFR.csv"));
		String line;
		String[] o;
		while ((line = in.readLine()) != null)
		{
			if(line.charAt(0) != '#') {
				o = line.split(";");
				SongParser.songs.add(new Song(o[0], "french", o[1], Integer.parseInt(o[2])));
				
				
				/*for (int i = 0; i < 3; i++) {
					System.out.print(o[i] + " - ");
				}
				System.out.println();*/
			}
			
		}
		in.close();
	}
	
	public static void main(String[] args) throws IOException {
		readEnglish();
		System.out.println(songs.toString());
	}

	/**
	 * @return the songs
	 */
	public List<Song> getSongs() {
		return songs;
	}

	/**
	 * @param songs the songs to set
	 */
	public void setSongs(List<Song> songs) {
		SongParser.songs = songs;
	}
    
}