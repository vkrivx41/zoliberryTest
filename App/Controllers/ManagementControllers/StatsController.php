<?php

declare(strict_types=1);

namespace App\Controllers\ManagementControllers;

use App\Attributes\Get;
use App\Models\Stats;
use App\View;
use DateTime;

class StatsController
{

    public function __construct(
        protected Stats $statsModel
    )
    {
    }

    #[Get("/Dashboard/Moderator/Stats")]
    #[Get("/Dashboard/Stats/Author")]
    public function authorsStats(): View
    {
        $uri = $_SERVER['REQUEST_URI'];

        $sender = "Moderator";

        if ($uri === "/Dashboard/Stats" or $uri === "/Dashboard/Stats/Author"){
            $sender = "Manager";
        }

        //


        $startDate = (new DateTime("first day of this month"))->format("Y-m-d");
        $endDate = (new DateTime("last day of this month"))->format("Y-m-d");


        $data = $this->statsModel->all(start_date: $startDate, end_date: $endDate);

        return View::make("/stats/index", "php", [
            'sender' => $sender,
            'data' => $data
        ]);
    }

    #[Get("/Dashboard/Stats/Moderator")]
    public function moderatorsStats(): View
    {
        $uri = $_SERVER['REQUEST_URI'];

        $sender = "Moderator";

        if ($uri === "/Dashboard/Stats/Moderator"){
            $sender = "Manager";
        }


        $startDate = (new DateTime("first day of this month"))->format("Y-m-d");
        $endDate = (new DateTime("last day of this month"))->format("Y-m-d");


        $data = $this->statsModel->moderators(start_date: $startDate, end_date: $endDate);


        return View::make("/stats/moderator", "php", [
            'sender' => $sender,
            'data' => $data
        ]);
    }
}