<?php

namespace App\Http\Controllers;

use App\Todo;


use Illuminate\Http\Request;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function show($id)
    {
        $todo = $this->todo->find($id);
        return view('todo.show', ['todo' => $todo]);
    }

    public function index()
    {
        $todos = $this->todo->all();
        //dd($todos);

        return view('todo.index', ['todos' => $todos]);
    }

    public function create()
    {
        return view('todo.create');

    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        
        
        $this->todo->fill($inputs);
        $this->todo->save();

        return redirect()->route('todo.index');
    }

    public function edit($id)
    {
        // TODO: 編集対象のレコードの情報を持つTodoモデルのインスタンスを取得
        $todo = $this->todo->find($id);
        return view('todo.edit', ['todo' => $todo]);
    }

    public function update(Request $request, $id) // 第1引数: リクエスト情報の取得　第2引数: ルートパラメータの取得
    {
        $inputs = $request->all();
        $todo = $this->todo->find($id);
        $todo->fill($inputs)->save();

        return redirect()->route('todo.show', $todo->id);
    }
    
}

