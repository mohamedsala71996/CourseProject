@extends('layouts.app')

@section('title', 'إضافة سؤال')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">إضافة سؤال جديد</div>
        <div class="card-body">
            <form action="{{ route('lectures.questions.store', $lecture->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">نص السؤال</label>
                    <textarea name="question_text" class="form-control" rows="3" required>{{ old('question_text') }}</textarea>
                    @error('question_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">مقطع القراءة</label>
                    <textarea name="read_text" class="form-control" rows="3">{{ old('read_text') }}</textarea>
                    @error('read_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">الفيديو</label>
                    <input type="file" name="video" class="form-control" accept="video/*">
                    @error('video')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">المقطع الصوتي</label>
                    <input type="file" name="record" class="form-control" accept="audio/*">
                    @error('record')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3" id="options-container">
                    <label class="form-label">الخيارات</label>
                    <div class="option-group mb-2" data-index="0">
                        <div class="input-group">
                            <input type="text" name="options[0][text]" class="form-control" placeholder="الخيار 1" value="{{ old('options.0.text') }}" required>
                            <div class="input-group-text">
                                <input type="radio" name="correct_option" value="0" {{ old('correct_option') == '0' ? 'checked' : '' }} required>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remove-option">X</button>
                        </div>
                        @error('options.0.text')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="option-group mb-2" data-index="1">
                        <div class="input-group">
                            <input type="text" name="options[1][text]" class="form-control" placeholder="الخيار 2" value="{{ old('options.1.text') }}" required>
                            <div class="input-group-text">
                                <input type="radio" name="correct_option" value="1" {{ old('correct_option') == '1' ? 'checked' : '' }} required>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remove-option">X</button>
                        </div>
                        @error('options.1.text')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <button type="button" class="btn btn-secondary mb-3" id="add-option">إضافة خيار آخر</button>
                <br>
                <button type="submit" class="btn btn-success">إضافة السؤال</button>
                <a href="{{ route('lectures.questions.index', $lecture->id) }}" class="btn btn-secondary">إلغاء</a>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Initialize CKEditor for read_text
        CKEDITOR.replace('read_text', {
            height: 200, // Optional: Set height
            versionCheck: false
        });

        const optionsContainer = document.getElementById('options-container');
        const addOptionBtn = document.getElementById('add-option');
        let optionIndex = 2;

        // Function to add a new option
        function addOption() {
            const newOption = `
                <div class="option-group mb-2" data-index="${optionIndex}">
                    <div class="input-group">
                        <input type="text" name="options[${optionIndex}][text]" class="form-control" placeholder="الخيار ${optionIndex + 1}" required>
                        <div class="input-group-text">
                            <input type="radio" name="correct_option" value="${optionIndex}" required>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm remove-option">X</button>
                    </div>
                </div>
            `;
            optionsContainer.insertAdjacentHTML('beforeend', newOption);
            optionIndex++;

            // Re-attach event listeners to all remove buttons
            attachRemoveListeners();
        }

        // Function to remove an option
        function removeOption(event) {
            const optionGroups = optionsContainer.querySelectorAll('.option-group');
            if (optionGroups.length > 2) { // Ensure at least 2 options remain
                const optionGroup = event.target.closest('.option-group');
                if (optionGroup) {
                    optionGroup.remove();
                }
            } else {
                alert('يجب أن يحتوي السؤال على خيارين على الأقل.');
            }
        }

        // Attach event listeners to remove buttons
        function attachRemoveListeners() {
            const removeButtons = document.querySelectorAll('.remove-option');
            removeButtons.forEach(button => {
                button.removeEventListener('click', removeOption); // Prevent duplicate listeners
                button.addEventListener('click', removeOption);
            });
        }

        // Add option event listener
        addOptionBtn.addEventListener('click', addOption);

        // Initial setup for remove buttons on the first two options
        attachRemoveListeners();
    });
</script>
@endsection