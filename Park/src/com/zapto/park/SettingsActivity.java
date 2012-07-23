package com.zapto.park;

import android.content.ContentValues;
import android.os.Bundle;
import android.preference.Preference;
import android.preference.Preference.OnPreferenceChangeListener;
import android.preference.PreferenceActivity;
import android.widget.Toast;

public class SettingsActivity extends PreferenceActivity {
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		addPreferencesFromResource(R.xml.settingspref);

		// We want to add a validator to the number of circles so that it only accepts numbers
		Preference keyPreference = getPreferenceScreen().findPreference("license_key");
		keyPreference.setOnPreferenceChangeListener(new OnPreferenceChangeListener() {
			@Override
			public boolean onPreferenceChange(Preference preference, Object newValue) {
				// Check that the string is an integer
				if (newValue != null && newValue.toString().length() > 0) {
					String key = newValue.toString();
					ContentValues cv = new ContentValues();
					cv.put("totable_license", key);
					
					try {
						String response = SendPost.sendPostRequest("app/updatekey.php", cv);
						if (response.equals("1")) {
							Globals.LICENSE_KEY = key;
							Toast.makeText(SettingsActivity.this, "Key Successful.", Toast.LENGTH_SHORT).show();
							return true;
						}
					} catch (Exception e) {
						Toast.makeText(SettingsActivity.this, "Error updating key.", Toast.LENGTH_SHORT).show();
						return false;
					}
				}
				// If now create a message to the user
				Toast.makeText(SettingsActivity.this, "Key Invalid.", Toast.LENGTH_SHORT).show();
				return false;
			}
		});
	}
}
