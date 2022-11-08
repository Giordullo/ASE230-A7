<?php

require_once('CSVHelper.php');

// WRITE
//CSVHelper::write('test.csv.php', 'test'); // Writes test
//CSVHelper::write('test.csv.php', '1'); // Writes 1
//CSVHelper::write('test.csv.php', 'test', true); // Wipes and only writes this row
//CSVHelper::write('test.csv.php', ''); // Writes blank line

// READ
//echo '<pre>';print_r(CSVHelper::read('test.csv.php')); // Reads Whole File
//echo '<pre>';print_r(CSVHelper::read('test.csv.php', 1)); // Reads starting at index 1
//echo '<pre>';print_r(CSVHelper::read('test.csv.php', 1, 3)); // Reads starting at index 1 and ending at index 3
//echo '<pre>';print_r(CSVHelper::read('test.csv.php', 1, 4, true)); // Reads starting at index 1 and ending at index 3 and removes blank lines

// FIND
//echo '<pre>';print_r(CSVHelper::find('test.csv.php','1')); //find all records that exactly match one field
//echo '<pre>';print_r(CSVHelper::find('test.csv.php','1', 2)); //find only 1 record that exactly matches one field

// MODIFY
//CSVHelper::modify('test.csv.php', 0, 'another test', false); // Modify value at index

// DELETE
//CSVHelper::delete('test.csv.php', 0, false); // delete value at index
//CSVHelper::delete('test.csv.php', 0, true); // Wipe file

//echo '<pre>';print_r(CSVHelper::read('test.csv.php'));