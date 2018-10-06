<?php

namespace App\Http\Controllers;

// add class
use Auth;
use App\Project;
use App\User;
use App\Slot;


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
            ]);
        }

        return redirect('projects')->with('msg', 'project berhasil di submit!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $projects = Project::where('slug',$slug)->first();
        // menampilkan slot di single
        // $slots = Slot::all()->where('nama_project',$slug);
        $slots = Slot::all()->where('project_name',$projects->title);

        if(empty($projects)) abort (503);
        // , compact('slots') 
        return view('projects.single', compact('projects', 'slots'));
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
}
