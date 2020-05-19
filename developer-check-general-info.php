<?php

require_once ('connect.php');
session_start();

$email = $_SESSION['email'];
$developerid = $_SESSION['developerid'];
$profileid = $_SESSION['profileid'];

$phoneNumber = $_POST['phoneNumber'] ? $_POST['phoneNumber'] : "";
$linkedinLink = $_POST['linkedinLink'] ? $_POST['linkedinLink'] : "";
$githubLink = $_POST['githubLink'] ? $_POST['githubLink'] : "";
$cvLink = $_POST['cvLink'] ? $_POST['cvLink'] : "";
$experiencedYears = ( $_POST['experiencedYears'] >= 0 ) ? $_POST['experiencedYears'] : 0;
$preferredWorkingLocations = $_POST['preferredWorkingLocations'] ? $_POST['preferredWorkingLocations'] : [];
$rolePreferences = $_POST['rolePreferences'] ? $_POST['rolePreferences'] : "";
$status = $_POST['status'] ? 1 : 0;

echo $status;

// Update phone from user table
$update_phone = " update user set phone = '$phoneNumber' where email = '$email' "; 
mysqli_query($conn, $update_phone);

// Update profile informations
$update_profile = " update profile set linkedin_link = '$linkedinLink', github_link = '$githubLink', cv_link = '$cvLink', experienced_years = '$experiencedYears', status = {$status}, role_preferences = '$rolePreferences' where profile_id = $profileid ";
mysqli_query($conn, $update_profile);

/*********************************
Update preferred working locations 
***********************************/

// Select current prefered cities
$select_current_cities = " select city from preferredworkinglocations where profile_id = '$profileid' ";
$city_result = mysqli_query($conn, $select_current_cities);
$current_cities = Array();
while ($row = mysqli_fetch_array($city_result, MYSQLI_ASSOC)) {
	array_push( $current_cities, $row['city'] );
}

// Find differences of the current cities and selected input cities
$newSelectedCities = array_diff( $preferredWorkingLocations, $current_cities );
$deleteCities = array_diff( $current_cities, $preferredWorkingLocations );

// Insert new selected cities
foreach ($newSelectedCities as $city){
	$insert_city = " insert into preferredworkinglocations values( '$profileid', '$city') ";
	mysqli_query($conn, $insert_city);
}

// Delete non-selected cities if they were selected before
foreach ($deleteCities as $city){
	$delete_city = " delete from preferredworkinglocations where profile_id = '$profileid' and city = '$city' ";
	mysqli_query($conn, $delete_city);
}

$_SESSION["general_info_message"] = 'Your information has been changed successfully!';
header('location:developer-profile.php');

?>