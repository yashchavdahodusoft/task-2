<div class="flex">
    <div class="w-full p-2">
        <x-input-label for="first_name" :value="__('First Name')" />
        <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="$employee->first_name ?? old('first_name')"
            autofocus />
        <span class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1" id="error_first_name"></span>
        {{-- :messages="$errors->get('first_name')" --}}
    </div>

    <div class="w-full p-2">
        <x-input-label for="last_name" :value="__('Last Name')" />
        <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="$employee->last_name ?? old('last_name')"
            autofocus autocomplete="last_name" />
        <span class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1" id="error_last_name"></span>
    </div>
</div>

<div class="flex">
    <div class="w-full p-2">
        <x-input-label for="company" :value="__('Company')" />
        <select name="companies_id"
            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            id="">
            <option>---Choose company---</option>
            @foreach ($companies as $company)
                @if (isset($employee->companies_id) && $employee->companies_id === $company->id)
                    <option selected value="{{ $company->id }}">{{ $company->name }}</option>
                @else
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endif
            @endforeach
        </select>
        <span class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1" id="error_companies_id"></span>
    </div>
    <div class="w-full p-2">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="$employee->email ?? old('email')" />
        <span class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1" id="error_email"></span>
    </div>
    <div class="w-full p-2">
        <x-input-label for="phone_no" :value="__('Phone No.')" />
        <x-text-input id="phone_no" name="phone_no" maxlength="10" type="tel"
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
            class="mt-1 block w-full" :value="$employee->phone_no ?? old('phone_no')" />
        <span class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1" id="error_phone_no"></span>
    </div>
    <div class="w-full p-2">
        <x-input-label class="mb-4" for="status" :value="__('Status')" />
        <div>
            <input type="radio" @if (isset($employee->status) && $employee->status === 'Active') checked @endif name="status" value="Active"
                id="" />&nbsp;Active&nbsp;
            <input type="radio" @if (isset($employee->status) && $employee->status === 'Inactive') checked @endif name="status" value="Inactive"
                id="" />&nbsp;Inactive&nbsp;
        </div>
        <span class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1" id="error_status"></span>
    </div>
</div>
<div>
    <div class="w-full p-2">
        <x-input-label for="profile_image" :value="__('Profile Image')" />
        <x-text-input id="profile_image" name="profile_image" type="file" accept="image/png, image/gif, image/jpeg"
            class="mt-1 p-4 block w-full border border-slate-500" />
        <span class="mt-2 text-sm text-red-600 dark:text-red-400 space-y-1" id="error_profile_image"></span>
        <div id="img">
            @if (!empty($employee->profile_image))
                <img src="{{ asset('storage/' . $employee->profile_image) }}" class="mt-2 w-16 md:w-32 lg:w-48"
                    alt="">
            @endif
        </div>
    </div>
</div>
