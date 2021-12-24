<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public  $news=[
        "news 1",
        "news 2",
        "news 3",
        "news 4",
        "news 5",
    ];
    //Actions
    public function index()
    {
        return view("welcome");
    }
    public function news($id=0)
    {
        $id--;
        if($id>=0&&$id<count($this->news))
        {
            echo "<h1>".$this->news[$id]."</h1>";
        }
        else
        {
            echo "<ul>";
            foreach ($this->news as $news)
            {
                echo "<li>$news</li>";
            }
            echo "</ul>";
        }
        
    }
}
