<div class="profile-summary text-center">
    <!-- Profile Picture -->
    <div class="mb-3">
        <img src="{{ Auth::user()->profile_picture_url ?? asset('images/default-profile.png') }}" alt="Profile Picture" class="rounded-circle" width="100" height="100">
    </div>

    <!-- User Name -->
    <h4>{{ Auth::user()->name }}</h4>

    <!-- User Email -->
    <p class="text-muted">{{ Auth::user()->email }}</p>

    <!-- Additional Info (e.g., Role, Join Date) -->
    <div class="mt-3">
        <p><strong>Role:</strong> {{ Auth::user()->usertype }}</p>
        <p><strong>Joined:</strong> {{ Auth::user()->created_at->format('F j, Y') }}</p>
    </div>

</div>
