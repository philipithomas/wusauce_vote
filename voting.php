<?php

/*
Check whether a telephone number has voted
*/
function has_voted( $number ){ 
	$query = "select count(*) from votes where number = $number";
	dbOpen();
    $attempt = mysql_query( $query );
    if( $attempt ){
        // PHP sucks for returning a single mysql value
        $count = mysql_fetch_array( $attempt );
        mysql_close();
        return $count; 
        // if count 1 -> true
        // if count 0 -> false
    }
    // Query didn't work 
    echo "Voting count query failed";
}

/*
Insert a new vote for a new number
*/
function new_vote( $number , $vote ){
	$query = "insert into votes values ( $number , $vote )";
	dbOpen();
	return mysql_query( $query );
}

/*
Update a vote for a number that has already voted
*/
function update_vote( $number, $vote ){
	$query = "update votes set vote =  $vote where number = $number";
	dbOpen();
	return mysql_query( $query );
}

/*
This is the important part - count how many votes a given choice has!
*/
function count_votes( $choice ){
	$query = "select count(*) from votes where vote = $choice";
	dbOpen();
	$attempt = mysql_query( $query );
    if( $attempt ){
        // PHP sucks for returning a single mysql value
        $count = mysql_fetch_array( $attempt );
        mysql_close();
        return $count; 
    }
    // Query didn't work 
    echo "Error with counting votes";
}