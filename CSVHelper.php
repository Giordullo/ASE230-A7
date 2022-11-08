<?php
class CSVHelper{
	private static $obfuscator='<?php die() ?>';
	
	static function checkfile($file)
	{
		if (!file_exists($file))
		{
			$myfile = fopen($file, "w") or die("Unable to open file!");
			fclose($myfile);
		}			
	}
	
	static function write($file,$data,$overwrite=false)
	{
		self::checkfile($file);
		
		$array = array_map('str_getcsv', file($file)); // Get CSV Array

		$handle = fopen($file, "w"); // Open Write Handle to CSV File

		if (!$overwrite)
		{
			$i = 0;
			foreach ($array as $item) // Add Record to CSV File
			{
				fputcsv($handle, $item);
				$i++;
			}
		}

		if (gettype($data) == "array")
			fputcsv($handle, $data);
		else
			fputcsv($handle, [$data]);

		fclose($handle); // Close Handle
	}

	static function read($file,$offset=null,$limit=null,$skipblanks=false)
	{
		self::checkfile($file);
		
		$arr = array_map('str_getcsv', file($file));
		if ($offset != null)
		{
			if ($limit == null)
				$arr = array_slice($arr, $offset);
		}
		if ($limit != null)
		{
			if ($offset == null)
				$arr = array_slice($arr, 0, $limit);
			else
				$arr = array_slice($arr, $offset, $limit);
		}
		if ($skipblanks)
		{
			$arr = array_filter($arr, fn($val) => (!is_null($val[0]) || $val[0] != "" || !empty($val[0])));
		}
		return $arr;
	}

	static function find($file,$filter,$limit=null)
	{
		if(!file_exists($file)) return [];
		$records=self::read($file);
		$count=0;
		$out=[];
		foreach($records as $record){
			if(is_array($filter)){
				$found=true;
				foreach($filter as $k=>$v) if(!isset($record[$k]) || $record[$k]!=$v) $found=false;
				if($found) $out[$count]=$record;
			}else foreach($record as $k=>$v) if($v==$filter) $out[$count]=$record;
			$count++;
		}
		return $out;
	}

	static function modify($file,$index,$data,$overwrite=true)
	{
		self::checkfile($file);
		
		$array = self::read($file); // Get CSV Array

		$handle = fopen($file, "w"); // Open Write Handle to CSV File

		$i = 0;
		foreach ($array as $item) // Add Record to CSV File
		{
			if ($i == $index)
				array_push($item, $data);

			if ($overwrite)
				fputcsv($handle, [$data]);
			else
				fputcsv($handle, $item);
			
			$i++;
		}

		if ($index >= count($array))
		{
			$recordArray = [$data];
			fputcsv($handle, $recordArray);
		}

		fclose($handle); // Close Handle
	}

	static function delete($file,$index=null,$wipe=false)
	{
		self::checkfile($file);
		
		$array = self::read($file); // Get CSV Array

		$handle = fopen($file, "w"); // Open Write Handle to CSV File

		if (!$wipe)
		{
			$i = 0;
			foreach ($array as $item) // Empty Record in CSV File
			{
				if ($i == $index){}
				else
					fputcsv($handle, $item);
				
				$i++;
			}
		}

		fclose($handle); // Close Handle
	}
	
	private static function reset($file){
		if(file_exists($file)) rename($file,str_replace('.csv','_backup_'.date('Y-m-d_h_i_s').'.csv',$file));
	}
}