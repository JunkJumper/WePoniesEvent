package textBlindTest;

import java.util.ArrayList;
import java.util.List;

public class SongLibrary {
	private List<Song> bibli;
	
	public SongLibrary() {
		this.setBibli(new ArrayList<Song>());
	}
	
	protected void fillPlaylist(TranscriptSongParser tsp) {
		int i = 0;
		String lesLyrics = "";
		
		do {
			if(tsp.getListeSongLines().get(i).getSeason() == 99) {
				break;
			} else if(tsp.getListeSongLines().get(i).getName().equalsIgnoreCase(tsp.getListeSongLines().get(i+1).getName())) {
				lesLyrics += tsp.getListeSongLines().get(i).getLyric() + "-a-";
			} else {				//String n, String la, Lyrics l, int s, int e
				this.getBibli().add(new Song(tsp.getListeSongLines().get(i).getName(),
									tsp.getListeSongLines().get(i).getLang(),
									new Lyrics(lesLyrics),
									tsp.getListeSongLines().get(i).getSeason(),
									tsp.getListeSongLines().get(i).getEpisode()));
				lesLyrics = "";
			}
			i++;
		} while (i < tsp.getListeSongLines().size());
	}

	@Override
	public String toString() {
		// TODO Auto-generated method stub
		return this.getBibli().toString();
	}
	
	/**
	 * @return the bibli
	 */
	protected List<Song> getBibli() {
		return bibli;
	}

	/**
	 * @param bibli the bibli to set
	 */
	protected void setBibli(List<Song> bibli) {
		this.bibli = bibli;
	}
}
