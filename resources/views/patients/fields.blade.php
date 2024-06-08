<div class="mb-4">
    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
     value="{{ isset($patient)?$patient->name:old('name') }}" required>
    @error('name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
<div class="mb-4">
    <label for="last_name" class="block text-sm font-medium text-gray-700">last name</label>
    <input type="text" name="last_name" id="last_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
     value="{{ isset($patient)?$patient->last_name:old('last_name') }}" required>
    @error('last_name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
<div class="mb-4">
    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
    <input type="text" name="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
     value="{{ isset($patient)?$patient->email:old('email') }}" required>
    @error('email')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
    <input type="text" name="phone" id="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
     value="{{ isset($patient)?$patient->phone:old('phone') }}" required>
    @error('phone')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
<div class="mb-4">
    <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
    <input type="date" name="dob" id="dob" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
     value="{{ isset($patient)?$patient->dob:old('dob') }}" required>
    @error('dob')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

