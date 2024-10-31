<div class="profile-summary text-center">
    <!-- Profile Picture -->
    @if(auth()->user()->profile_photo)
    <img src="{{ asset('storage/profile_photos/' . auth()->user()->profile_photo) }}" alt="Profile Photo" class="profile-photo rounded-circle" width="200" height="200">
    @else
    <img src="{{ asset('../assets/images/unknown.jpg') }}" alt="Default Profile Photo" class="profile-photo rounded-circle" width="200" height="200">
@endif

    <!-- User Name -->
    <h4 class="mt-3">{{ Auth::user()->name }}</h4>

    <!-- User Email -->
    <p class="text-muted">{{ Auth::user()->email }}</p>

    <!-- Additional Info (e.g., Role, Join Date) -->
    <div class="mt-3">
        <p><strong>Role:</strong> {{ Auth::user()->usertype }}</p>
        <p><strong>Joined:</strong> {{ Auth::user()->created_at->format('F j, Y') }}</p>
    </div>

</div>


