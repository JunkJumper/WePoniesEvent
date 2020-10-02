package textBlindTest;

/**
 * @Author: JunkJumper
 * @Link: https://github.com/JunkJumper
 * @Copyright: Creative Common 4.0 (CC BY 4.0)
 */

import java.util.ArrayList;
import java.util.List;

public class Lyrics {
	private List<String> l = new ArrayList<>();
	
	public Lyrics(ArrayList<String> l) {
		this.setL(l);
	}
	
	public Lyrics(String s) {
		String[] sTab = s.split("-a-");
		 List<String> la = new ArrayList<>();
		 for (int i = 0; i < sTab.length; i++) {
			la.add(sTab[i] + " ");
		}
		 this.setL(la);
	}

	protected List<String> getL() {
		return l;
	}

	protected void setL(List<String> l) {
		this.l = l;
	}
	
	@Override
	public String toString() {
		String r = "";
		for (String string : l) {
			r += string;
		}
		return r;
	}
	
	public String toDBString() {
		String r = "";
		for (String string : l) {
			r += string + "-a-";
		}
		r = r.substring(0, r.length()-3);
		return r;
	}
}