<?php
$x = 5; // global scope

function myTest()
{
    // pengunaan x didalam function akan menghasilkan error
    echo"<P>Variable x didalam function is : $x</P>";
}
myTest()

echo"<p>Variable x diluar fuction is : $x</p>";
?>