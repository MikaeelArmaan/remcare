<div class="mb-4">
    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
    <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
     value="{{ isset($doctor)?$doctor->name:old('name') }}" required>
    @error('name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="specialization" class="block text-sm font-medium text-gray-700">Specialization</label>
    <input type="text" name="specialization" id="specialization" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('specialization') border-red-500 @enderror"
    value="{{ isset($doctor)?$doctor->specialization:old('specialization') }}">
    @error('specialization')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="experience" class="block text-sm font-medium text-gray-700">Experience</label>
    <input type="number" name="experience" id="experience" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('experience') border-red-500 @enderror"
     value="{{ isset($doctor)?$doctor->experience:old('experience') }}">
    @error('experience')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
