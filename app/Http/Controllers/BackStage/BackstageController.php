<?php

namespace App\Http\Controllers\BackStage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CommonService;
use Illuminate\Support\Facades\Auth;	//use Auth;這個指令是錯誤的
// use Socialite;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class BackstageController extends Controller
{
	protected $commonService;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	// public function __construct() {
	public function __construct(CommonService $commonService) {
		$this->middleware('add.permission');
		$menu_permission=1;
		$this->middleware("access.permission:$menu_permission");
		$this->commonService = $commonService;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$menu = $this->commonService->menu();
		$id = Auth::user()->id;
		// dd($menu);

		return view('back_stage.home')
			->with("menus", $menu);
    }
}
