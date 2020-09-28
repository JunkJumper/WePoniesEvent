package textBlindTest;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class SongLibrary {
	private List<Song> playlist = new ArrayList<Song>();

	protected SongLibrary() throws IOException {
		this.playlist = SongManager.createSongs();
	}
	
	protected void addSong(Song s) {
		this.getPlaylist().add(s);
	}
	
	/**
	 * @return the playlist
	 */
	protected List<Song> getPlaylist() {
		return this.playlist;
	}
	
	@Override
	public String toString() {
		return this.getPlaylist().toString();
	}
	
	
	
}
