@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-6/12 mr-4 bg-white p-6 rounded-lg">
            <div>
                <img src="/img/profile.png" class="m-auto h-4/12 w-4/12" >
                <span class="text-3xl align-top ml-2">
                    <div id="parentContact" class="inline-block flex justify-center">
                            <div class="text-l block">
                                <div class="editContact inline">
                                    <p class="inline m-auto">
                                        {{$contacts->contact}}
                                    </p>
                                    <button onclick="getContactClick()">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline bg-white text-gray-500 rounded hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                </div>
                                <form action="{{ route('dashboard.update', $contacts->id) }}" method="post" class="inline hidden" id="formEmail">
                                    @csrf
                                    @method('PUT')
                                    <label for="contact" class="sr-only">Ф.И.О</label>
                                    <input type="text" name="contact" placeholder="Ф.И.О" class="border-b-2 border-fuchsia-600 focus:border-green-500 outline-none @error('email') border-red-500 @enderror" autocomplete="off" value="{{ $contacts->contact }}">
                                    @error('contact')
                                        <div class="text-red-500 mt-2 text-sm">
                                            {{ $message }}
                                        </div>   
                                    @enderror
        
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                    </div>
                </span>
                <div class="flex justify-center">
                    <p class="text-gray-400 text-xs">
                        Добавлено:
                        {{ Carbon\Carbon::parse($contacts->created_at)->diffForHumans()}}
                    </p>
                </div>
            </div>
            <div class="flex flex-row item-center justify-center mt-2 mb-4">
                <div id="parentEmail" class="inline mr-4">
                    @foreach ($emails as $email)
                        <div class="text-l block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-gray-500 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div class="editEmail inline">
                                <p class="inline align-middle">
                                    {{$email->email}}
                                </p>
                                <button onclick="getEmailClick()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline bg-white text-blue-500 rounded hover:text-white hover:bg-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                            </div>
                            <form action="{{ route('contact.update', $email->id) }}" method="post" class="inline hidden" id="formEmail">
                                @csrf
                                @method('PUT')
                                <label for="email" class="sr-only">Изменить эл. почта</label>
                                <input type="text" name="email" placeholder="Изменить эл. почта" class="border-b-2 border-fuchsia-600 focus:border-green-500 outline-none @error('email') border-red-500 @enderror" autocomplete="off" value="{{ $email->email }}">
                                @error('email')
                                    <div class="text-red-500 mt-2 text-sm">
                                        {{ $message }}
                                    </div>   
                                @enderror
    
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </form>
                            <form action="{{route('contact.destroy', $email->id)}}" class="inline" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="getEmail" value="email">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline bg-white text-red-500 rounded hover:text-white hover:bg-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <div id="parentPhone" class="inline ml-4">
                    @foreach ($phones as $phone)
                        <div class="text-l">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-green-500 rounded-full text-white cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div class="editPhone inline">
                                <p class="inline align-middle @error('message') @enderror">
                                    {{$phone->phone}}
                                </p>
                                <button onclick="getPhoneClick()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline bg-white text-blue-500 rounded hover:text-white hover:bg-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                            </div>
                            <form action="{{ route('contact.update', $phone->id) }}" method="post" class="inline hidden" id="form">
                                @csrf
                                @method('PUT')
                                <label for="phone" class="sr-only">Изменить тел. номер</label>
                                <input type="text" name="phone" id="phone" placeholder="Изменить тел. номер" class="border-b-2 border-fuchsia-600 focus:border-green-500 outline-none" autocomplete="off" value="{{ $phone->phone }}">

                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </form>
                            <form action="{{route('contact.destroy', $phone->id)}}" method="post" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <input type="hidden" name="getPhone" value="phone">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline bg-white text-red-500 rounded hover:text-white hover:bg-red-500" id="delete" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
            <form action="{{route('dashboard.destroy', $contacts->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="deletePhone">
                <button type="submit" class="bg-red-500 text-white rounded float-right font-bold align-middle p-3">
                    Удалить контакт
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            
            </form>
            
        </div>
            
        <div class="w-4/12 mr-4 bg-white p-6 rounded-lg">
            <p class="mb-2 text-gray-800">
                Добавить дополнительный контакт
            </p>
            @if(session()->has('message'))
                <div class="bg-green-200 rounded text-green-500 mb-4 pl-2">
                    {{ session()->get('message') }}
                </div>
            @endif
            <form action=" {{ route('contact.store') }} " method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="sr-only">Эл. почта</label>
                    <input type="email" name="email" id="email" autocomplete="off" placeholder="Доп. электронный почта" class="f658 bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                    <i class="fal fa-envelope-open-text"></i>
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>   
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="phone" class="sr-only">Номер телефон</label>
                    <input type="text" name="phone" id="phone" autocomplete="off" placeholder="Доп. телефон" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('phone') border-red-500 @enderror" value="{{ old('phone') }}">
                
                    @error('phone')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>   
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Добавить</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/clickEvents.js')}}"></script>
@endsection