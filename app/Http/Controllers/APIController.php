<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\Letter;
use App\Models\Zoom;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
  
  public function letter(Letter $letter){  
    return ApiFormatter::createApi(200,"Success",$letter);
  }
  public function zoom(Zoom $zoom){  
    return ApiFormatter::createApi(200,"Success",$zoom);
  }

}
