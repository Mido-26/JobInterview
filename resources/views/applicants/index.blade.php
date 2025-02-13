@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Applicants List</h1>

        @if($applicants->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md shadow-sm" role="alert">
                <p class="text-sm">No applicants have been added yet. Please check back later.</p>
            </div>
        @else
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($applicants as $applicant)
                    <a href="{{ route('profile.show', $applicant->id) }}" 
                       class="block bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 p-6 border border-gray-200 hover:border-blue-300">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-semibold text-gray-800">{{ $applicant->full_name }}</h2>
                            <span class="text-sm text-gray-500">
                                {{ $applicant->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="mt-4">
                            <p class="text-gray-700">{{ $applicant->email }}</p>
                            <p class="text-gray-700">{{ $applicant->phone }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
