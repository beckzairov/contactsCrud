@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-6/12 mr-4 bg-white p-6 rounded-lg inline">
            <form action="{{route('search')}}" method="GET">
                @csrf
                <div class="relative text-gray-600 focus-within:text-gray-400 mb-8 shadow rounded">
                  <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                      <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                  </span>
                  <input type="text" name="search" class="py-2 text-sm text-white rounded-md pl-10 w-full focus:outline-none focus:bg-white focus:text-gray-900" placeholder="Search..." autocomplete="off">
                </div>
            </form>
            
            @if(session()->has('message'))
                <div class="bg-green-200 rounded text-green-500 mb-4 pl-2">
                    {{ session()->get('message') }}
                </div>
            @endif    
            
            @foreach ($results as $result)
                <div class="bg-white-800  rounded font-medium text-gray-800 shadow  hover:bg-blue-700 hover:text-white"> 
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" class="absolute top-1 right-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    
                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>
                    
                        <div x-show="dropdownOpen" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                            <div class="inline">
                                <form action="{{route('contact.edit', $result->id)}}" method="POST" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white ">
                                  @csrf
                                  @method('PUT')
                                  <button type="submit" class="w-full text-left">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                      </svg>
                                      Edit User
                                  </button>
                              
                                </form>
                                <form action="{{route('dashboard.destroy', $result->id)}}" method="POST" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-blue-500 hover:text-white ">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="w-full text-left">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                      </svg>
                                      Delete User
                                  </button>
                              
                                </form>
                            </div>
                        </div>
                    </div> 
                    <a href="{{route('contact.show', $result->id)}}">  
                        <div class="mb-6 m-2 p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{$result->contact}}
                            <span class="text-gray-400 text-xs float-right inline">
                                Added by:
                                {{ $result->user->name }}  
                            </span>
                            <p class="text-gray-400 text-xs text-right">
                                {{ Carbon\Carbon::parse($result->created_at)->diffForHumans()}}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach

            {{$results->appends(request()->toArray())->links()}}
        </div>
        
        <div class="w-3/12 bg-white p-6 rounded-lg h-96">
            <p class="mb-2 text-gray-800">
                Добавить новый клиент
            </p>
            @if(session()->has('message'))
                <div class="bg-green-200 rounded text-green-500 mb-4 pl-2">
                    {{ session()->get('message') }}
                </div>
            @endif
            <form action=" {{ route('dashboard.store') }} " method="POST">
                @csrf
                <div class="mb-4">
                    <label for="contact" class="sr-only">Contact</label>
                    <input type="text" name="contact" id="contact" placeholder="Ф.И.О" autocomplete="off" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('contact') border-red-500 @enderror" value="{{ old('contact') }}">
                
                    @error('contact')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>   
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" placeholder="Электронный почта" autocomplete="off" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>   
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="phone" class="sr-only">Номер телефон</label>
                    <input type="text" name="phone" id="phone" placeholder="Телефон" autocomplete="off" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('phone') border-red-500 @enderror" value="{{ old('phone') }}">
                
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
@endsection