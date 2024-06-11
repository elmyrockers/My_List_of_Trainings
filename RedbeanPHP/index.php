<?php
require_once 'rb.php';
R::setup( 'mysql:host=localhost;dbname=redbean', 'root', '' ); //for both mysql or mariaDB

$book = R::dispense( 'book' );
$book[ 'title' ] = 'Samarinda';
$book[ 'price' ] = 39.90;
$book[ 'category' ] = 'Novel';

$version = R::dispense( 'version' );
$version[ 'name' ] = '1990';

$book->ownVersionList[] = $version;
$id = R::store( $book );

// $book = R::findAll( 'book' );
// $books = R::findAll( 'book' );

// print_r( $books[3] );