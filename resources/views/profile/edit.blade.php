<x-admin-layout>
<x-slot name="header">Profil Saya</x-slot>

<div style="max-width:700px;margin:0 auto;display:flex;flex-direction:column;gap:20px;">

    <!-- Profile Information -->
    <div style="background:white;border-radius:14px;padding:28px;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
        @include('profile.partials.update-profile-information-form')
    </div>

    <!-- Update Password -->
    <div style="background:white;border-radius:14px;padding:28px;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
        @include('profile.partials.update-password-form')
    </div>

    <!-- Delete Account -->
    <div style="background:white;border-radius:14px;padding:28px;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
        @include('profile.partials.delete-user-form')
    </div>

</div>
</x-admin-layout>