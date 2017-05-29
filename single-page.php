<?php
	/* 
	Fix for mysterious template hierarchy issue where pages
	load with single.php template instead of page.php */
	get_template('page','');
?>