<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="mb-4">
        <label for="profile_image" class="block text-sm font-medium text-gray-700">
            プロフィール画像
        </label>
        <input type="file" name="profile_image" id="profile_image" class="mt-1 block w-full">
        @if (auth()->user()->profile_image)
            <div class="mt-2">
                <img src="{{ asset('/images' . auth()->user()->profile_image) }}" alt="プロフィール画像" class="w-24 h-24 rounded-full">
            </div>
        @endif
        @error('profile_image')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button>
            {{ __('更新') }}
        </x-primary-button>
    </div>
</form>
