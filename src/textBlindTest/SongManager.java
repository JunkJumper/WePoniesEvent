package textBlindTest;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class SongManager {

	protected static ArrayList<String> setCompleteLyric(TranscriptSongParser tsp, int s, int e) {
		List<String> l = new ArrayList<String>();
		
		for (SongLine sl : tsp.getListeSongLines()) {
			if((sl.getSeason() == s) && (sl.getEpisode() == e)) {
				//System.out.print(sl); //just to test
				l.add(sl.getLyric());
			}
		}
		
		if(!l.isEmpty()) {
			return (ArrayList<String>) l;
		} else {
			return null;
		}
		
		
	}
	
	protected static ArrayList<Song> createSongs() throws IOException {
		List<Song> l = new ArrayList<Song>();
		for (int s = 0; s < 10; s++) {
			for (int e = 0; e < 27; e++) {
				l.add(new Song(s, e));
			}
		}
		return (ArrayList<Song>) l;
	}
	
}
