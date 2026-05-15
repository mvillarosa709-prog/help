@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="mx-auto max-w-md rounded-xl border border-slate-200 bg-white p-8 shadow-sm">
    <h1 class="mb-6 text-2xl font-semibold">Create your account</h1>

    <form method="POST" action="{{ route('register.perform') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700">Full name</label>
            <input id="name" name="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required class="mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
            <input id="password" name="password" type="password" required class="mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required class="mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" />
        </div>

        <button type="submit" class="w-full rounded-md bg-slate-900 px-4 py-2 text-white hover:bg-slate-800">Register</button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-600">
        Already registered? <a href="{{ route('login') }}" class="font-medium text-slate-900 hover:underline">Login</a>
    </p>
</div>
@endsection
