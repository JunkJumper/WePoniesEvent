package textBlindTest;

/**
 * @Author: JunkJumper
 * @Link: https://github.com/JunkJumper
 * @Copyright: Creative Common 4.0 (CC BY 4.0)
 */

import java.io.IOException;

public class Start {
	
	private static class LocalGameManager {
		
		public static void getRandomQuote(SongLibrary library) throws InterruptedException {
			int j = library.getBibli().size()-1;
			int maxLyricNumber = (int)(Math.random()*library.getBibli().get(j).getLyric().getL().size());
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
				System.out.println(library.getBibli().get(j).getLyric().getL().get(lyricNumber));
				lyricNumber++;
			}
			Thread.sleep(8000);
			System.out.println(library.getBibli().get(j).getName());
		}
		
		@SuppressWarnings("unused")
		public static void getSongFrom(SongLibrary library, int season, int episode) throws InterruptedException {
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
		LocalGameManager.getRandomQuote(bibli);
		//LocalGameManager.getSongFrom(bibli, 8, 23);
	}

}
