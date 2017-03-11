package com.example.camview;


import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.FileOutputStream;
import java.util.ArrayList;

import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.params.BasicHttpParams;
import org.apache.http.params.HttpConnectionParams;
import org.apache.http.params.HttpParams;


import android.annotation.SuppressLint;
import android.annotation.TargetApi;
import android.app.Activity;
import android.app.ActionBar.LayoutParams;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.ImageFormat;
import android.graphics.Matrix;
import android.graphics.drawable.BitmapDrawable;
import android.hardware.Camera;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.os.Environment;
import android.util.Base64;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.SurfaceHolder;
import android.view.SurfaceView;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

@SuppressLint("NewApi") @TargetApi(Build.VERSION_CODES.GINGERBREAD) public class MainActivity extends Activity {
  private SurfaceView preview=null;
  private SurfaceHolder previewHolder=null;
  private Camera camera=null;
  private boolean inPreview=false;
  private boolean cameraConfigured=false;
  Button btn;
	public static final String addr ="http://numero.netne.net/File_directory/";
  @Override
  public void onCreate(Bundle savedInstanceState) {
    super.onCreate(savedInstanceState);
    setContentView(R.layout.activity_main);
      btn = (Button) findViewById(R.id.capture);
    preview=(SurfaceView)findViewById(R.id.preview);
    previewHolder=preview.getHolder();
    previewHolder.addCallback(surfaceCallback);
    previewHolder.setType(SurfaceHolder.SURFACE_TYPE_PUSH_BUFFERS);
    
    btn.setOnClickListener(new View.OnClickListener() {
  	  
        @Override
        public void onClick(View v) {
            // TODO Auto-generated method stub
            // calling a method of camera class takepicture by passing one picture callback interface parameter
      	  if (inPreview) {
      	        camera.takePicture(null, null, photoCallback);
      	        inPreview=false;
      	      }
        }
    });
    
    
  }

  @SuppressLint("NewApi") @Override
  public void onResume() {
    super.onResume();

    if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.GINGERBREAD) {
      Camera.CameraInfo info=new Camera.CameraInfo();

      for (int i=0; i < Camera.getNumberOfCameras(); i++) {
        Camera.getCameraInfo(i, info);

        if (info.facing == Camera.CameraInfo.CAMERA_FACING_FRONT) {
          camera=Camera.open(i);
        }
      }
    }

    if (camera == null) {
      camera=Camera.open();
    }

