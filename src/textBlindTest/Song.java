package textBlindTest;

public class Song {
	private String name;
	private String lang;
	private Lyrics lyric;
	private int season;
	private int episode;
	
	public Song() {
		
	}
	
	public Song(String n, String la, Lyrics l, int s, int e) {
		this.setName(n);
		this.setLang(la);
		this.setSeason(s);
		this.setEpisode(e);
		this.setLyric(l);
	}
	
	@Override
	public String toString() {
		return this.getName() + " : " + '"' + this.getLyric() + '"' + " - S" + this.getSeason() + "E" + this.getEpisode() + "\n";
		//return '"' + this.getLyric() + '"';
	}
	
	/**
	 * @param lyric the lyric to set
	 */
	protected void setLyric(Lyrics lyric) {
		this.lyric = lyric;
	}

	/**
	 * @return the name
	 */
	protected String getName() {
		return this.name;
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
		return this.lang;
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
	protected Lyrics getLyric() {
		return this.lyric;
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
		return this.episode;
	}

	/**
	 * @param episode the episode to set
	 */
	protected void setEpisode(int episode) {
		this.episode = episode;
	}
}
