package textBlindTest;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class Song {
	
	private String name;
	private int season;
	private int episode;
	private List<String> lyrics = new ArrayList<String>();
	private TranscriptSongParser tsp = new TranscriptSongParser();
	
	public Song (int s, int e) throws IOException {
		tsp.setListeSongLines(TranscriptSongParser.fillList());
		this.setSeason(s);
		this.setEpisode(e);
		this.fillLyrics(SongManager.setCompleteLyric(tsp, s, e));
	}
	
	protected void fillLyrics(ArrayList<String> lyrics) {
		this.setLyrics(lyrics);
	}

	/**
	 * @return the season
	 */
	protected int getSeason() {
		return this.season;
	}

	/**
	 * @param season the season to set
	 */
	protected void setSeason(int season) {
		this.season = season;
	}

	/**
	 * @return the episode
	 */
	protected int getEpisode() {
		return episode;
	}

	/**
	 * @param episode the episode to set
	 */
	protected void setEpisode(int episode) {
		this.episode = episode;
	}

	/**
	 * @return the lyrics
	 */
	protected List<String> getLyrics() {
		return lyrics;
	}
	
	/**
	 * @param lyrics the lyrics to set
	 */
	protected void setLyrics(List<String> lyrics) {
		this.lyrics = lyrics;
	}
	
	/**
	 * @return the name
	 */
	public String getName() {
		return name;
	}

	/**
	 * @param name the name to set
	 */
	public void setName(String name) {
		this.name = name;
	}
	
	@Override
	public String toString() {
		String s = " ";
		for (String strings : lyrics) {
			s += strings;
		}
		return s;
	}


	
	
}
