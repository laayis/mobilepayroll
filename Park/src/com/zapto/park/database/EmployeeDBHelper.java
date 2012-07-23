package com.zapto.park.database;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

public class EmployeeDBHelper extends SQLiteOpenHelper {
	
	private static final String LOG_TAG = "EmployeeDBHelper";
	
	public static final String DATABASE_NAME = "clock.db";
	public static int DATABASE_VERSION = 1;
	
	public EmployeeDBHelper(Context context) {
		super(context, DATABASE_NAME, null, DATABASE_VERSION);
		//Log.i(LOG_TAG, "Constructor");
	}
	
	@Override
	public void onCreate(SQLiteDatabase db) {
		Log.i(LOG_TAG, "Creating database.");
		db.execSQL("create table clock(" +
			"_id integer not null primary key autoincrement," +
			"license varchar(50)," +
			"employee_id integer," +
			"date datetime, " +
			"inout integer default 0," +
			"sent boolean" +
			");"
		);
		
		db.execSQL(	
			"create table employee(" +
			"_id integer not null primary key autoincrement," +
			"employee_id integer," +
			"first varchar(50)," +
			"last varchar(50)" +
			");"
		);
	}

	@Override
	public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
	}
}
