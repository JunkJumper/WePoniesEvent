package textBlindTest;

/**
 * @Author: JunkJumper
 * @Link: https://github.com/JunkJumper
 * @Copyright: Creative Common 4.0 (CC BY 4.0)
 */

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
//import java.util.ArrayList;

public class Start {
	public static void main(String[] args) throws IOException, InterruptedException {
		List<Song> library = new ArrayList<>();
		TranscriptSongParser tsp = new TranscriptSongParser();
		
		/*
		 * CALL IT ONLY ONE TIME !!!
		 */
					//initialise(tsp);
		/*
		 * CALL IT ONLY ONE TIME !!!
		 */

		tsp.setListeSongLines(TranscriptSongParser.fillList());
		//System.out.println(tsp.toString());
		
		int i = 0;
		String lesLyrics = "";
		
		do {
			if(tsp.getListeSongLines().get(i).getSeason() == 99) {
				break;
			} else if(tsp.getListeSongLines().get(i).getName().equalsIgnoreCase(tsp.getListeSongLines().get(i+1).getName())) {
				lesLyrics += tsp.getListeSongLines().get(i).getLyric() + "-a-";
			} else {				//String n, String la, Lyrics l, int s, int e
				library.add(new Song(tsp.getListeSongLines().get(i).getName(),
									tsp.getListeSongLines().get(i).getLang(),
									new Lyrics(lesLyrics),
									tsp.getListeSongLines().get(i).getSeason(),
									tsp.getListeSongLines().get(i).getEpisode()));
				lesLyrics = "";
			}
			i++;
		} while (i < tsp.getListeSongLines().size());
		
		//System.out.println(library.toString());
		
		
		int j = (int)(Math.random()*library.size()-1);
		int maxLyricNumber = (int)(Math.random()*library.get(j).getLyric().getL().size());
		int lyricNumber = maxLyricNumber - 5;
		
		if(j <= 0) {
			j += 5;
		}
		
		if(maxLyricNumber <= 0) {
			maxLyricNumber += 5;
		}
		
		if(lyricNumber <= 0) {
			lyricNumber += 5;
		}
		
		while(lyricNumber < maxLyricNumber) {
			System.out.println(library.get(j).getLyric().getL().get(lyricNumber));
			lyricNumber++;
		}
		Thread.sleep(8000);
		System.out.println(library.get(j).getName());
		
		//System.out.println(library.get(1).toString());
		
	}

}
