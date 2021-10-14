<x-app-layout>
    <div  class="py-12">

        <div style="text-align:center; background-image : grey" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div  class="mb-4">
                <a style="color: blue;" href="/contacts/create">Add New Contact</a>
            </div>
            @foreach ($user->contacts as $contact )
            <div  class="mb-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a href="{{ $contact->image }}"><img style="max-height:200px; max-width:200px;margin : auto;" src="{{ $contact->image }}" class=" w-100"></a>

                <div class="d-flex justify-content-end"> 
                    Name :  <span style="font-size:larger; font-weight:bold;">{{ $contact->name }}</span>  
                </div>
                <div class="d-flex justify-content-between"> 
                   Phone Number :  <span style="font-size:larger;font-weight:bold;" >{{ $contact->number }}</span> 
                </div>
               <form style="display:inline" action="/contacts/{{ $contact->id }}" method="post">
                    @method('delete')
                    @csrf
                    <x-jet-button  style="color: red; margin:10px ;width:100px;display:inline;" >delete</x-jet-button>
                </form> 
                <x-jet-button style="color:green;margin:10px;width:100px; display:inline;" onclick="window.location.href = '/contacts/{{ $contact->id }}/edit'" >edit</x-jet-button>

                

            </div>
            @endforeach

        </div>
    </div>
</x-app-layout>