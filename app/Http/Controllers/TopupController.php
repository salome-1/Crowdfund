<?php

namespace App\Http\Controllers;


use Auth;
use App\User;
use App\Topup;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topups = DB::table('topups')->get();
        return view('topups.approve', compact('topups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('topups.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'user_name' => 'required|min:1',
          'nominal' => 'required',
          'proof_image' => 'required|mimes:jpeg,jpg,png|max:5000kb',
        ]);
        
        $image = $request->file('proof_image');
        $fileName = $image->getClientOriginalName() . '.' . time() . '.png';
        $request->file('proof_image')->storeAs('public/proof_image', $fileName);

        $topups = Topup::create([
            'username' => $request['username'],
            'user_name' => $request['user_name'],
            'nominal' => $request['nominal'],
            'bank' => $request['bank'],
            'user_id' => Auth::user()->id,
            'proof_image' => $fileName,
            'captcha' => 'required|captcha'
        ]);

        // histori transaksi
        $transactions = Transaction::create([
            'user_id' => Auth::user()->id,
            'topup_id' => $topups->id,
            'nominal' => $topups->nominal,
            'transaction_image' => $topups->proof_image,
            'transaction_type' => 1,
            'status' => 'Menunggu Persetujuan',
        ]);
        return redirect('home')->with('msg', 'Selamat, top up saldo berhasil dilakukan!, Admin akan mengecek, Harap menunggu konfirmasi Admin.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topups = DB::table('topups')->where('id', $id)->first();
        return view('topups.edit', compact('topups', 'id'));
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
        $topups = Topup::withAnyStatus()->where('id', $id)->first();
        $user = User::where('id', $topups->user_id)->first();
        $transactions = Transaction::where('topup_id', $topups->id)->first();
        switch($request->get('approve'))
        {
            case 0:
                Topup::postpone($id);
                $transactions->update([
                    'status' => 'Ditunda',
                ]);
                break;
            case 1:
                Topup::approve($id);
                $user->update([
                    'balance' => $user->balance + $topups->nominal ,
                ]);
                $transactions->update([
                    'deposit' => $transactions->deposit + $topups->nominal,
                    'status' => 'Topup Disetujui',
                ]);   
                break;
            case 2:
                Topup::reject($id);
                $transactions->update([
                    'status' => 'Ditolak',
                ]);
                break;
            case 3:
                Topup::postpone($id);
                $transactions->update([
                    'status' => 'Ditunda',
                ]);
                break;
            default:    
                break;

        }
        return redirect('topups');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort('404');
    }
}
