<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::all();

        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'type' => 'nullable|max:50', 
                'detail' => 'nullable|max:500',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }

    public function edit(Request $request)//edit メソッドは、リクエストを受け取るために定義されている。
    {
        if ($request->isMethod('post')) {
            
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'type' => 'nullable|max:50', 
                'detail' => 'nullable|max:500',
            ]);
            
            $item= Item::where('id', '=' , $request->id)->first();
            $item->name = $request->name;
            $item->type = $request->type;
            $item->detail = $request->detail;
            $item->save();//レコードを上書き保存する

        return redirect('/items');
        }

        $item = Item::find($request->id);

        return view('item.edit', compact('item'));
    }

    public function delete(Request $request){
        $item = Item::where('id', '=' , $request->id)->first();
        $item->delete();

        return redirect('/items');
    }
    
}
