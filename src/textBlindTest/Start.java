package textBlindTest;

import java.io.IOException;
//import java.util.ArrayList;

public class Start {
	public static void main(String[] args) throws IOException {
		//TranscriptSongParser tsp = new TranscriptSongParser();
		
		/*
		 * CALL IT ONLY ONE TIME !!!
		 */
					//initialise(tsp);
		/*
		 * CALL IT ONLY ONE TIME !!!
		 */

		//tsp.setListeSongLines(TranscriptSongParser.fillList());
		//ArrayList<String> as = SongManager.setCompleteLyric(tsp, 1, 9); //just to test
		
		SongLibrary sl = new SongLibrary();
		System.out.println(sl.toString());
	}

}
