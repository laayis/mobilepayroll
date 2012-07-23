package com.zapto.park;

import java.util.Date;
import java.util.LinkedList;
import org.json.JSONArray;
import org.json.JSONObject;

import com.zapto.park.database.EmployeeDB;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.Dialog;
import android.content.ContentValues;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.database.Cursor;
import android.os.Bundle;
import android.os.Handler;
import android.preference.PreferenceManager;
import android.view.*;
import android.widget.*;
import android.util.Log;

public class ParkActivity extends Activity {
	private SendPost temp;
	private static String LOG_TAG = "ParkActivity";
	LinkedList<String[]> checkin = new LinkedList<String[]>();
	
	// Results
	private static int ACTIVITY_RESULT_PAD = 1;
	
	public static Context context;
	private Activity cActivity = ParkActivity.this;
	
	public void onCreate(Bundle savedInstance) {
		super.onCreate(savedInstance);
		setContentView(R.layout.main);
		context = getApplicationContext();
		
		Button button_checkIn = (Button) findViewById(R.id.button_checkin);
		Button button_forma = (Button) findViewById(R.id.button_forma);
		
		button_checkIn.setOnClickListener(new View.OnClickListener() {
			@Override
			public void onClick(View v) {
				Log.i(LOG_TAG, "Check-in clicked.");
				Intent intent = new Intent(context, PadActivity.class);
				startActivityForResult(intent, ACTIVITY_RESULT_PAD);
			}
		});
		
		button_forma.setOnClickListener(new View.OnClickListener() {
			@Override
			public void onClick(View v) {
				Log.i(LOG_TAG, "Check-in clicked.");
				Intent intent = new Intent(context, PadActivity.class);
				startActivityForResult(intent, ACTIVITY_RESULT_PAD);
			}
		});

		Log.i(LOG_TAG, "LICENSE KEY1: " + Globals.LICENSE_KEY);
	}
	
	public void doInit() {
		Date date = new Date() {
			@Override
    		public String toString() {
    			int month = this.getMonth()+1;
    			int day = this.getDate();
    			int year = this.getYear() + 1900;
    			return (month+1) + "/" + day + "/" + year;
    		}
    	};
    	
		SharedPreferences prefs = PreferenceManager.getDefaultSharedPreferences(context);
    	SharedPreferences.Editor editor = prefs.edit();
		Globals.LICENSE_KEY = prefs.getString("license_key", "");
		String date_employees = prefs.getString("date_employees", "");
		if (!date_employees.equals(date.toString())) {
			// First run so set the preference and get employees.
			editor.putString("date_employees", date.toString());
			editor.commit();
			updateEmployees();
		}
		
		boolean soundEnabled = prefs.getBoolean("sound_enabled", false);
		Globals.soundEnabled = soundEnabled;
	}
	
	@Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
    	super.onActivityResult(requestCode, resultCode, data);
    	
