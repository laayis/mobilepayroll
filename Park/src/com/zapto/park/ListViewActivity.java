package com.zapto.park;

import com.zapto.park.database.EmployeeDB;
import java.util.List;
import android.content.ContentValues;
import android.os.Bundle;
import android.app.Activity;
import android.widget.ArrayAdapter;
import android.widget.SimpleCursorAdapter;
import android.widget.Toast;
import android.content.Context;
import android.app.ListActivity;
import android.database.Cursor;

public class ListViewActivity extends ListActivity {
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		/*
		super.onCreate(savedInstanceState);
		setContentView(R.layout.main);
		Context context = getApplicationContext();
		Toast.makeText(context, "View log loading.", Toast.LENGTH_LONG).show();
		finish();
		*/
		super.onCreate(savedInstanceState);
		Context context = getApplicationContext();
		setContentView(R.layout.dbview);
		EmployeeDB datasource = new EmployeeDB(context);
		Cursor cursor = datasource.getAll();
        startManagingCursor(cursor);

        // the desired columns to be bound
        String[] columns = new String[] {"first", "last"};
        // the XML defined views which the data will be bound to
        int[] to = new int[] { R.id.firstname, R.id.lastname };

        // create the adapter using the cursor pointing to the desired data as well as the layout information
        SimpleCursorAdapter mAdapter = new SimpleCursorAdapter(this, R.layout.simplerow, cursor, columns, to);

        // set this adapter as your ListActivity's adapter
        this.setListAdapter(mAdapter);


	}
}
