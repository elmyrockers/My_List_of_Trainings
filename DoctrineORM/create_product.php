<?php
require_once 'bootstrap.php';


$product = new Product();
$product->new( 'Beras', 'Barang Keperluan' );

$entityManager->persist( $product );
$entityManager->flush();