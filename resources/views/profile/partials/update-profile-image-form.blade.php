<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="mb-4">
        <label for="profile_image" class="block text-sm font-medium text-gray-700">
            プロフィール画像
        </label>

        <!-- カスタムファイル選択ボタン -->
        <label class="cursor-pointer inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
            ファイルを選択
            <input type="file" name="profile_image" id="profile_image" class="hidden" onchange="previewImage(event)">
        </label>

        <!-- プロフィール画像プレビュー -->
        <div class="mt-2">
            <img id="preview" 
                src="{{ auth()->user()->profile_image ? asset('images/' . auth()->user()->profile_image) : asset('default_profile_image.png') }}" 
                alt="プロフィール画像" 
                class="cursor-pointer w-24 h-24 rounded-full object-cover"
                onclick="document.getElementById('profile_image').click();" />
        </div>

        @error('profile_image')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-start mt-4">
        <x-primary-button>
            {{ __('更新') }}
        </x-primary-button>
    </div>
</form>

<!-- 画像プレビューを表示するためのJavaScript -->
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('preview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
