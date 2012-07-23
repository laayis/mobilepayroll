package com.zapto.park;

import java.util.Date;

public class Util {
	// Formats date to yyyy-mm-dd hh:mm
	public static String dateTimestamp(Date date) {
		int year = date.getYear() + 1900;
		int month = date.getMonth() + 1;
		int day = date.getDate();
		
		int hour = date.getHours();
		int minutes = date.getMinutes();
		int seconds = date.getSeconds();
		
		return "" + year + "-" + month + "-" + day + " " + hour + ":" + minutes + ":" + seconds;
	}
}