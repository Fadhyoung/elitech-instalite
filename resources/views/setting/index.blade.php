<x-app-layout>
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
                        <label for="feeds_per_row" class="block text-sm font-medium text-gray-700">Feeds per Row</label>
                        <select id="feeds_per_row" name="feeds_per_row" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm ">
                            <option value="2" {{ $setting->feeds_per_row == 2 ? 'selected' : '' }}>2 Feeds</option>
                            <option value="3" {{ $setting->feeds_per_row == 3 ? 'selected' : '' }}>3 Feeds</option>
                            <option value="4" {{ $setting->feeds_per_row == 4 ? 'selected' : '' }}>4 Feeds</option>
                            <option value="5" {{ $setting->feeds_per_row == 5 ? 'selected' : '' }}>5 Feeds</option>
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