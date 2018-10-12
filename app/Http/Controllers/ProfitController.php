<?php

namespace App\Http\Controllers;

// add class
use Auth;
use App\Project;
use App\User;
use App\Slot;
use App\Transaction;

use Illuminate\Http\Request;

class ProfitController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::where('slug',$slug)->first();
        $slots = Slot::get()->where('project_slug',$project->slug);

        return view('profits.single', compact('project', 'slots'));
    }
        
    public function sendProfit(Request $request , $slug)
    {
        $project = Project::where('slug',$slug)->first();
        $slots = Slot::get()->where('project_slug',$project->slug);
        $users = new User;
        
        // index dari colections = id_slot-1
        $first_index_slot = $slots->first()->id-1;

        for ($i = $first_index_slot; $i < count($slots) + $first_index_slot; $i++) 
        {
            $transaction = Transaction::create([
                'transaction_type' => 3,
                'project_id' => $slots->get($i)->project_id,
                'project_name' => $slots->get($i)->project_name,
                'slot_id' => $slots->get($i)->id,
                'user_id' => $slots->get($i)->user_id,
                'nominal' => $request->nominal,
                'deposit' => $request->nominal,
                'status' => 'Profit Telah di Bagikan' ,
            ]);
            $user = $users->where('id', $slots->get($i)->user_id)->first();
            $user->update(['balance' => $user->balance + $request->nominal ]);
        }

        return back()->with('msg', 'Profit Telah Dibagikan');
    }

}

    
