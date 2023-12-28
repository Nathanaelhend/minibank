<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AccountController;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //mencari data pada database tabel accounts
        $listAccount = DB::table('accounts')
        ->select('account_no','name','balance','created_at')
        ->get();   

        //menuju ke halaman listAccount
        return view('account.listAccount', compact('listAccount'));     

        // dd($listAccount);
    }

    public function getAccount(Request $request)
    {
        //Mengambil id dari inputan textbox
        $id = $request->input('id');

        //Mencari id yang diinputkan user dan dicari di database
        $accounts = Account::where('account_no',  $id)->get();

        //mengembalikan hasil id apabila ketemu di database untuk ditampilkan di frontend
        return response()->json($accounts);
    }

    public function search()
    {
        //Mengarahkan ke halaman get Account
        return view('account.getAccount');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Mengarahkan ke halaman create Account
        return view('account.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Melakukan validasi inputan
        $att = $request->validate([
            'name'=>'required|alpha',
            'balance'=>'required|integer'
        ],
        [
            //Memberi message apabila tidak sesuai dengan yang diminta
            'name.required' => 'Nama harus diisi',
            'name.alpha' => 'Nama tidak boleh mengandung angka',
            'name.unique' => 'Nama harus unik',
            'balance.required' => 'Balance harus diisi',
            'balance.integer' => 'Balance harus numeric'
        ]
        
        );
        // dd($att);
        
        //Mengambil value inputan dari textbox form create account
        $input = $request->input('name');
        
        //Mencari apakah sudah ada nama pada database yang sama
        $name = Account::where('name', $input)->get();

        //Mengambil value inputan balance dari textbox form create account
        $balanceUser = $request->input('balance');

        //Mengecek apakah sudah ada atau belum nama di database, jika belum ada maka msuk ke if,
        //Jika sudah ada, maka masuk ke else dan memberikan message
        if($name->isEmpty())
        {
            //mengecek apakah balance yang diinput bernilai negatif atau tidak, jika tidak account akan dibuat
            if($balanceUser > 0)
            {
                //Melakukan insert data ke database
                $result = DB::table('accounts')->insert([
                    'name'=> $att['name'],
                    'balance'=>$att['balance'],
                    'created_at'=> now()
                ]);

                //Memberikan message data berhasil disimpan dan return ke halaman listAccount
                return redirect()->route('accounts.index')->with('status', 'data berhasil disimpan');
            }
            else
            {
                //Memberikan message apabila inputan balance bernilai negatif
                return redirect()->route('accounts.create')->with('status', 'balance tidak boleh bernilai negatif');
            }
        }
        else
        {
            //Memberikan message apabila nama inputan tidak unik (sudah ada yang terdaftar di database)
            return redirect()->route('accounts.create')->with('status', 'Nama sudah terdaftar, silahkan gunakan nama lain');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
