package textBlindTest;

/**
 * @Author: JunkJumper
 * @Link: https://github.com/JunkJumper
 * @Copyright: Creative Common 4.0 (CC BY 4.0)
 */

public class Song {
	
	private String name;
	private String lang;
	private String lyric;
	private int season;
	private int episode;
	
	public Song(String la, String ly, int s, int e) {
		this(null, la, ly, s, e);
	}
	
	public Song(String n, String la, String ly, int s, int e) {
		this.setName(n);
		this.setLang(la);
		this.setLyric(ly);
		this.setSeason(s);
		this.setEpisode(e);
	}
	
	@Override
	public String toString() {
		return this.getName() + " : " + '"' + this.getLyric() + '"' + " - S" + this.getSeason() + "E" + this.getEpisode() + "\n";
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

	/**
	 * @return the lang
	 */
	public String getLang() {
		return lang;
	}

	/**
	 * @param lang the lang to set
	 */
	public void setLang(String lang) {
		this.lang = lang;
	}

	/**
	 * @return the lyric
	 */
	public String getLyric() {
		return lyric;
	}

	/**
	 * @param lyric the lyric to set
	 */
	public void setLyric(String lyric) {
		this.lyric = lyric;
	}

	/**
	 * @return the season
	 */
	public int getSeason() {
		return season;
	}

	/**
	 * @param season the season to set
	 */
	public void setSeason(int season) {
		this.season = season;
	}

	/**
	 * @return the episode
	 */
	public int getEpisode() {
		return episode;
	}

	/**
	 * @param episode the episode to set
	 */
	public void setEpisode(int episode) {
		this.episode = episode;
	}
	
}
