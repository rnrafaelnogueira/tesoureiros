<?php

namespace App\Http\Controllers;

use App\MiddlewareScriptCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;

class AjaxController extends Controller
{

	public function __construct(
        Carbon $carbon
    )
    {
        $this->carbon = $carbon;
    }

	public function excelUsuarios(Request $request)
	{	
		return Response::json($this->tbl_cin_curso_repository->excel($request->except('_token')));
	}

}
