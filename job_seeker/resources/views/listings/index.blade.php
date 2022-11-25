
<x-layout>
 @include('partials._hero')  {{-- import hero to the page --}}
 @include('partials._search') {{-- import search to the page --}}

 <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

 @unless (count($listings)==0)


 @foreach($listings as $listing)
    <x-listing-card :listing="$listing"/>

 @endforeach
 @else
 <p> no Listings found</p>

@endunless
 </div>

<div class="mt-6 p-4">
 {{$listings->links() }}
 </div>

</x-layout>


