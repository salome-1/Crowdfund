<?php

namespace App\Http\Controllers;

// add class
use Auth;
use App\Project;
use App\User;
use App\Slot;
use App\Transaction;


use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //menampilkan project di halaman awal
    public function welcome()
    {
      $projects = Project::all();
      return view('welcome', compact('projects'));
    }
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi saat create project
        $this->validate($request, [
            'title' => 'required|min:3',
            'opened_at' => 'required|date|before:closed_at',
            'closed_at' => 'required|date|after:opened_at',
            'description' => 'required|min:10',
            'slot' => 'required|min:1|max:100',
            'project_price' => 'required',
            'project_image' => 'required|mimes:jpeg,jpg,png|max:5000kb',
        ]);

        // gambar
        $image = $request->file('project_image');
        $fileName = $image->getClientOriginalName() . '.' . time() . '.png';
        $request->file('project_image')->storeAs('public/project_image', $fileName);

        //slug
        $slug = str_slug($request->title, '-');

        if(Project::where('slug',$slug)->first() !=null) {
            $slug = $slug . '-' .time();
        }

        $projects = Project::create([
            'title' => $request['title'],
            'slug' => $slug,
            'opened_at' => $request['opened_at'],
            'closed_at' => $request['closed_at'],
            'description' => $request['description'],
            'slot' => $request['slot'],
            'project_price' => $request['project_price'],
            'user_id' => Auth::user()->id,
            'project_image' => $fileName,
            'slot_price' => $request['project_price'] / $request['slot'],
        ]);


        // membuat slot
        for ($i = 0; $i < $projects->slot ; $i++) {
            $slots = Slot::create([
                'price' => $projects->slot_price,
                'project_id' => $projects->id,
                'project_name' => $projects->title,
                'project_slug' => $projects->slug,
            ]);
        }

        // return redirect('projects')->with('msg', 'project berhasil di submit!');
        return back()->with('msg', 'project berhasil di submit!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::where('slug',$slug)->first();
        $slots = Slot::all()->where('project_slug',$project->slug);
        
        if(empty($project)) abort (503);

        return view('projects.single', compact('project', 'slots'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
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

        $project = Project::findOrFail($id);
        $image = $request->file('project_image');
        $fileName = $image->getClientOriginalName() . '.' . time() . '.png';
        $request->file('project_image')->storeAs('public/project_image', $fileName);

        $this->validate($request, [
            'title' => 'required|min:3',
            'opened_at' => 'required|date|before:closed_at',
            'closed_at' => 'required|date|after:opened_at',
            'description' => 'required|min:10',
            'slot' => 'required|min:1|max:100',
            'project_price' => 'required',
            'project_image' => 'required|mimes:jpeg,jpg,png|max:5000kb',
        ]);

        if($project->isOwner()){
            $project->update([
                'title' => $request['title'],
                'opened_at' => $request['opened_at'],
                'closed_at' => $request['closed_at'],
                'description' => $request['description'],
                'slot' => $request['slot'],
                'project_price' => $request['project_price'],
                'project_image' => $fileName,
                // 'uang_per_slot'=> $request['project_price'] / $request['slot'],
            ]);
        }else{
            abort('500');
        }

        return redirect()->route('projects.show',['project'=>$project->slug])->with('msg', 'project berhasil di edit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if($project->isOwner())
            $project->delete();
        else abort('500');
        return redirect('projects')->with('msg', 'project berhasil di Hapus!');
    }

    public function buySlot(Request $request, $slug)
    {
        $project = Project::where('slug', $slug)->first();
        $slots = Slot::all()->where('project_slug', $project->slug);
        
        $slot = Slot::where('status', 0)->first();

        if($slot->price <= Auth::user()->balance){
            $slot->update([
                'status' => 1,
                'user_id' => $request['userid'],
                'user_name' => Auth::user()->username,
            ]);
            Auth::user()->update([
                'balance' => Auth::user()->balance - $slot->price,
            ]);

            $transaction = Transaction::create([
                'user_id' => Auth::user()->id,
                'slot_id' => $slot->id,
                'project_id' => $slot->project_id,
                'project_name' => $slot->project_name,
                'nominal' => $slot->price,
                'transaction_type' => 2,
                'credit' => $slot->price,
                'status' => 'Investasi sedang berlangsung',
            ]);  
        }else{
            // klo saldo ga cukup return ini nb. bikin error message dong kntl!1!1!1!1
            abort('500');
        }

        // bikin success message nya juga dong ppx!1!1!1!1
        return back();
    }
}
