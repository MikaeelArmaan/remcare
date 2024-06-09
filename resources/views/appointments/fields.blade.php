<div class="mb-4">
    <label for="doctor_id" class="block text-sm font-medium text-gray-700">Doctor</label>
    <select name="doctor_id" id="doctor_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('doctor_id') border-red-500 @enderror" >
        <option value="">Select a doctor</option>
        @foreach($doctors as $doctor)
            <option value="{{ $doctor->id }}" {{ (isset($appointment) && $appointment->doctor_id == $doctor->id) ? 'selected' : (old('doctor_id') == $doctor->id ? 'selected' : '') }}>
                {{ $doctor->name }}
            </option>
        @endforeach
    </select>
    @error('doctor_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="patient_id" class="block text-sm font-medium text-gray-700">Patient</label>
    <select name="patient_id" id="patient_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('patient_id') border-red-500 @enderror" >
        <option value="">Select a patient</option>
        @foreach($patients as $patient)
            <option value="{{ $patient->id }}" {{ (isset($appointment) && $appointment->patient_id == $patient->id) ? 'selected' : (old('patient_id') == $patient->id ? 'selected' : '') }}>
                {{ $patient->name }}
            </option>
        @endforeach
    </select>
    @error('patient_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>


<div class="mb-4">
    <label for="risk_category_id" class="block text-sm font-medium text-gray-700">Risk Category</label>
    <select name="risk_category_id" id="risk_category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('risk_category_id') border-red-500 @enderror" >
        <option value="">Select a risk category</option>
        @foreach($riskCategories as $riskCategory)
            <option value="{{ $riskCategory->id }}" {{ (isset($appointment) && $appointment->risk_category_id == $riskCategory->id) ? 'selected' : (old('risk_category_id') == $riskCategory->id ? 'selected' : '') }}>
                {{ $riskCategory->category .' - '.$riskCategory->description }}
            </option>
        @endforeach
    </select>
    @error('risk_category_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
<div class="mb-4">
    <label for="appointment_time" class="block text-sm font-medium text-gray-700">Appointment Date and Time</label>
    <input type="datetime-local" name="appointment_time" id="appointment_time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('appointment_time') border-red-500 @enderror"
     value="{{ isset($appointment) ? $appointment->appointment_time : old('appointment_time') }}" >
    @error('appointment_time')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
    <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('notes') border-red-500 @enderror" >{{ isset($appointment) ? $appointment->notes : old('notes') }}</textarea>
    @error('notes')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

