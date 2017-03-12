package com.example.jsondata;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;

public class DisplayJSON extends Activity {

	String json_string;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_display_json);
		
		json_string=getIntent().getExtras().getString("json_data");
		
		
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.activity_display_json, menu);
		return true;
	}

}
