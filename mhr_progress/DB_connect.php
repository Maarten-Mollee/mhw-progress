<?php

$conn = new mysqli("localhost", "root", "", "mhr_progress");

if ($conn->connect_error) {die("fout: ".$conn->connect_error);}