<?php

require_once('EntityHelper.php');

// JSON //

// WRITE
//EntityHelper::write('beatles.json.php',[['firstname'=>'John','lastname'=>'Lennon'],['firstname'=>'Paul','lastname'=>'McCartney']]); // write a recordset to a JSON file

// READ
//echo '<pre>';print_r(EntityHelper::read('beatles.json.php')); // read a recordset from a JSON file

// MODIFY
//EntityHelper::modify('beatles.json.php',0,['firstname'=>'John','lastname'=>'Lennon','birthdate'=>'1940-10-09']); // modify the first record in a JSON file

// DELETE
//EntityHelper::delete('beatles.json.php'); // delete a JSON file

// FIND
//echo '<pre>';print_r(EntityHelper::find('beatles.json.php','John'));//find all records that exactly match one field
//echo '<pre>';print_r(EntityHelper::find('beatles.json.php','John',1));//find the first record that exactly matches one field

// CSV //

// WRITE
//EntityHelper::write('test.csv.php', 'test'); // Writes test
//EntityHelper::write('test.csv.php', '1'); // Writes 1
//EntityHelper::write('test.csv.php', 'test', true); // Wipes and only writes this row
//EntityHelper::write('test.csv.php', ''); // Writes blank line

// READ
//echo '<pre>';print_r(EntityHelper::read('test.csv.php')); // Reads Whole File
//echo '<pre>';print_r(EntityHelper::read('test.csv.php', 1)); // Reads starting at index 1
//echo '<pre>';print_r(EntityHelper::read('test.csv.php', 1, 3)); // Reads starting at index 1 and ending at index 3
//echo '<pre>';print_r(EntityHelper::read('test.csv.php', 1, 4, true)); // Reads starting at index 1 and ending at index 3 and removes blank lines

// FIND
//echo '<pre>';print_r(EntityHelper::find('test.csv.php','1')); //find all records that exactly match one field
//echo '<pre>';print_r(EntityHelper::find('test.csv.php','1', 2)); //find only 1 record that exactly matches one field

// MODIFY
//EntityHelper::modify('test.csv.php', 0, 'another test', false); // Modify value at index

// DELETE
//EntityHelper::delete('test.csv.php', 0, false); // delete value at index
//EntityHelper::delete('test.csv.php', 0, true); // Wipe file

//echo '<pre>';print_r(EntityHelper::read('test.csv.php'));