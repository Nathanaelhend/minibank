<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        //
        //Mencari data dari database tabel transaction
        $listTransaction = DB::table('transactions')
        ->select('transaction_id', 'credit_account','debit_account','amount','created_at')
        ->get();

        //Mengembalikan data yang dicari dari database dan dipassing ke frontend
        return view('transaction.listTransaction', compact('listTransaction'));   

        
    }

    public function create()
    {
        //Mengarahkan ke halaman create transaction
        return view('transaction.create');
    }

    public function getTransaction(Request $request)
    {
        //Mengambil uuid dari inputan textbox 
        $id = $request->input('id');

        //Mencari data transaksi pada database
        $transactions = Transaction::where('transaction_id',  $id)->get();

        //Mengembalikan response data ditemukan pada database
        return response()->json($transactions);

    }

    public function searchTransaction()
    {
        //Mengarahkan ke halaman getTransaction
        return view('transaction.getTransaction');
    }

    public function store(Request $request)
    {
        //Mengenerate uuid secara otomatis
        $uuid = Str::uuid();
            

        //Melakukan validasi inputan transaksi
        $att = $request->validate([
            'amount' =>'required|numeric',
            'credit_account'=>'required|',
            'debit_account'=>'required'
        ]);
        
        //Mengambil inputan id debit, id credit, dan amount dari inputan textbox
        $idDebitUser = $request->input('credit_account');
        $idCreditUser = $request->input('debit_account');
        $amountInput = $request->input('amount');
        
        //Mnegecek apakah id debit dan credit sama atau tidak, jika tidak, maka dilanjutkan ke validasi berikutnya
        if($idDebitUser != $idCreditUser)
        {
            //jika sudah melewati validasi id, maka dilanutkan pengecekan amount yang akan ditransfer apakah bernilai negatif atau tidak
            //jika tidak negatif maka akan dilakukan penyimpanan ke database
            if($amountInput > 0)
            {
                //insert data dari inputan transaksi dan menyimpan ke database
                $transaction = DB::table('transactions')->insert([
                    'transaction_id' => $uuid,
                    'amount' => $att['amount'],
                    'credit_account' => $att['credit_account'],
                    'debit_account' => $att['debit_account'],
                    'created_at' => now()
                ]);

                
                //Mengambil nomor debit account
                $idDebit = $att['debit_account'];

                //Mengambil nomor credit account 
                $idCredit = $att['credit_account'];

                //Mengambil inputan amount
                $amount = $att['amount'];

                //Melakukan update balance account credit pada tabel account setelah transaksi berhasil
                $updateCredit = DB::table('accounts')
                            ->where('account_no', $idCredit)
                            ->update(['balance' => DB::raw('balance - ' . $amount)]);

                //Melakukan update balance account debit pada tabel account setelah transaksi berhasil
                $updateDebit = DB::table('accounts')
                            ->where('account_no', $idDebit)
                            ->update(['balance' => DB::raw('balance + ' . $amount)]);
                
                
                //Mengarahkan user kembali ke halaman index(list transaction)
                return redirect()->route('transactions.index')->with('status', 'data berhasil disimpan');
            }
            else
            {
                //jika amount bernilai negatif, maka akan memberikan alert amount tidak boleh negatif
                return redirect()->route('transactions.create')->with('status', 'Amount tidak boleh bernilai negatif');
            }
        }
        else{
            //jika id credit dan debit sama, maka akan memberikan alert tidak boleh transfer ke account sendiri
            return redirect()->route('transactions.create')->with('status', 'tidak boleh melakukan transfer ke account sendiri');
        
        }
        
    }

    public function update(Request $request)
    {
        
    }


}
