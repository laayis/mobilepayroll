package com.zapto.park;

import android.media.MediaPlayer;
import android.media.MediaPlayer.OnCompletionListener;
import android.util.Log;

public class Sound {
	private static String LOG_TAG = "Sound";
	
	public static void play(int fileId) {
		if (!Globals.soundEnabled) return;
		
		MediaPlayer mp;
	 
		try {
			mp = MediaPlayer.create(ParkActivity.context, fileId);
			//mp.setVolume(1.0f, 1.0f);
			mp.start();
			mp.setOnCompletionListener(new OnCompletionListener() {
				@Override
				public void onCompletion(MediaPlayer mp) {
					mp.release();
					mp = null;
				}
			});
		} catch (Exception e) {
			Log.i(LOG_TAG, "Error playing sound.");
		}
	}
}
