<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use DateTime;
use Illuminate\Support\Facades\File;
use IntlDateFormatter;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isFalse;

class SubjectsController extends Controller
{
    public function index()
    {

        $now = new DateTime('now');
        $start = new DateTime('2023-12-31 23:59:59');
        $end = new DateTime('2024-01-01 09:00:00');

        if ($now >= $start && $now <= $end) {
            session()->flash('showcd', true);
        }

        $docxPath = '/fund.txt';
        $fund =  File::get(storage_path($docxPath));

        if ($fund < 50) {
            $bgColor = "bg-danger";
        }
        elseif ($fund < 100) {
            $bgColor = "bg-warning";
        }
        else {
            $bgColor = "bg-success";
        }
        $fund = substr_replace($fund, '', -1);
        $fund = $fund . "%";

        // I don't care how stupid this looks, it works unlike the international time formatting thing.
        $months = array(
            " Január",
            " Február",
            " árcius",
            "z Április",
            " Május",
            " Június",
            " Július",
            "z Augusztus",
            " Szeptember",
            "z Október",
            "November",
            "December"
        );

        $currentMonthNumber = date('n') - 1; // Subtracting 1 to match array index (0-based)
        $month = $months[$currentMonthNumber];

        $subjects = Subject::all(); // Fetch all subjects from the database
        return view('home', compact('subjects', 'bgColor', 'fund', 'month'));
    }
}
