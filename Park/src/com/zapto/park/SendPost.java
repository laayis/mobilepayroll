package com.zapto.park;

import java.util.Iterator;
import java.util.Map.Entry;
import java.util.Set;

import android.content.ContentValues;
import android.content.Context;
import android.util.Log;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.HttpURLConnection;
import android.util.Log;
import android.widget.Toast;

public class SendPost {
	private static String LOG_TAG = "SendPost";
	private static String ROOT_PATH = "http://timesheet.elasticbeanstalk.com/";
	//"http://helloworld123.elasticbeanstalk.com/"
	
	/**
     * Extends the size of an array.
     */
    public static String sendPostRequest(String path, ContentValues cv) {
        
        //Build parameter string
        String data = toData(cv);
        Log.i(LOG_TAG, "Post: " + data);
        Log.i(LOG_TAG, "Post SENT");
        try {
            // Send the request
            URL url = new URL(ROOT_PATH + path);
        	HttpURLConnection conn = (HttpURLConnection)url.openConnection();
            conn.setDoOutput(true);
            conn.setRequestMethod("POST");
            OutputStreamWriter writer = new OutputStreamWriter(conn.getOutputStream());
            
            //write parameters
            writer.write(data);
            writer.flush();
            writer.close();
            
            // Get the response
            StringBuffer response = new StringBuffer();
            BufferedReader reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
            String line;
            while ((line = reader.readLine()) != null) {
                response.append(line);
            }
            reader.close();
            
            return response.toString();
        	
        } catch (MalformedURLException ex) {
            ex.printStackTrace();
        } catch (IOException ex) {
            ex.printStackTrace();
        }
        
        return "";
    }
    
    private static String toData(ContentValues cv) {
    	String data = "";
    	if (cv == null) return data;
    	
    	Set<Entry<String, Object>> set = cv.valueSet();
    	Iterator<Entry<String, Object>> i = set.iterator();
    	
    	int counter = 0;
    	while (i.hasNext()) {
    		Entry<String, Object> entry = i.next();
    		String key = entry.getKey();
    		String object = (String) entry.getValue();
    		
    		if (counter != 0) {
    			data += "&";
    		}
    		
    		data += key;
    		data += "=";
    		data += object;
    		
    		counter++;
    	}
    	
    	Log.i(LOG_TAG, "Data: " + data);    	
    	return data;
    }
    
}