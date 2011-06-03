<?php
// set your internal clock to the YYY-MM-DD first
define('INTERNAL_FORMAT', 'Y-m-d');
define('DISPLAY_MONTH_FORMAT', 'M Y');
define('DISPLAY_DAY_FORMAT', 'D d M Y');
// to exclude some dates add them here in the
// YYYY-MM-DD format, each on seperated by a ,
// '2010-03-09',
// '2010-04-13',
$excluded_dates = array(
	'2010-03-09',
	'2010-04-13',
);

//   '0' Sunday
//   '1' Monday
//   '2' Tuesday
//   '3' Wednesday
//   '4' Thursday
//   '5' Friday
//   '6' Saturday
// to add a day add a function
// function isNameOfTheDay($date) {
//		return date('w', strtotime($date)) === 'numberOfTheDay';
// }
function isTuesday($date) {
	return date('w', strtotime($date)) === '2';
}
function isWednesday($date) {
	return date('w', strtotime($date)) === '3';
}

function isExcludedDate($internal_date) {
	global $excluded_dates;
	return in_array($internal_date, $excluded_dates);
}

$start_date = date(INTERNAL_FORMAT);

$months_and_dates = array();

foreach(range(0,365) as $day) {
	$internal_date = date(INTERNAL_FORMAT, strtotime("{$start_date} + {$day} days"));
	$this_day = date(DISPLAY_DAY_FORMAT, strtotime($internal_date));
	$this_month = date(DISPLAY_MONTH_FORMAT, strtotime($internal_date));
	// when adding a day add the function here like this
	// if (isNameOfTheDay($internal_date) || isNameOfTheOtherDay($internal_date)) && !isExcludedDate($internal_date))
	if ((isTuesday($internal_date) || isWednesday($internal_date)) && !isExcludedDate($internal_date)) {
		$months_and_dates[$this_month][] = $this_day;
	}
}

echo "Du <select id='date_emprunt'>";
foreach($months_and_dates as $month => $days) {
	//print $month . "<br>";
	//print implode('<br>', $days);
	//print "<br>";
	foreach ($days as &$value) {
		echo "<option value=".$value.">".$value."</option>";
	}
}
echo "</select> au ";
echo "<select id='date_retour'>";
foreach($months_and_dates as $month => $days) {
	//print $month . "<br>";
	//print implode('<br>', $days);
	//print "<br>";
	foreach ($days as &$value) {
		echo "<option value=".$value.">".$value."</option>";
	}
}
echo "</select><br>";
?>
