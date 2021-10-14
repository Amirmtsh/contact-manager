<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Contact') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            
                <form method="POST" action="/contacts" enctype="multipart/form-data">
    
                    <div class="form-group">
                        <div>
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>
            
                        <div class="mt-4">
                            <x-jet-label for="number" value="{{ __('Number') }}" />
                            <x-jet-input id="number" class="block mt-1 w-full" type="text" name="number" :value="old('number')" required />
                        </div>
                        <div class="row">
                            <label for="image" class="col-md-4 col-form-label">Profile Image</label>
        
                            <input type="file" class="form-control-file" id="image" name="image">
        
                            @if ($errors->has('image'))
                                <strong>{{ $errors->first('image') }}</strong>
                            @endif
                        </div>
                        <div class="flex items-center justify-center mt-4">
                            <x-jet-button class="ml-4">
                                {{ __('Register') }}
                            </x-jet-button>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
    

                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
    </x-app-layout>