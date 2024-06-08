<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRiskCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // Get the ID of the category being updated (if any)
        $categoryId = $this->route('riskcategory') ? $this->route('riskcategory')->id : null;
        return [
            'category' => 'required|string|max:255|unique:risk_categories,category,' . $categoryId,
            'description' => 'string',
        ];
    }

    /**
     * Get custom error messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'category.required' => 'The category field is required.',
            'category.string' => 'The category must be a string.',
            'category.max' => 'The category may not be greater than :max characters.',
            'category.unique' => 'The category has already been taken.',
            'description.string' => 'The description must be a string.',
        ];
    }
}
