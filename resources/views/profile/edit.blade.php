@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Update Applicant Profile</h2>
    
    @if (session('error'))
    <div class="text-red-500 text-sm bg-red-100 p-3 mb-4 rounded">
        {{ session('error') }}
    </div>
@endif
    <form action="{{ route('profile.update', $applicant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Full Name -->
        <div class="mb-4">
            <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" name="full_name" id="full_name" 
                   value="{{ old('full_name', $applicant->full_name) }}" 
                   class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('full_name') 
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input type="email" name="email" id="email" 
                   value="{{ old('email', $applicant->email) }}" 
                   class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('email') 
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Phone Number -->
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="text" name="phone" id="phone" 
                   value="{{ old('phone', $applicant->phone) }}" 
                   class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('phone') 
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Education History -->
        <div class="mb-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-700">Education History</h3>
                <button type="button" onclick="addEducation()" class="text-blue-600 hover:text-blue-800 text-sm">
                    + Add Education
                </button>
            </div>
            <div id="education-fields">
                @foreach(old('education', $applicant->education) as $index => $edu)
                <div class="education-entry flex space-x-4 mb-4">
                    <input type="text" name="education[{{ $index }}][institution_name]" 
                           value="{{ old("education.$index.institution_name", $edu->institution_name) }}"
                           placeholder="Institution Name"
                           class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <input type="text" name="education[{{ $index }}][degree]" 
                           value="{{ old("education.$index.degree", $edu->degree) }}"
                           placeholder="Degree"
                           class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <input type="text" name="education[{{ $index }}][year]" 
                           value="{{ old("education.$index.year", $edu->year) }}"
                           placeholder="Year"
                           class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <button type="button" onclick="removeField(this)" class="text-red-600 hover:text-red-800">Remove</button>
                </div>
                @endforeach
            </div>
            @error('education.*') 
                <p class="text-red-500 text-xs">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Work Experience -->
        <div class="mb-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-700">Work Experience</h3>
                <button type="button" onclick="addExperience()" class="text-blue-600 hover:text-blue-800 text-sm">
                    + Add Experience
                </button>
            </div>
            <div id="experience-fields">
                @foreach(old('experience', $applicant->experience) as $index => $exp)
                <div class="experience-entry flex space-x-4 mb-4">
                    <input type="text" name="experience[{{ $index }}][company_name]" 
                           value="{{ old("experience.$index.company_name", $exp->company_name) }}"
                           placeholder="Company Name"
                           class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <input type="text" name="experience[{{ $index }}][role]" 
                           value="{{ old("experience.$index.role", $exp->role) }}"
                           placeholder="Role"
                           class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <input type="text" name="experience[{{ $index }}][duration]" 
                           value="{{ old("experience.$index.duration", $exp->duration) }}"
                           placeholder="Duration"
                           class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <button type="button" onclick="removeField(this)" class="text-red-600 hover:text-red-800">Remove</button>
                </div>
                @endforeach
            </div>
            @error('experience.*') 
                <p class="text-red-500 text-xs">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Skills -->
        <div class="mb-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-700">Skills</h3>
                <button type="button" onclick="addSkill()" class="text-blue-600 hover:text-blue-800 text-sm">
                    + Add Skill
                </button>
            </div>
            <div id="skills-fields">
                @foreach(old('skills', $applicant->skills) as $index => $skill)
                <div class="skill-entry flex space-x-4 mb-4">
                    <input type="text" name="skills[{{ $index }}][skill_name]" 
                           value="{{ old("skills.$index.skill_name", $skill->skill_name) }}"
                           placeholder="Skill name"
                           class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <button type="button" onclick="removeField(this)" class="text-red-600 hover:text-red-800">Remove</button>
                </div>
                @endforeach
            </div>
            @error('skills.*') 
                <p class="text-red-500 text-xs">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Update Profile
        </button>
    </form>
</div>

<script>
    function addEducation() {
        const index = document.querySelectorAll('.education-entry').length;
        const template = `
            <div class="education-entry flex space-x-4 mb-4">
                <input type="text" name="education[${index}][institution_name]" 
                       placeholder="Institution Name"
                       class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <input type="text" name="education[${index}][degree]" 
                       placeholder="Degree"
                       class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <input type="text" name="education[${index}][year]" 
                       placeholder="Year"
                       class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <button type="button" onclick="removeField(this)" class="text-red-600 hover:text-red-800">Remove</button>
            </div>`;
        document.getElementById('education-fields').insertAdjacentHTML('beforeend', template);
    }

    function addExperience() {
        const index = document.querySelectorAll('.experience-entry').length;
        const template = `
            <div class="experience-entry flex space-x-4 mb-4">
                <input type="text" name="experience[${index}][company_name]" 
                       placeholder="Company Name"
                       class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <input type="text" name="experience[${index}][role]" 
                       placeholder="Role"
                       class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <input type="text" name="experience[${index}][duration]" 
                       placeholder="Duration"
                       class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <button type="button" onclick="removeField(this)" class="text-red-600 hover:text-red-800">Remove</button>
            </div>`;
        document.getElementById('experience-fields').insertAdjacentHTML('beforeend', template);
    }

    function addSkill() {
        const index = document.querySelectorAll('.skill-entry').length;
        const template = `
            <div class="skill-entry flex space-x-4 mb-4">
                <input type="text" name="skills[${index}][skill_name]" 
                       placeholder="Skill name"
                       class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <button type="button" onclick="removeField(this)" class="text-red-600 hover:text-red-800">Remove</button>
            </div>`;
        document.getElementById('skills-fields').insertAdjacentHTML('beforeend', template);
    }

    function removeField(button) {
        button.closest('.education-entry, .experience-entry, .skill-entry').remove();
    }
</script>
@endsection