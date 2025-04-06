<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\SubStage;
use App\Models\Stage;
use Illuminate\Http\Request;

class SubStageController extends Controller
{
        public function index()
        {
            $subStages = SubStage::with('stage')->paginate(10);
            return view('admins.substage.index', compact('subStages'));
        }
    
        public function create()
        {
            $stages = Stage::all();
            return view('admins.substage.create', compact('stages'));
        }
    
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'desc' => 'nullable|string',
                'stage_id' => 'required|exists:stages,id',
            ]);
    
            SubStage::create($request->all());
    
            return redirect()->route('sub_stages.index')->with('success', 'SubStage created successfully.');
        }
    
        public function show(SubStage $subStage)
        {
            return view('substage.show', compact('subStage'));
        }
    
        public function edit($id)
        {
            $subStage = SubStage::findOrFail($id); // Explicitly fetch the substage by id
            $stages = Stage::all(); // Fetch all stages for the dropdown
            return view('admins.substage.edit', compact('subStage', 'stages'));
        }
        public function update(Request $request, SubStage $subStage)
        {
            // Validate the incoming request
            $request->validate([
                'name' => 'required|string|max:255',
                'desc' => 'nullable|string',
                'stage_id' => 'required|exists:stages,id',
            ]);
      
            // Update the substage with the validated data
            $subStage->update($request->all());
     
            // Redirect back to the substages index with a success message
            return redirect()->route('sub_stages.index')->with('success', 'SubStage updated successfully.');
        }
        

        public function destroy(SubStage $subStage)
        {
            try {
                $subStage->delete();
                return response()->json(['success' => true, 'message' => 'تم حذف المرحلة بنجاح!']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'فشل في حذف المرحلة!'], 500);
            }
        }
    }
    
