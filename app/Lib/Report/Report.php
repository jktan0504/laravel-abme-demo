<?php
namespace App\Lib\Report;

use Carbon\Carbon;

class Report {

    function generateReportID($category_name) {

        $dateTime = Carbon::now()->format('YmdHis');

        $reportID = $category_name.$dateTime;

        // $reportID = $category_name.$dateTime->year.''.$dateTime->month.''.$dateTime->day.''.$dateTime->hour.''.$dateTime->minute.''.$dateTime->second;

        // return $reportID;
        return $reportID;

    }

}

?>
