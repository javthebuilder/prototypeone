<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\Storage; //responsible for filesystems


class AppStorage extends Model
{
    
    
	/*
		$path = (recordings, questions, quizees)
	 */
    public static function store($path, $filename){

        //storage directory is linked to the public folder through the command of
        //php artisan storage:link
        //with this command, the view can now directly call files from the storage folder
        //ex: asset('storage/recordings')

        //store files using Storage @storage folder
        //by default files are stored @storage/app/public and will create a random filename
        //$path = location path for the storage, 
        //generated filename will prepend the storage path
        //ex: public/recordings/filename
        $randomfilename = Storage::put("public/$path", $filename);

        //remove 'public/' from the generated filename. 
        //$path is still entact to properly route the correct path of the file
        $randomfilename = str_replace('public/', '', $randomfilename);

        return $randomfilename;

    }//END store


    /*
    	$filename includes the path location

     */
    public static function remove($filename){

        //check if file exists in storage public directory to avoid exception
        if( Storage::disk('public')->exists("$filename") ){
            
            //delete oldfile using Storage @storage/app/public folder
            Storage::delete("public/$filename");

        }//END exists

    
    }//END remove



}
