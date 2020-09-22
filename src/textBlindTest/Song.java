package textBlindTest;

public class Song {
	
	private String name;
	private String lang;
	private String lyric;
	private int season;
	
	public Song () {
		this(null,null,null, 0);
	}
	
	public Song(String n, String la, String ly, int s) {
		this.setName(n);
		this.setLang(la);
		this.setLyric(ly);
		this.setSeason(s);
	}
	
	@Override
	public String toString() {
		return this.getName() + " : " + '"' + this.getLyric() + '"' + " - Season " + this.getSeason();
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
	
}
