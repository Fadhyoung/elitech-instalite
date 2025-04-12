<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('setting.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('setting.partials.update-password-form')
                </div>
            </div>            

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form action="{{ route('setting.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label for="columns_preference" class="block text-sm font-medium text-gray-700">Number of Columns</label>
                        <select id="columns_preference" name="columns_preference" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm ">
                            <option value="2" {{ auth()->user()->columns_preference == 2 ? 'selected' : '' }}>2 Columns</option>
                            <option value="3" {{ auth()->user()->columns_preference == 3 ? 'selected' : '' }}>3 Columns</option>
                            <option value="4" {{ auth()->user()->columns_preference == 4 ? 'selected' : '' }}>4 Columns</option>
                            <option value="5" {{ auth()->user()->columns_preference == 5 ? 'selected' : '' }}>5 Columns</option>
                            <!-- Add more options as necessary -->
                        </select>
                    </div>

                    <x-primary-button>{{ __('Save Settings') }}</x-primary-button>
                </form>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('setting.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>