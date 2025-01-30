<div class="mt-12">
    <h2 class="text-2xl font-bold mb-4">{{ $translations['our_staff'] }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($staff as $member)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $member->getName() }}</h3>
                <p class="text-gray-600 mb-4">{{ $member->getRole() }}</p>
                <a href="{{ route('site.staff.show', ['domain' => $site->domain, 'slug' => $member->slug]) }}" 
                   class="text-blue-600 hover:text-blue-800">
                    {{ $translations['view_profile'] }} →
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
