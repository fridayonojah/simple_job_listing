@props(['job'])

<x-card>
    <div class="flex">
        <img src="{{$job->logo ? asset('/storage/' . $job->logo) :  asset('/images/facebook.png')}}" alt="" 
        class="hidden w-48 mr-6 md:block">
        <div>
            <h3 class="text-2xl">
                <a href="/job/details/{{$job->id}}">{{ $job->title }}</a>
            </h3>
            <x-jobtag  :tagsCsv="$job->tags" />
            <div class="text-xl font-bold mb-4">{{ $job->company }}</div>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot">
                    {{$job->location}}
                </i>
            </div>
        </div>
    </div>
</x-card>