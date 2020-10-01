package database;

/**
 * @Author: JunkJumper
 * @Link: https://github.com/JunkJumper
 * @Copyright: Creative Common 4.0 (CC BY 4.0)
 */

public class Record {

	private int id;
	private String nameSong;
	private String lyricSong;
	private int seasonSong;
	private int episodeSong;
	
	public Record(int i, String n, String l, int s, int e) {
		this.setId(i);
		this.setNameSong(n);
		this.setLyricSong(l);
		this.setSeasonSong(s);
		this.setEpisodeSong(e);
	}
	
	/**
	 * @return the id
	 */
	protected int getId() {
		return id;
	}
	/**
	 * @param id the id to set
	 */
	protected void setId(int id) {
		this.id = id;
	}
	/**
	 * @return the nameSong
	 */
	protected String getNameSong() {
		return nameSong;
	}
	/**
	 * @param nameSong the nameSong to set
	 */
	protected void setNameSong(String nameSong) {
		this.nameSong = nameSong;
	}
	/**
	 * @return the lyricSong
	 */
	protected String getLyricSong() {
		return lyricSong;
	}
	/**
	 * @param lyricSong the lyricSong to set
	 */
	protected void setLyricSong(String lyricSong) {
		this.lyricSong = lyricSong;
	}
	/**
	 * @return the seasonSong
	 */
	protected int getSeasonSong() {
		return seasonSong;
	}
	/**
	 * @param seasonSong the seasonSong to set
	 */
	protected void setSeasonSong(int seasonSong) {
		this.seasonSong = seasonSong;
	}
	/**
	 * @return the episodeSong
	 */
	protected int getEpisodeSong() {
		return episodeSong;
	}
	/**
	 * @param episodeSong the episodeSong to set
	 */
	protected void setEpisodeSong(int episodeSong) {
		this.episodeSong = episodeSong;
	}
}
