package textBlindTest;

/**
 * @Author: JunkJumper
 * @Link: https://github.com/JunkJumper
 * @Copyright: Creative Common 4.0 (CC BY 4.0)
 */

import java.io.IOException;

public class Start {
	
	private static final int QUOTES_NUMBER = 1;
	
	public static int alea(int nb) {
		return (int) (Math.random() * nb);
	}
	
	private static class LocalGameManager {
		
		@SuppressWarnings("unused")
		public static void RandomQuote(SongLibrary library) throws InterruptedException {
			LocalGameManager.RandomQuote(library, 5);
		}
		
		public static void RandomQuote(SongLibrary library, int MAX) throws InterruptedException {
			
			int librarySize = library.getBibli().size()-1; //size of the song library 
			int getRandomLyricIndex = Start.alea(librarySize); //return the index of a random Song from the library
			int getSizeOfLyric = library.getBibli().get(getRandomLyricIndex).getLyric().getL().size()-1; //return the size of Lyrics String
			int lastIndexOfLyric = Start.alea(getSizeOfLyric); // return the last index of th elyrci (ex 9)
			if(lastIndexOfLyric <= MAX) {lastIndexOfLyric += MAX;}
			int currentRandomLyric = lastIndexOfLyric - MAX;
			
			while(currentRandomLyric < lastIndexOfLyric) {
				System.out.println(library.getBibli().get(getRandomLyricIndex).getLyric().getL().get(currentRandomLyric));
				currentRandomLyric++;
			}
			Thread.sleep(8000);
			System.out.println(library.getBibli().get(getRandomLyricIndex).getName());
		}
		
		@SuppressWarnings("unused")
		public static void SongFrom(SongLibrary library, int season, int episode) throws InterruptedException {
			int i = -1;
			for(int j = 0; j < library.getBibli().size(); j++) {
				if (library.getBibli().get(j).getEpisode() == episode && library.getBibli().get(j).getSeason() == season) {
					i = j;
				}
			}
			if(i != -1) {
				System.out.println(library.getBibli().get(i).toString());
			}
		}
	}
	
	public static void main(String[] args) throws IOException, InterruptedException {
		
		SongLibrary bibli = new SongLibrary();
		TranscriptSongParser tsp = new TranscriptSongParser();
		tsp.setListeSongLines(TranscriptSongParser.fillList());
		bibli.fillPlaylist(tsp);
		LocalGameManager.RandomQuote(bibli, QUOTES_NUMBER);
		//LocalGameManager.SongFrom(bibli, 8, 23);
	}

}
