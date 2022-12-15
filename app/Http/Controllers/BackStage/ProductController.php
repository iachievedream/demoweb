<?php

namespace App\Http\Controllers\BackStage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CommonService;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    protected $commonService;

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    public function __construct(CommonService $commonService)
    {
        // if (is_null(Auth::user())) {
        //     return redirect(RouteServiceProvider::HOME);
        // }
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

        $totals = [];
        $totals['page_information'] = [
            'title' => '課程',
            'title_url' => 'user',
            // 'search' =>  [
            // 	'0' => '姓名：',
            // 	'1' => '信箱：',
            // ],
            // 'search_url' =>  [
            // 	'0' => 'name',
            // 	'1' => 'email',
            // ],
        ];
        $totals['table'] = [
            'field' => [
                '編號',//下列後則是table的欄位敘述
                '會員名稱',
                '種類',
                '內容',
                '原價',
                '售價',
                '作者',
                '觀看次數',
                '註冊時間',
            ],
            'note' => [//表格後方欄位
                '編輯',
            ],
            'note_url' => [//表格後方欄位
                'user/edit',//url
            ],
        ];

        $user = Product::all();
            // where('P_EDate', '>=', Carbon::now())
            // ->orderBy('P_id', 'desc')
            // ->get();
        // dd($total);
        foreach ($user as $k1 => $v1) {
            $totalss = [];
            $totalss[] = $v1->id;
            $totalss[] = $v1->name;//連結的主id
            $totalss[] = $v1->type;
            $totalss[] = $v1->content;
            $totalss[] = $v1->original_price;
            $totalss[] = $v1->selling_price;
            $totalss[] = $v1->user_id;
            $totalss[] = $v1->times;
            $totalss[] = substr($v1->created_at,0,10);
            foreach ($totalss as $k2 => $v2) {
                $totals['table']['content'][$k1][$k2] = $v2;
                $totals['table']['content_type'][$k1][$k2] = 'text';
            }
        }
        // dd($totals);
        return view('back_stage.index')
            ->with('contents', $totals)
            ->with("menus", $menu);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = $this->commonService->menu();
        $totals['page_information'] = [
            'title' => '會員新增',
            'title_url' => 'user/store',
        ];
        
        $totals['table'][] = [
            'front_text' => '姓名',
            'name_type' => 'text',
            'name' => 'name',
            'value' => 'name',
        ];
        $totals['table'][] = [
            'front_text' => '信箱',
            'name_type' => 'text',
            'name' => 'email',
            'value' => 'example@gmail.email.com',
        ];
        $totals['table'][] = [
            'front_text' => '密碼',
            'name_type' => 'password',
            'name' => 'password',
            'value' => '123456789',
        ];
        $totals['table'][] = [
            'front_text' => '自我介紹',
            'name_type' => 'textarea',
            'name' => 'self_introduction',
            'value' => 'self_introduction',
        ];
        // $totals['table'][] = [
        //     'front_text' => '大頭貼',
        //     'name_type' => 'image',
        //     'name' => 'self_img',
        //     'value' => '',
        // ];
        $totals['table'][] = [
            'front_text' => '權限',
            'name_type' => 'select',
            'name' => 'role',
            'value' => [
                [
                    'value' => '4',
                    'value_text' => '訪客',
                ],[
                    'value' => '3',
                    'value_text' => '會員',
                ],[
                    'value' => '2',
                    'value_text' => '作者',
                ],[
                    'value' => '1',
                    'value_text' => '管理員',
                ],
            ],
            'selected'=> '4',
        ];
        return view('back_stage.create')
            ->with('contents', $totals)
            ->with('menus', $menu);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user= Product::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'self_introduction' => $data['self_introduction'],
            'role' => $data['role'],
        ]);

        if($user) {
            return redirect('backstage/user')->with('message', '此會員:' . $request->id . ' 新增錯誤');
        } else {
            return redirect('backstage/user');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Product::where('id',$id)
            ->get();
            
        return view('back_stage.index')
            ->with('contents', $totals)
            ->with("menus", $menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = $this->commonService->menu();
        $totals['page_information'] = [
            'title' => '會員編輯',
            'title_url' => 'user/update',
        ];
        
        $user = Product::where('id', $id)
            // ->orderBy('P_id', 'desc')
            ->first();
        // dd($user);
        $totals['table'][] = [
            'front_text' => '會員編號',
            'name_type' => 'text',
            'name' => 'id',
            'value' => $user->id,
        ];
        $totals['table'][] = [
            'front_text' => '姓名',
            'name_type' => 'text',
            'name' => 'name',
            'value' => $user->name,
        ];
        $totals['table'][] = [
            'front_text' => '信箱',
            'name_type' => 'text',
            'name' => 'email',
            'value' => $user->email,
        ];
        $totals['table'][] = [
            'front_text' => '密碼',
            'name_type' => 'password',
            'name' => 'password',
            'value' => $user->password,
        ];
        $totals['table'][] = [
            'front_text' => '自我介紹',
            'name_type' => 'textarea',
            'name' => 'self_introduction',
            'value' => $user->self_introduction,
        ];
        $totals['table'][] = [
            'front_text' => '權限',
            'name_type' => 'select',
            'name' => 'role',
            'value' => [
                [
                    'value' => '4',
                    'value_text' => '訪客',
                ],[
                    'value' => '3',
                    'value_text' => '會員',
                ],[
                    'value' => '2',
                    'value_text' => '作者',
                ],[
                    'value' => '1',
                    'value_text' => '管理員',
                ],
            ],
            'selected'=> '4',
        ];
        return view('back_stage.create')
            ->with('id', $id)
            ->with('contents', $totals)
            ->with('menus', $menu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        // dd($data);
        $user= Product::where('id', $id)->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>  Hash::make($data['password']),
            'self_introduction' => $data['self_introduction'],
            'role' => $data['role'],
        ]);
        
        if($user) {
            return redirect('backstage/user')->with('message', '此會員:' . $request->id . ' 新增錯誤');
        } else {
            return redirect('backstage/user');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Product::where('id',$id)
            ->delete();
        if($user) {
            return redirect('backstage/user')->with('message', '此會員:' . $id . ' 刪除錯誤');
        } else {
            return redirect('backstage/user');
        }
    }

    // public function front_back_separation()
    // {
    //     $total = Product::all();
    //     echo json_encode($total);
    // }
}
