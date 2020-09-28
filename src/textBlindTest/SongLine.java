package textBlindTest;

/**
 * @Author: JunkJumper
 * @Link: https://github.com/JunkJumper
 * @Copyright: Creative Common 4.0 (CC BY 4.0)
 */

public class SongLine {
	
	private String name;
	private String lang;
	private String lyric;
	private int season;
	private int episode;
	
	protected SongLine(String la, String ly, int s, int e) {
		this(null, la, ly, s, e);
	}
	
	protected SongLine(String n, String la, String ly, int s, int e) {
		this.setName(n);
		this.setLang(la);
		this.setLyric(ly);
		this.setSeason(s);
		this.setEpisode(e);
	}
	
	@Override
	public String toString() {
		return this.getName() + " : " + '"' + this.getLyric() + '"' + " - S" + this.getSeason() + "E" + this.getEpisode() + "\n";
		//return '"' + this.getLyric() + '"';
	}

	/**
	 * @return the name
	 */
	protected String getName() {
		return name;
	}

	/**
	 * @param name the name to set
	 */
	protected void setName(String name) {
		this.name = name;
	}

	/**
	 * @return the lang
	 */
	protected String getLang() {
		return lang;
	}

	/**
	 * @param lang the lang to set
	 */
	protected void setLang(String lang) {
		this.lang = lang;
	}

	/**
	 * @return the lyric
	 */
	protected String getLyric() {
		return lyric;
	}

	/**
	 * @param lyric the lyric to set
	 */
	protected void setLyric(String lyric) {
		this.lyric = lyric;
	}

	/**
	 * @return the season
	 */
	protected int getSeason() {
		return season;
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
	
}
