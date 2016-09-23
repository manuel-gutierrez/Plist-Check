<?php
/**
 * Examples for how to use CFPropertyList with strings
 * Read a binary from a string PropertyList
 * @package plist
 * @subpackage plist.examples
 */
namespace CFPropertyList;

// just in case...
error_reporting( E_ALL );
ini_set( 'display_errors', 'on' );

/**
 * Require CFPropertyList
 */
require_once(__DIR__.'/CFPropertyList/classes/CFPropertyList/CFPropertyList.php');


/*
 * create a new CFPropertyList instance which loads the sample.plist on construct.
 * since we know it's an binary file, we can skip format-determination
 */

$plist_1 = new CFPropertyList( __DIR__.'/plists/Directory_Shop_ES.plist' );
$plist_2 = new CFPropertyList( __DIR__.'/plists/Directory_Shop.plist' );

/*
 * retrieve the array structure of sample.plist and dump to stdout
 */


$list_1 = $plist_1->toArray() ;
$list_2 = $plist_1->toArray() ;
$index = 0; 
$file = fopen("shop-not-found.csv","w");  

//if plists have the same number of items validate names.
if (sizeof( $list_1) == sizeof($list_2)) {
	foreach ($list_1 as $key => $value) {
		//find if the name are not same
		if (!in_array($value['Name'] , $list_2[$index])) {
		 fputcsv($file,explode(',',$value['Name']));
		} 
		$index ++;
	}
} elseif (sizeof( $list_1) > sizeof($list_2)) {
	foreach ($list_1 as $key => $value) {
		//find missing name
		if (!in_array($value['Name'] , $list_2[$index])) {
		 fputcsv($file,explode(',',$value['Name']));
		} 
		$index ++;
	}
} elseif (sizeof( $list_1) < sizeof($list_2)) {
	foreach ($list_2 as $key => $value) {
		//find missing name 
		if (!in_array($value['Name'] , $list_1[$index])) {
		 fputcsv($file,explode(',',$value['Name']));
		} 
		$index ++;
    }
}

fclose($file);

?>