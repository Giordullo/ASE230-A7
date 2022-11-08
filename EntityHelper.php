<?php
require_once('JSONHelper.php');
require_once('CSVHelper.php');


class EntityHelper
{
    static function read($file,$offset=null,$limit=null,$skipblanks=false)
    {
        return str_contains($file, 'csv.php') ? CSVHelper::read($file,$offset,$limit,$skipblanks) : JSONHelper::read($file,$offset,$limit,$skipblanks);
    }
	
	 static function find($file,$filter,$limit=null)
    {
        return str_contains($file, 'csv.php') ? CSVHelper::find($file,$filter,$limit) : JSONHelper::find($file,$filter,$limit);
    }

    static function write($file,$data,$overwrite=false)
    {
		return str_contains($file, 'csv.php') ? CSVHelper::write($file,$data,$overwrite) : JSONHelper::write($file,$data,$overwrite);
    }

    static function modify($file,$index,$data,$overwrite=true)
    {		
		return str_contains($file, 'csv.php') ? CSVHelper::modify($file,$index,$data,$overwrite) : JSONHelper::modify($file,$index,$data,$overwrite);
    }

    static function delete($file,$index=null,$wipe=false)
    {
       return str_contains($file, 'csv.php') ? CSVHelper::delete($file,$index,$wipe) : JSONHelper::delete($file,$index,$wipe);
    }
}