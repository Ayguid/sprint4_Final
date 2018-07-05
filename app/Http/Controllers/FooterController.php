<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function contact()
    {
      return view('contact-faqs');
    }


}