    	if (resultCode == Activity.RESULT_OK && requestCode == ACTIVITY_RESULT_PAD) {
    		Log.i(LOG_TAG, "onActivityResult()");
    		Bundle extras = data.getExtras();
    		String result = extras.getString("result");
    		
    		employeeCheck(result, true);
    		
    		Log.i(LOG_TAG, "Result: " + result);
    	} else {
    		Log.i(LOG_TAG, "onActivityResult(). Problem!");
    	}
    }
	
	public void employeeCheck(String idValue, boolean checkType) {
		EmployeeDB edb = new EmployeeDB(context);
		Date date = new Date();
		String timeStamp = Util.dateTimestamp(date);
		
		int id = 0;
		try {
			id = new Integer(idValue);
		} catch (Exception e) {
			return;
		}
		
		String checkStatus = "";
		String employee_name = "";
		int sent = 0;
		
		ContentValues cv = new ContentValues();
		cv.put("totable_license", Globals.LICENSE_KEY);
		cv.put("totable_id", idValue);
		cv.put("totable_date", timeStamp);
		cv.put("totable_inout", checkType == true ? "1" : "1");
		
		// Send request.
		try {
			String response = SendPost.sendPostRequest("app/clockuser.php", cv);
			employee_name = edb.getName(id);
			
			if (response.equals("1")) {
				sent = 1;
				checkStatus = "Punch Successful";
				Sound.play(R.raw.success);
				if (employee_name.length() >   0) { checkStatus += ": " + employee_name; }
			} else if (response.equals("0")) {
				// Request failed.
				sent = 0;
				Sound.play(R.raw.fail);
				checkStatus = "No ID exists.";
			}
			
			Log.i(LOG_TAG, "Response: " + response);
			
		} catch (Exception e) {
			// Unable to send request.
			Log.i(LOG_TAG, "Error clocking request.");
			sent = 0;
			
			// Is the employee is currently in the database. We're good.
			if (edb.hasEmployee(id)) {
				checkStatus = "Punch Successful";
				Sound.play(R.raw.success);
				if (employee_name.length() >   0) { checkStatus += ": " + employee_name; }
			} else {
				// This is currently not a valid ID.
				Sound.play(R.raw.fail);
				checkStatus = "No ID exists.";
			}
		}
		
		// Log request in database.
		ContentValues cv2 = new ContentValues();
		cv2.put("license", Globals.LICENSE_KEY);
		cv2.put("employee_id", idValue);
		cv2.put("date", timeStamp);
		cv2.put("inout", checkType == true ? "1" : "1");
		cv2.put("sent", "" + sent);
		
		// Query database.
		edb.clockEmployee(cv2);
		
		// Close our database.
		edb.close();
		
		Toast.makeText(cActivity, checkStatus, Toast.LENGTH_LONG).show();
	}
	
	public boolean onCreateOptionsMenu(Menu menu) {
		super.onCreateOptionsMenu(menu);
    	
		MenuItem item = menu.add(Menu.NONE, 1, Menu.NONE, "Create User");
    	item.setIcon(android.R.drawable.ic_menu_myplaces);
    	
    	MenuItem item2 = menu.add(Menu.NONE, 2, Menu.NONE, "Settings");
    	item2.setIcon(android.R.drawable.ic_menu_manage);
    	
    	MenuItem item3 = menu.add(Menu.NONE, 3, Menu.NONE, "View Log");
    	item3.setIcon(android.R.drawable.ic_menu_manage);
    	
    	return true;
	}
	
	public boolean onOptionsItemSelected(MenuItem item) {
		Intent i=null;
		switch (item.getItemId()) {
		// Add User
		case 1:
			Dialog d = new Dialog(cActivity);
			final Dialog dialog = d;
			d.setContentView(R.layout.dialog_add_employee);
			d.setTitle(R.string.create_user_title);
			
			final EditText first_name = (EditText) d.findViewById(R.id.employee_first);
			final EditText last_name = (EditText) d.findViewById(R.id.employee_last);
			Button button_getinfo = (Button) d.findViewById(R.id.button_getinfo);
			
			button_getinfo.setOnClickListener(new View.OnClickListener() {
				@Override
				public void onClick(View v) {
					String first = first_name.getText().toString();
					String last = last_name.getText().toString();
					
					ContentValues cv = new ContentValues();
					cv.put("totable_first", first);
					cv.put("totable_last", last);
					cv.put("totable_license", Globals.LICENSE_KEY);
					
					try {
						String response = SendPost.sendPostRequest("app/addemployee.php", cv);
						
						Log.i(LOG_TAG, "Add Response: " + response);
						
						JSONObject json_object = new JSONObject(response);
						JSONObject json_employee = json_object.getJSONObject("employee");
						String username = json_employee.getString("username");
						String password = json_employee.getString("password");
						
						makeAlertDialog("User Info:", "Username: " + username + "\nPassword: " + password).show();
					} catch (Exception e) {
						Toast.makeText(cActivity, "Error getting info.", Toast.LENGTH_LONG).show();
					} finally {
						dialog.dismiss();
					}
				}
			});
			
			d.show();
			
			break;
		// Settings
		case 2:
			Log.i(LOG_TAG, "Settings menu clicked.");
			i = new Intent(this, SettingsActivity.class);
			startActivity(i);
			break;
		case 3:
			Log.i(LOG_TAG, "View Log Loading.");
			i = new Intent(this, ListViewActivity.class);
			startActivity(i);
			break;
		}
	
		return true;
	}
	
	// Calls loadEmployees() in the threaded manner.
	public void updateEmployees() {
		Log.i(LOG_TAG, "Updating employees.");
		Handler handler = new Handler();
		handler.post(new Runnable() {
			@Override
			public void run() {
				loadEmployees();
			}
		});
	}
	
	// Clears the existing employee table and loads a fresh list of employees from the server.
	public void loadEmployees() {
		try {
			ContentValues cv = new ContentValues();
			cv.put("totable_license", Globals.LICENSE_KEY);
			String response = SendPost.sendPostRequest("app/getemployees.php", cv);
			
			JSONObject json_object = new JSONObject(response);
			JSONArray employees = json_object.getJSONArray("employees");
			
			// Clear existing employees first.
			EmployeeDB edb = new EmployeeDB(context);
			edb.clearEmployees();
			
			for (int i = 0; i < employees.length(); i++) {
				JSONObject e = employees.getJSONObject(i);
				int id = new Integer(e.getString("id"));
				String first = e.getString("first");
				String last = e.getString("last");
				
				Log.i(LOG_TAG, "Loading employee, First: " + first + " , Last: " + last);
				
				cv = new ContentValues();
				cv.put("employee_id", id);
				cv.put("first", first);
				cv.put("last", last);
				
				// Add employee to database.
				edb.insertEmployee(cv);
			}
			
			// Close database.
			edb.close();
		} catch (Exception e) {
			Toast.makeText(cActivity, "Error loading employees.", Toast.LENGTH_LONG).show();
		}
	}
	
	public AlertDialog makeAlertDialog(String title, String message) {
		AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle(title)
            //.setIcon(android.R.drawable.stat_sys_warning)
            .setMessage(message)
            .setCancelable(true)
            .setPositiveButton(android.R.string.ok, null);
            /*.setNegativeButton(R.string.learn_more, new DialogInterface.OnClickListener() {
                public void onClick(DialogInterface dialog, int which) {
                    Intent intent = new Intent(Intent.ACTION_VIEW, helpUri);
                    startActivity(intent);
                }
            });*/
        return builder.create();
	}
	
	public void doPendingRequests() {
		EmployeeDB edb = new EmployeeDB(context);
		// Cursor of pending requests.
		Cursor cursor = edb.pendingClock();
		while (cursor.moveToNext()) {
			Log.i(LOG_TAG, "Sending pending request.");
			
			int _id = cursor.getInt(cursor.getColumnIndex("_id"));
			String license = cursor.getString(cursor.getColumnIndex("license"));
			int employee_id = cursor.getInt(cursor.getColumnIndex("employee_id"));
			String date = cursor.getString(cursor.getColumnIndex("date"));
			int inout = cursor.getInt(cursor.getColumnIndex("inout"));
			int sent = cursor.getInt(cursor.getColumnIndex("sent"));
			
			ContentValues cv = new ContentValues();
			cv.put("totable_license", license);
			cv.put("totable_id", employee_id);
			cv.put("totable_date", date);
			cv.put("totable_inout", inout == 1 ? "1" : "1");
			
			try {
				String response = SendPost.sendPostRequest("app/clockuser.php", cv);
				if (response.equals("1")) {
					edb.pendingSent(_id);
				} else {
					Log.i(LOG_TAG, "Pending response failed.");
				}
			} catch (Exception e) {
				Log.i(LOG_TAG, "Pending resquest failed.");
			}
		}
		
		edb.close();
	}
	
	@Override
	public void onResume() {
		super.onResume();
		
		Log.i(LOG_TAG, "onResume()");
		Log.i(LOG_TAG, "LICENSE KEY2: " + Globals.LICENSE_KEY);
		
		doInit();
		
		// Execute the pending requests.
		Handler handler = new Handler();
		handler.post(new Runnable() {
			@Override
			public void run() {
				doPendingRequests();
			}
		});
	}
}
