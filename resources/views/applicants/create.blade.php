@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create Applicant Profile</h2>
    
    <!-- Instructions -->
    <p class="text-gray-600 mb-6">Please fill out the form below to create the applicant's profile. All fields are required, and you can add multiple entries for education, work experience, and skills.</p>

    <!-- Start Form -->
    <form action="{{ route('applicants.store') }}" method="POST">
        @csrf

        <!-- Full Name -->
        <div class="mb-4">
            <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" placeholder="John Doe" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('full_name') 
                <p class="text-red-500 text-xs">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="johndoe@example.com" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('email') 
                <p class="text-red-500 text-xs">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Phone Number -->
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="(123) 456-7890" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('phone') 
                <p class="text-red-500 text-xs">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Education -->
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Education History</h3>
            <p class="text-gray-600 text-sm mb-2">Provide the details of your educational background. You can add multiple entries.</p>
            <div id="education-fields">
                <div class="education-entry flex space-x-4 mb-4">
                    <input type="text" name="education[0][institution_name]" placeholder="Institution Name" class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <input type="text" name="education[0][degree]" placeholder="Degree" class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <input type="number" name="education[0][year]" placeholder="Year of Graduation" class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            <button type="button" id="add-education" class="text-blue-600 text-sm">+ Add Another Education Entry</button>
            @error('education.*') 
                <p class="text-red-500 text-xs">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Work Experience -->
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Work Experience</h3>
            <p class="text-gray-600 text-sm mb-2">Please add details of your previous work experiences. You can add multiple roles.</p>
            <div id="experience-fields">
                <div class="experience-entry flex space-x-4 mb-4">
                    <input type="text" name="experience[0][company_name]" placeholder="Company Name" class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <input type="text" name="experience[0][role]" placeholder="Your Role" class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <input type="text" name="experience[0][duration]" placeholder="Duration (e.g., 2 years)" class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            <button type="button" id="add-experience" class="text-blue-600 text-sm">+ Add Another Work Experience</button>
            @error('experience.*') 
                <p class="text-red-500 text-xs">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Skills -->
        <div class="mb-4">
            <h3 class="text-lg font-medium text-gray-700">Skills</h3>
            <p class="text-gray-600 text-sm mb-2">Add the skills you have. You can list multiple skills.</p>
            <div id="skills-fields">
                <div class="skill-entry flex space-x-4 mb-4">
                    <input type="text" name="skills[0][skill_name]" placeholder="Skill (e.g., Java, HTML, etc.)" class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            <button type="button" id="add-skill" class="text-blue-600 text-sm">+ Add Another Skill</button>
            @error('skills.*') 
                <p class="text-red-500 text-xs">{{ $message }}</p> 
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Save Profile
        </button>
    </form>
</div>


<script>
    document.getElementById('add-education').addEventListener('click', function() {
        var index = document.querySelectorAll('.education-entry').length;
        var newEducation = `
            <div class="education-entry flex space-x-4 mb-4">
                <input type="text" name="education[${index}][institution_name]" placeholder="Institution Name" class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <input type="text" name="education[${index}][degree]" placeholder="Degree" class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <input type="number" name="education[${index}][year]" placeholder="Year of Graduation" class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        `;
        document.getElementById('education-fields').insertAdjacentHTML('beforeend', newEducation);
    });

    document.getElementById('add-experience').addEventListener('click', function() {
        var index = document.querySelectorAll('.experience-entry').length;
        var newExperience = `
            <div class="experience-entry flex space-x-4 mb-4">
                <input type="text" name="experience[${index}][company_name]" placeholder="Company Name" class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <input type="text" name="experience[${index}][role]" placeholder="Your Role" class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <input type="text" name="experience[${index}][duration]" placeholder="Duration (e.g., 2 years)" class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        `;
        document.getElementById('experience-fields').insertAdjacentHTML('beforeend', newExperience);
    });

    document.getElementById('add-skill').addEventListener('click', function() {
        var index = document.querySelectorAll('.skill-entry').length;
        var newSkill = `
            <div class="skill-entry flex space-x-4 mb-4">
                <input type="text" name="skills[${index}][skill_name]" placeholder="Skill (e.g., Java, HTML, etc.)" class="w-1/3 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        `;
        document.getElementById('skills-fields').insertAdjacentHTML('beforeend', newSkill);
    });
</script>

@endsection
