package com.zapto.park;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.TextView;

public class PadActivity extends Activity {
	private static String LOG_TAG = "PadActivity";
	
	private Intent intent;
	private TextView padText;
	
	public void onCreate(Bundle savedBundle) {
		super.onCreate(savedBundle);
		setContentView(R.layout.pad);
		
		intent = getIntent();
		
		padText = (TextView) findViewById(R.id.pad_text);
	}
	
	public void padClick(View v) {
		Log.i(LOG_TAG, "Pad clicked.");
		String ch = null;
		
		switch (v.getId()) {
		case R.id.pad_0:
			ch = "0";
			break;
		case R.id.pad_1:
			ch = "1";
			break;
		case R.id.pad_2:
			ch = "2";
			break;
		case R.id.pad_3:
			ch = "3";
			break;
		case R.id.pad_4:
			ch = "4";
			break;
		case R.id.pad_5:
			ch = "5";
			break;
		case R.id.pad_6:
			ch = "6";
			break;
		case R.id.pad_7:
			ch = "7";
			break;
		case R.id.pad_8:
			ch = "8";
			break;
		case R.id.pad_9:
			ch = "9";
			break;
		case R.id.pad_clear:
			padClear();
			break;
		case R.id.pad_back:
			padBack();
			break;
		case R.id.pad_done:
			padDone();
			break;
		default:
			break;
		}
		
		if (ch != null) {
			padNumber(ch);
		}
	}
	
	private void padNumber(String n) {
		padText.append(n);
	}
	
	private void padClear() {
		padText.setText("");
	}
	
	private void padBack() {
		String text = padText.getText().toString();
		if (text.length() > 0) {
			text = text.substring(0, text.length()-1);
			padText.setText(text);
		}
	}
	
	private void padDone() {
		String text = padText.getText().toString();
		intent.putExtra("result", text);
		setResult(RESULT_OK, intent);
		finish();
	}
}
