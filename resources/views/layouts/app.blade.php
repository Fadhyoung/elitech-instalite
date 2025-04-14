<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Instalite') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen grid lg:grid-cols-6 bg-gray-100 dark:bg-gray-900">
        <!-- NAVIGATION -->
        <div class="lg:w-1/6 lg:h-screen lg:fixed lg:col-span-1 border-r bg-white
                w-full h-16 fixed bottom-0 left-0 right-0 z-50 flex justify-around items-center border-t lg:border-t-0 lg:justify-start lg:items-start">
            @include('layouts.navigation')
        </div>

        <!-- HEDER -->
        @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- CONTENT -->
        <main class="w-full lg:col-start-2 xs:col-start-1 col-span-5">
            {{ $slot }}
        </main>

        <!-- MODAL -->
        <div x-data="createPostForm()" x-init="init()" x-ref="postForm" x-cloak>
            <x-modal id="createModal">
                <!-- HEADER -->
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

                <!-- BODY -->
                <x-slot name="body">
                    <div x-show="step === 1" class="lg:w-[500px] lg:h-[500px] xs:w-[250px] xs:h-[250px] p-4 flex flex-col items-center justify-center space-y-4" x-cloak>
                        <div class="w-full flex flex-col items-center space-y-5" x-cloak>
                            <x-iconoir-media-image-plus class="size-16" />
                            <div class="flex flex-col gap-2 justify-center items-center">
                                <p class="rounded-lg w-full text-center">
                                    Upload your image for feed here
                                </p>
                                <label class="w-fit p-2 text-white cursor-pointer rounded-lg bg-blue-500">
                                    Select From Computer
                                    <input type="file" x-ref="fileInput" class="hidden" @change="handleUpload">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div
                        x-show="step === 2 || step === 3"
                        class="flex lg:flex-row xs:flex-col bg-white rounded overflow-hidden transition-all duration-300 ease-in-out"
                        :class="step === 2 ? 'lg:w-[500px] lg:h-[500px] xs:w-[250px] xs:h-[250px]' : 'lg:w-[800px] lg:h-[500px] xs:w-[250px] xs:h-auto'">
                        <div class="">
                            <img :src="image" class="lg:w-[500px] lg:h-[500px] xs:w-[250px] xs:h-[250px] object-cover" />
                        </div>

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

            </x-modal>

            <!-- MODAL NOTIF -->
            <div x-show="notification" x-transition x-text="notification"
                    class="fixed top-4 right-4 bg-black text-white px-4 py-2 rounded shadow"
                    x-cloak></div>
        </div>

    </div>
</body>

</html>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    function createPostForm() {
        return {
            step: 1,
            image: null,
            caption: '',
            showModal: false,
            notification: '',

            init() {
                window.postForm = this;
            },

            showNotification(message) {
                this.notification = message;
                setTimeout(() => this.notification = '', 3000);
            },

            handleUpload(event) {
                this.step = 2;
                const file = event.target.files[0];
                if (!file) return;
                this.imageFile = file;

                const reader = new FileReader();
                reader.onload = e => this.image = e.target.result;
                reader.readAsDataURL(file);
            },

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
                this.imageFile = null;
                this.showModal = false;

                if (this.$refs.fileInput) {
                    this.$refs.fileInput.value = null;
                }
            },

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
                        this.showNotification('success add new feed');
                        if (response.redirected) {
                            window.location.href = response.url;
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