<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = 'INDEX PAGE';
        return view('pages.index')->with('title', '$title');
        //return view('pages.index' , compact('title'));
    }

    public function about() {
        $title = 'About Page';
        return view('pages.about')-> with('about', $title);
    }

    public function services(){
        $data = array(
            'title' => 'Services',
            'services' => ['Programming' ,'Web Design', 'SEO']
        );
        return view('pages.services')-> with($data);
        
        //Can also use <?php echo "Something"
 }
}
