<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen grid grid-cols-6 bg-gray-100 dark:bg-gray-900">
        <div class="w-1/6 h-screen fixed col-span-1 overflow-hidden border-r bg-white">
            @include('layouts.navigation')
        </div>

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset
        Cancel
        <!-- Page Content -->
        <main class="w-full col-start-2 col-span-5">
            {{ $slot }}
        </main>

        <!-- Fullscreen Modal -->
        <div x-data="createPostForm()">
            <x-modal id="createModal" x-show="showModal" x-transition>
                <div class="w-[500px] h-[500px]">
                    {{-- Header --}}
                    <x-slot name="header">
                        <div class="w-full flex justify-between items-center">
                            <template x-if="step === 1">
                                <h2 class="w-full py-2 text-xl text-center font-semibold border-b" x-text="'Create new post'"></h2>
                            </template>

                            <template x-if="step === 2 && image">
                                <div class="w-full p-2 flex justify-between">
                                    <button
                                        class="font-semibold"
                                        :class="'text-black cursor-pointer'"
                                        :disabled="!image"
                                        @click="back()">
                                        <-
                                            </button>
                                            <button
                                                class="font-semibold"
                                                :class="image ? 'text-blue-500' : 'text-blue-500 opacity-50 cursor-not-allowed'"
                                                :disabled="!image"
                                                @click="step = 3">
                                                Next
                                            </button>
                                </div>
                            </template>
                            <template x-if="step === 3">
                                <div class="w-full p-2 flex justify-between border-b">
                                    <button
                                        class="font-semibold"
                                        :class="'text-black cursor-pointer'"
                                        :disabled="!image"
                                        @click="back()">
                                        <-
                                            </button>
                                            <button class="text-blue-600 font-semibold self-end " @click="submit">Share</button>
                                </div>
                            </template>
                        </div>
                    </x-slot>

                    {{-- Body --}}
                    <x-slot name="body">
                        <!-- Step 1: Upload -->
                        <div x-show="step === 1" class="w-[500px] h-[500px] p-4 flex flex-col items-center justify-center space-y-4" x-cloak>
                            <div class="w-full flex flex-col items-center space-y-5" x-cloak>
                                <x-iconoir-media-image-plus class="size-16" />
                                <div class="flex flex-col gap-2 justify-center items-center">
                                    <p class="rounded-lg w-full text-center">
                                        Upload your image for feed here
                                    </p>
                                    <label class="w-fit p-2 text-white cursor-pointer rounded-lg bg-blue-500">
                                        Select From Computer
                                        <input type="file" class="hidden" @change="handleUpload">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Content Wrapper -->
                        <div
                            x-show="step === 2 || step === 3"
                            class="flex bg-white rounded overflow-hidden transition-all duration-300 ease-in-out"
                            :class="step === 2 ? 'w-[500px] h-[500px]' : 'w-[800px] h-[500px]'">
                            <!-- Image Section -->
                            <div class="">
                                <img :src="image" class="w-[500px] h-[500px] object-cover" />
                            </div>

                            <!-- Caption Section (Step 3 only) -->
                            <div
                                x-show="step === 3"
                                class="flex-1"
                                x-transition>
                                <textarea
                                    x-model="caption"
                                    class="w-full h-full resize-none border"
                                    placeholder="Write a caption...">
                                </textarea>
                            </div>
                        </div>


                    </x-slot>
                </div>
            </x-modal>
        </div>

    </div>
</body>

</html>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    function toggleModal(id, show = true) {
        document.getElementById(id).classList.toggle('hidden', !show);
    }
</script>

<script>
    function createPostForm() {
        return {
            step: 1, // This controls which step of the modal we're on (1: Upload, 2: Caption)
            image: null, // This will store the uploaded image
            caption: '', // This will store the caption input
            showModal: false, // This will control the visibility of the modal

            // Function to handle the image file upload
            handleUpload(event) {
                this.step = 2;
                const file = event.target.files[0];
                if (!file) return;
                this.imageFile = file; // Save the actual file for upload

                const reader = new FileReader();
                reader.onload = e => this.image = e.target.result;
                reader.readAsDataURL(file); // Still use preview
            },

            // Modified toggleModal to also reset when closing
            toggleModal(show) {
                this.showModal = show;
                if (!show) {
                    this.reset();
                }
            },

            back() {
                this.step = this.step - 1;
            },

            reset() {
                this.step = 1;
                this.image = null;
                this.caption = '';
            },

            // Function to submit the post (could be AJAX or form submission)
            submit() {
                const formData = new FormData();
                formData.append('media_path', this.imageFile);
                formData.append('caption', this.caption);

                fetch('/feeds/store', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: formData,
                    })
                    .then(response => {
                        if (response.redirected) {
                            window.location.href = response.url; // Manually follow the redirect
                            return;
                        }

                        return response.text();
                    })
                    .catch(error => {
                        console.error('Upload failed:', error);
                        alert('Upload failed!');
                        toggleModal('createModal', false);
                    });
            }


        }
    }
</script>