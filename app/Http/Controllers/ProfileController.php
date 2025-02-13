<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Applicant;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $applicants = Applicant::orderBy('created_at', 'desc')->get();
        return view('applicants.index', compact('applicants'));
    }

    public function create()
    {
        return view('applicants.create');
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:applicants,email',
            'phone' => 'required|string|max:20',
            'education.*.institution_name' => 'required|string|max:255',
            'education.*.degree' => 'required|string|max:255',
            'education.*.year' => 'required|integer',
            'experience.*.company_name' => 'required|string|max:255',
            'experience.*.role' => 'required|string|max:255',
            'experience.*.duration' => 'required|string|max:255',
            'skills.*.skill_name' => 'required|string|max:255',
        ]);

        // Store applicant's basic information
        $applicant = Applicant::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Store Education, Experience, and Skills
        foreach ($request->education as $edu) {
            Education::create([
                'applicant_id' => $applicant->id,
                'institution_name' => $edu['institution_name'],
                'degree' => $edu['degree'],
                'year' => $edu['year'],
            ]);
        }

        foreach ($request->experience as $exp) {
            Experience::create([
                'applicant_id' => $applicant->id,
                'company_name' => $exp['company_name'],
                'role' => $exp['role'],
                'duration' => $exp['duration'],
            ]);
        }

        foreach ($request->skills as $skill) {
            Skill::create([
                'applicant_id' => $applicant->id,
                'skill_name' => $skill['skill_name'],
            ]);
        }

        return redirect()->route('profile.show', $applicant->id)->with('success', 'Profile created successfully!');
    }

    public function show($id)
    {
        $applicant = Applicant::with(['education', 'experience', 'skills'])
            ->findOrFail($id);
        
        return view('profile.show', compact('applicant'));
    }

    public function edit($id)
    {
        $applicant = Applicant::with(['education', 'experience', 'skills'])
            ->findOrFail($id);
        
        return view('profile.edit', compact('applicant'));
    }

    public function update(Request $request, $id)
{
    // Validate the incoming request
    $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'education.*.institution_name' => 'required|string|max:255',
        'education.*.degree' => 'required|string|max:255',
        'education.*.year' => 'required|integer',
        'experience.*.company_name' => 'required|string|max:255',
        'experience.*.role' => 'required|string|max:255',
        'experience.*.duration' => 'required|string|max:255',
        'skills.*.skill_name' => 'required|string|max:255',
    ]);

    // Find the applicant
    $applicant = Applicant::findOrFail($id);

    // Update the applicant's basic information
    $applicant->update([
        'full_name' => $request->full_name,
        'email' => $request->email,
        'phone' => $request->phone,
    ]);

    // Update Education
    // dd($request);
    $applicant->education()->delete(); // Remove old education records
    if($request->education){
        foreach ($request->education as $edu) {
            $applicant->education()->create([
                'institution_name' => $edu['institution_name'],
                'degree' => $edu['degree'],
                'year' => $edu['year'],
            ]);
        }
    }else{
        return redirect()->back()->with('error', 'Your Education Background is needed is needed.');
    }
    

    // Update Work Experience
    $applicant->experience()->delete(); // Remove old work experience records
    // dd($request);
    if($request->experience){
        foreach ($request->experience as $exp) {
            $applicant->experience()->create([
                'company_name' => $exp['company_name'],
                'role' => $exp['role'],
                'duration' => $exp['duration'],
            ]);
        }
    }else{
        return redirect()->back()->with('error', 'Atleast one work experience is needed.');
    }



    // Update Skills
    $applicant->skills()->delete(); // Remove old skills
    if($request->skills){ //checking if skills are available if not return error
        foreach ($request->skills as $skill) {
            $applicant->skills()->create([
                'skill_name' => $skill['skill_name'],
            ]);
        }
    }else{
        return redirect()->back()->with('error', 'Atleast one skills is needed.');
    }
    

    return redirect()->route('profile.show', $applicant->id)->with('success', 'Profile updated successfully.');
}


}
