package com.zapto.park.database;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
//import android.util.Log;
//import android.widget.Toast;
import com.zapto.park.database.EmployeeDBHelper;

public class EmployeeDB {
	
	private String LOG_TAG = "EmployeeDB";
	
	private Context context;
	private EmployeeDBHelper database;
	private SQLiteDatabase db;
	
	static private int standard_unit_id = 1;
	static private int icon_meal = 26;
	static private int icon_goal = 27;
	
	public EmployeeDB(Context c) {
		//Log.i(LOG_TAG, "NutrimaxDB()");
		context = c;
		database = new EmployeeDBHelper(c);
		db = database.getWritableDatabase();
	}
	
	public void close() {
		db.close();
		database.close();
	}
	
	public void clockEmployee(ContentValues cv) {
		db.insert("clock", null, cv);
	}
	
	public Cursor pendingClock() {
		Cursor cursor = db.rawQuery("select * from clock where sent=0", null);
		return cursor;
	}
	
	public Cursor getAll(){
		Cursor cursor = db.rawQuery("select * from employee", null);
		return cursor;
	}
	
	public void pendingSent(int id) {
		ContentValues cv = new ContentValues();
		cv.put("sent", 1);
		
		db.update("clock", cv, "_id=?", new String[] { new Integer(id).toString() });
	}
	
	public void clearEmployees() {
		db.execSQL("delete from employee");
	}
	
	public void insertEmployee(ContentValues cv) {
		db.insert("employee", null, cv);
	}
	
	public boolean hasEmployee(int id) {
		String query = "select count(*) as amount from employee where employee_id=?";
		Cursor cursor = db.rawQuery(query, new String[] { new Integer(id).toString() });
		cursor.moveToNext();
		int count = cursor.getInt(0);
		
		if (count > 0) {
			return true;
		}
		
		return false;
	}

	public String getName(int id) {
		String query = "select first, last from employee where employee_id=?" ;
		Cursor cursor = db.rawQuery(query, new String[] { new Integer(id).toString() });
		if (cursor.moveToFirst()) {
			String first = cursor.getString(0);
			String last = cursor.getString(1);
			return first;
		}
		return "";
	}
}