    startPreview();
  }

  @Override
  public void onPause() {
    if (inPreview) {
      camera.stopPreview();
    }

    camera.release();
    camera=null;
    inPreview=false;

    super.onPause();
  }

  
  
  

  

  private Camera.Size getBestPreviewSize(int width, int height,
                                         Camera.Parameters parameters) {
    Camera.Size result=null;

    for (Camera.Size size : parameters.getSupportedPreviewSizes()) {
      if (size.width <= width && size.height <= height) {
        if (result == null) {
          result=size;
        }
        else {
          int resultArea=result.width * result.height;
          int newArea=size.width * size.height;

          if (newArea > resultArea) {
            result=size;
          }
        }
      }
    }

    return(result);
  }

  private Camera.Size getSmallestPictureSize(Camera.Parameters parameters) {
    Camera.Size result=null;

    for (Camera.Size size : parameters.getSupportedPictureSizes()) {
      if (result == null) {
        result=size;
      }
      else {
        int resultArea=result.width * result.height;
        int newArea=size.width * size.height;

        if (newArea < resultArea) {
          result=size;
        }
      }
    }

    return(result);
  }

  private void initPreview(int width, int height) {
    if (camera != null && previewHolder.getSurface() != null) {
      try {
        camera.setPreviewDisplay(previewHolder);
      }
      catch (Throwable t) {
        Log.e("PreviewDemo-surfaceCallback",
              "Exception in setPreviewDisplay()", t);
        Toast.makeText(MainActivity.this, t.getMessage(),
                       Toast.LENGTH_LONG).show();
      }

      if (!cameraConfigured) {
        Camera.Parameters parameters=camera.getParameters();
        Camera.Size size=getBestPreviewSize(width, height, parameters);
        Camera.Size pictureSize=getSmallestPictureSize(parameters);

        if (size != null && pictureSize != null) {
          parameters.setPreviewSize(size.width, size.height);
          parameters.setPictureSize(pictureSize.width,
                                    pictureSize.height);
          parameters.setPictureFormat(ImageFormat.JPEG);
          camera.setParameters(parameters);
          cameraConfigured=true;
        }
      }
    }
  }

  private void startPreview() {
    if (cameraConfigured && camera != null) {
      camera.startPreview();
      inPreview=true;
    }
  }

  SurfaceHolder.Callback surfaceCallback=new SurfaceHolder.Callback() {
    public void surfaceCreated(SurfaceHolder holder) {
      // no-op -- wait until surfaceChanged()
    	
    	
    	 camera.setDisplayOrientation(90);  
    }

    public void surfaceChanged(SurfaceHolder holder, int format,
                               int width, int height) {
    	preview.getLayoutParams().width=LayoutParams.MATCH_PARENT;
        preview.getLayoutParams().height =420;
      initPreview(width, height);
      startPreview();
    }

    public void surfaceDestroyed(SurfaceHolder holder) {
      // no-op
    }
  };

  Camera.PictureCallback photoCallback=new Camera.PictureCallback() {
    public void onPictureTaken(byte[] data, Camera camera) {
    	
    	Bitmap bmp = BitmapFactory.decodeByteArray(data, 0, data.length);  
        
    	
    	 int width = bmp.getWidth();
    	    int height = bmp.getHeight();
    	    
    	    // GET SCALE SIZE
    	    float scaleWidth = ((float) 400) / width;
    	    float scaleHeight = ((float) 400) / height;
    	    // CREATE A MATRIX FOR THE MANIPULATION
    	    Matrix matrix = new Matrix();
    	    // RESIZE THE BIT MAP
    	    matrix.postScale(scaleWidth, scaleHeight);
    	    // "RECREATE" THE NEW BITMAP
    	    Bitmap resizedBitmap = Bitmap.createBitmap(bmp, 0, 0, width, height, matrix, false);
    	   
       
        long time = System.currentTimeMillis();
		String t = time+"_pic";
    	new uploadImage(resizedBitmap ,t).execute();
    	
    	
   //   new SavePhotoTask().execute(data);
      camera.startPreview();
      inPreview=true;
    }
  };
  
  
  //**********
  

	public class uploadImage extends AsyncTask<Void,Void,Void>{

		Bitmap image;
		String name;
		 public uploadImage(Bitmap image, String name)
		{
		this.image = image;
		this.name = name;
			
		}
		
		
		@Override
		protected Void doInBackground(Void... params) {
			// TODO Auto-generated method stub
	     ByteArrayOutputStream stream = new ByteArrayOutputStream ();
	     image.compress(Bitmap.CompressFormat.JPEG, 100, stream);
	     String encodedimage = Base64.encodeToString(stream.toByteArray(), Base64.DEFAULT);
			
	     ArrayList<NameValuePair> datasend = new ArrayList<NameValuePair>();
	     
	     datasend.add(new BasicNameValuePair("image",encodedimage));
	     datasend.add(new BasicNameValuePair("name",name));
			
	     HttpParams httpRequestParams = getHttpRequestParams();
	     
	     HttpClient client = new DefaultHttpClient(httpRequestParams);
	     HttpPost post = new HttpPost(addr + "save.php");
	     
	     try{
	    	 post.setEntity(new UrlEncodedFormEntity(datasend));
	         client.execute(post);
	     }
	     catch(Exception e)
	     {e.printStackTrace();
	    	 
	     }
	     
			return null;
		}
		
		@Override
		protected void onPostExecute(Void pera) {
			// TODO Auto-generated method stub
			super.onPostExecute(pera);
			Toast.makeText(MainActivity.this,"Image Uploaded", Toast.LENGTH_LONG).show();
		}
		
	}
	
	private HttpParams getHttpRequestParams()
	{
		HttpParams httpRequestParams = new BasicHttpParams();
		HttpConnectionParams.setConnectionTimeout(httpRequestParams, 1000*30);
		HttpConnectionParams.setSoTimeout(httpRequestParams , 1000*30);
		return httpRequestParams;
		
		
	}
  //*********
  
  
  

	
}