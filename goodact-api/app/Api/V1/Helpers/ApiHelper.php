<?php 

namespace App\Api\V1\Helpers;

use Dingo\Api\Exception\ValidationHttpException;

class ApiHelper
{

    /**
     *  Generate a File Name if it does not exist already in the given path.
     *
     * @param  string  $extension File extension
     * @param  string  $path This must be an relative path within Storage folder.
     * @return string Filename
     */
    public static function generateFileName($extension, $path="public/institute_gallery/"){

    	$file_name = str_random(10).".".$extension;

    	if(file_exists(storage_path($path.$file_name))){
    		$this->generateFileName($extension, $path);
    	}

    	return $file_name;
    }

    /**
     *  Validate a File for different MIME types.
     *
     * @param  string  $extension File extension
     * @param  string  $mimes Comma separated list of MIME extensions (jpg, xls, doc)
     * @return string True if validation is successful else an validation exception with errors.
     */
    public static function validateFile($extension, $mimes){

		$validator = \Validator::make(
		  [
		      'extension' => strtolower($extension),
		  ],
		  [
		      'extension' => 'in:'.$mimes,
		  ],
		  [
		  	  'extension.in' => 'Invalid file upload.'
		  ]
		);
		
		if ($validator->fails()) {
			throw new ValidationHttpException($validator->errors());
        }

        return true;
    }

    public static function generateLocalDateTime($created_at, $updated_at){

        $created_date = $created_at->toDateTime();
        $updated_date = $updated_at->toDateTime();
        $created_date->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        $updated_date->setTimezone(new \DateTimeZone(date_default_timezone_get()));
        return [
            'created_at' => $created_date->format('Y-m-d H:i:s'),
            'updated_at' => $updated_date->format('Y-m-d H:i:s')
        ];
    }

    /* User this to check if the input string is a valid MongoDB object ID */
    public static function validateObjectID($obj_id){
        return preg_match('/^[a-f\d]{24}$/i', $obj_id);
    }
}