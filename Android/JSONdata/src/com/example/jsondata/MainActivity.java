package com.example.jsondata;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;


import android.os.AsyncTask;
import android.os.Bundle;
import android.app.Activity;
import android.bluetooth.BluetoothAdapter;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.TextView;
import android.widget.Toast;

public class MainActivity extends Activity implements OnClickListener{
String JSON_string,json_string;
JSONObject json_object;
BroadcastReceiver receiver=null;
JSONArray json_array;
TextView tv,tv1;
BluetoothAdapter mBluetoothAdapter = BluetoothAdapter.getDefaultAdapter();
String on="1",off="0",Id="2";
Thread timer;
int bluetooth ,wifi,mobiledata,hotspot,id;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        tv = (TextView) findViewById(R.id.json);
        tv1 = (TextView) findViewById(R.id.tv1);
        
        //********
        
        
        IntentFilter filter = new IntentFilter("android.provider.Telephony.SMS_RECEIVED");
        
              receiver = new BroadcastReceiver()
              {

       		@Override
       		public void onReceive(Context arg0, Intent arg1) {
       			// TODO Auto-generated method stub
       			tv1.setText("You Get A New Message so read"+"\n"+"it from Inbox");
       			new BackgroudTask().execute();
       		}
           	   
              };
        registerReceiver(receiver,filter);
  //  getJSON(tv);
       
					
         }
    
        public void getJSON(View view){
    	new BackgroudTask().execute();
       }
   
  
       
    class BackgroudTask extends AsyncTask<Void,Void,String>
    {
    	
    	String json_url;

    	@Override
    	protected void onPreExecute()
    	{
    		json_url = "http://numero.netne.net/Android/init.php";
    		//super.onPreExecute();
    	}
		@Override
		protected String doInBackground(Void... arg0) {
			try {
				URL url = new URL(json_url);
				HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
			   InputStream inputstream = httpURLConnection.getInputStream();
				BufferedReader br = new BufferedReader(new InputStreamReader(inputstream) );
				
				StringBuilder stringbuild = new StringBuilder();
				
				
				while((JSON_string = br.readLine())!=null)
				{
					stringbuild.append(JSON_string+"\n");
				}
				
				br.close();
				inputstream.close();
				httpURLConnection.disconnect();
				
				
				return stringbuild.toString().trim();
				
				
				
				
				
				
				
				
			} catch (MalformedURLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			
			return null;
		}
		
		protected void onProgressUpdate(Void... values) 
		{
			super.onProgressUpdate(values);
		}
		
		protected void onPostExecute(String result)
		{
		
		tv.setText(result);
		json_string = result;
		try {
			json_object= new JSONObject(json_string);
			json_array = json_object.getJSONArray("Server_response");
			int count=0;
			
		
			while(count<json_array.length())
			{
				JSONObject jo = json_array.getJSONObject(count);
				id = Integer.parseInt(jo.getString("ID"));
				bluetooth = Integer.parseInt(jo.getString("Bluetooth"));
				wifi = Integer.parseInt(jo.getString("Wifi"));
				hotspot = Integer.parseInt(jo.getString("Hotspot"));
				mobiledata = Integer.parseInt(jo.getString("MobileData"));
			//	if(id.equals(Id))
				count++;
					break;
			
			}
		
		
			
			
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		finally
		{
			tv.setText("");
			tv.setText("Bluetooth: "+bluetooth+"\n"+"Wifi: "+wifi+"\n"+"Hotspot: "+hotspot);
		//	showblue();
		//	bluetooth=1;
			if(bluetooth == 1){
		    	
		    	 if (!mBluetoothAdapter.isEnabled()) {
				        Intent enableBtIntent = new Intent(BluetoothAdapter.ACTION_REQUEST_ENABLE);
				        startActivityForResult(enableBtIntent, 1);
				    }
				 else
				 {
					 Toast.makeText(MainActivity.this, "Already Active",Toast.LENGTH_LONG).show();
				 }
		    	}



		    	else{
				if (!mBluetoothAdapter.isEnabled())
				{
					 Toast.makeText(MainActivity.this, "Already Disabled",Toast.LENGTH_LONG).show();
					 
					
				}
				else
				mBluetoothAdapter.disable();
				
		    	}
			
			
		}
		
		}
		
    }
    
    
    
    
    /*
    public void parseJSON(View view)
    {
    	if(json_string == null)
    	{
    		Toast.makeText(MainActivity.this,"First get JSON",Toast.LENGTH_LONG).show();
    	}
    	else
    	{
    		Intent in = new Intent(this,DisplayJSON.class);
    		in.putExtra("json_data", json_string);
    		startActivity(in);
    		
    	}
    	
    	
    }
    
    */
    
    /*  Bluetooth code */
    
    
   
    protected void onDestroy()
    {
    super.onDestroy();
    unregisterReceiver(receiver);
    
    }

	@Override
	public void onClick(View arg0) {
		// TODO Auto-generated method stub
		
	}
    
    
    
    
    
   
}
