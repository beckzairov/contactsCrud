@extends('layouts.auth')

@section('section')
    <div class="flex items-center justify-center h-screen">
        <p class="text-2xl text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
            <span class="font-extrabold">contact</span>crud
        </p>
    </div>
@endsection

@section('auth')
        <div class="flex items-center justify-center inline-block h-screen">
            <div class="w-6/12">
                <img src="img/laptop.png" class="m-auto" width="160" height="160">
                <br><br>
                <a href="{{route('login')}}">
                    <button class="bg-white text-gray-400 border-2 border-gray-400 px-4 py-3 rounded font-medium w-full">Уже есть аккаунт? <span class="text-purple-600">Войти</span></button>
                </a>
                <br><br>
                <table width="100%">
                    <tr>
                      <td><hr /></td>
                      <td style="width:1px; padding: 0px 10px; white-space: nowrap;">или</td>
                      <td><hr /></td>
                    </tr>
                </table>
                <br>
                <div class="">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="sr-only">Ф.И.О</label>
                            <input type="text" name="name" id="name" placeholder="Ф.И.О" autocomplete="off" class="bg-gray-100 border-2 p-4 outline-none rounded-lg w-full h-10 text-sm focus:border-2 focus:border-blue-500 @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                        
                            @error('name')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>   
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="sr-only">Эл. почта (example@mail.com)</label>
                            <input type="email" name="email" id="email" placeholder="Эл. почта (example@mail.com)" autocomplete="off" class="bg-gray-100 border-2 w-full p-4 outline-none rounded-lg h-10 text-sm focus:border-2 focus:border-blue-500 @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                        
                            @error('email')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>   
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="sr-only">Пароль</label>
                            <input type="password" name="password" id="password" placeholder="Пароль (8-25 символов)" class="bg-gray-100 border-2 w-full p-4 outline-none rounded-lg focus:border-2 h-10 text-sm focus:border-blue-500 @error('password') border-red-500 @enderror" value="">
                        
                            @error('password')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>   
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="sr-only">Подтверждение пароль</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Подтверждение пароль" class="bg-gray-100 border-2 w-full p-4 outline-none rounded-lg h-10 text-sm focus:border-2 focus:border-blue-500 @error('password_confirmation') border-red-500 @enderror" value="">
                            
                            @error('password_confirmation')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>   
                            @enderror
                        </div>
                            <button type="submit" class="bg-blue-500 text-white h-10 rounded-lg font-medium w-full">Создать аккаунт</button>
                    </form>
                </div>
            </div>
        </div>
@endsection