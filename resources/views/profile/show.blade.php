@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <a href="{{ route('applicants.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Applicants
        </a>

        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Header Section -->
            <div class="border-b pb-4 mb-6">
                <h1 class="text-3xl font-bold text-gray-800">{{ $applicant->full_name }}</h1>
                <div class="mt-2 space-y-1">
                    <p class="text-gray-600">{{ $applicant->email }}</p>
                    <p class="text-gray-600">{{ $applicant->phone }}</p>
                </div>
                <a href="{{ route('applicants.edit', $applicant->id) }}" class="inline-flex items-center text-blue-600 hover:text-blue-900 underline mt-5 text-lg">
                    Edit Applicant CV
                </a>
                
            </div>

            <!-- Education Section -->
            <section class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Education</h2>
                <div class="space-y-4">
                    @foreach($applicant->education as $edu)
                        <div class="border-l-4 border-blue-500 pl-4">
                            <h3 class="font-medium text-gray-800">{{ $edu->degree }}</h3>
                            <p class="text-gray-600">{{ $edu->institution_name }}</p>
                            <p class="text-sm text-gray-500">{{ $edu->year }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Work Experience Section -->
            <section class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Work Experience</h2>
                <div class="space-y-4">
                    @foreach($applicant->experience as $work)
                        <div class="border-l-4 border-green-500 pl-4">
                            <h3 class="font-medium text-gray-800">{{ $work->role }}</h3>
                            <p class="text-gray-600">{{ $work->company_name }}</p>
                            <p class="text-sm text-gray-500">{{ $work->duration }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Skills Section -->
            <section>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Skills</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach($applicant->skills as $skill)
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                            {{ $skill->skill_name }}
                        </span>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection