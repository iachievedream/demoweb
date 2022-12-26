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
            'title_url' => 'product',
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
                'product/edit',//url
            ],
        ];

        $product = Product::all();
            // where('P_EDate', '>=', Carbon::now())
            // ->orderBy('P_id', 'desc')
            // ->get();
        // dd($total);
        foreach ($product as $k1 => $v1) {
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
            'title' => '產品新增',
            'title_url' => 'product/store',
        ];
        
        $totals['table'][] = [
            'front_text' => '產品名稱',
            'name_type' => 'text',
            'name' => 'name',
            'value' => 'name',
        ];
        $totals['table'][] = [
            'front_text' => '種類',
            'name_type' => 'select',
            'name' => 'type',
            'value' => [
                [
                    'value' => '2',
                    'value_text' => '文章',
                ],[
                    'value' => '1',
                    'value_text' => '課程',
                ],
            ],
            'selected'=> '4',
        ];
        $totals['table'][] = [
            'front_text' => '產品內容',
            'name_type' => 'textarea',
            'name' => 'content',
            'value' => 'content',
        ];        
        $totals['table'][] = [
            'front_text' => '原價',
            'name_type' => 'text',
            'name' => 'original_price',
            'value' => '500',
        ];
        $totals['table'][] = [
            'front_text' => '售價',
            'name_type' => 'text',
            'name' => 'selling_price',
            'value' => '400',
        ];
        $totals['table'][] = [
            'front_text' => '觀看期限(天)',
            'name_type' => 'text',
            'name' => 'time_limit',
            'value' => '60',
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
        // dd($data['name']);
        $product= Product::create([
            'type'           => $data['type'],
            'name'           => $data['name'],
            'content'        => $data['content'],
            'original_price' => $data['original_price'],
            'selling_price'  => $data['selling_price'],
            'user_id'        => Auth::user()->id,
            'times'          => 0,
            'time_limit'     => $data['time_limit'],
        ]);

        if($product) {
            return redirect('backstage/product')->with('message', '此會員:' . $request->id . ' 新增錯誤');
        } else {
            return redirect('backstage/product');
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
        $product = Product::where('id',$id)
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
            'title' => '產品編輯',
            'title_url' => 'product/update',
        ];
        
        $product = Product::where('id', $id)
            // ->orderBy('P_id', 'desc')
            ->first();
        // dd($product);
        $totals['table'][] = [
            'front_text' => '產品名稱',
            'name_type' => 'text',
            'name' => 'name',
            'value' => $product->name,
        ];
        $totals['table'][] = [
            'front_text' => '種類',
            'name_type' => 'select',
            'name' => 'type',
            'value' => [
                [
                    'value' => '2',
                    'value_text' => '文章',
                ],[
                    'value' => '1',
                    'value_text' => '課程',
                ],
            ],
            'selected'=> '2',
        ];
        $totals['table'][] = [
            'front_text' => '產品內容',
            'name_type' => 'textarea',
            'name' => 'content',
            'value' => $product->content,
        ];
        $totals['table'][] = [
            'front_text' => '原價',
            'name_type' => 'text',
            'name' => 'original_price',
            'value' => $product->original_price,
        ];
        $totals['table'][] = [
            'front_text' => '售價',
            'name_type' => 'text',
            'name' => 'selling_price',
            'value' => $product->selling_price,
        ];
        $totals['table'][] = [
            'front_text' => '觀看次數',
            'name_type' => 'text',
            'name' => 'times',
            'value' => $product->times,
        ];
        $totals['table'][] = [
            'front_text' => '觀看期限',
            'name_type' => 'text',
            'name' => 'time_limit',
            'value' => $product->time_limit,
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
        $product= Product::where('id', $id)->update([
            'type'           => $data['type'],
            'name'           => $data['name'],
            'content'        => $data['content'],
            'original_price' => $data['original_price'],
            'selling_price'  => $data['selling_price'],
            'times'          => $data['times'],
            'time_limit'     => $data['time_limit'],
        ]);
        
        if($product) {
            return redirect('backstage/product')->with('message', '此產品:' . $request->id . ' 新增錯誤');
        } else {
            return redirect('backstage/product');
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
        $product = Product::where('id',$id)
            ->delete();
        if($product) {
            return redirect('backstage/product')->with('message', '此產品:' . $id . ' 刪除錯誤');
        } else {
            return redirect('backstage/product');
        }
    }

    // public function front_back_separation()
    // {
    //     $total = Product::all();
    //     echo json_encode($total);
    // }
}
