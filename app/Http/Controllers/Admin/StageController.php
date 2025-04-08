<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
{
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $stages = Stage::paginate(10); // or any number you prefer
            return view('admins.stage.index', compact('stages'));
        }
    
        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('admins.stage.create');
        }
    
        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'desc' => 'nullable|string',
            ]);
    
            Stage::create($request->all());
    
            return redirect()->route('stages.index')
                ->with('success', 'Stage created successfully.');
        }
    
        /**
         * Display the specified resource.
         */
        public function show(Stage $stage)
        {
            return view('admins.stage.show', compact('stage'));
        }
    
        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Stage $stage)
        {
            return view('admins.stage.edit', compact('stage'));
        }
    
        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, Stage $stage)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'desc' => 'nullable|string',
            ]);
    
            $stage->update($request->all());
    
            return redirect()->route('stages.index')
                ->with('success', 'Stage updated successfully.');
        }
    
        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Stage $stage)
        {
            $stage->delete();
    
            return redirect()->route('stages.index')
                ->with('success', 'Stage deleted successfully.');
        }
  
     
}
