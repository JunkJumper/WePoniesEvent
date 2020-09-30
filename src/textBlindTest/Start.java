package textBlindTest;

import java.io.IOException;
//import java.util.ArrayList;

public class Start {
	public static void main(String[] args) throws IOException {
		TranscriptSongParser tsp = new TranscriptSongParser();
		
		/*
		 * CALL IT ONLY ONE TIME !!!
		 */
					//initialise(tsp);
		/*
		 * CALL IT ONLY ONE TIME !!!
		 */

		tsp.setListeSongLines(TranscriptSongParser.fillList());
		System.out.println(tsp.toString());
	}

}
