<?php

require_once ('connect.php');
session_start();


$searched_company = $_POST['search'];

// Select current prefered cities
$query = " select company_name, website from company where company_name LIKE '%{$searched_company}%' ";
$result = mysqli_query($conn, $query);
$possible_companies = Array();
$companies_website = Array();
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	array_push( $possible_companies, $row['company_name'] );
	array_push( $companies_website, $row['website'] );
}

$_SESSION['isSearched'] = true;
if( $searched_company == ""){
	$_SESSION['isSearched'] = false;
}

$_SESSION['possible_companies'] = $possible_companies;
$_SESSION['companies_website'] = $companies_website;

/*
foreach($possible_companies as $comp){
	echo $comp;
}*/

header('location:companies.php');

?>