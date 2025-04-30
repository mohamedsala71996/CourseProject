@extends('layouts.app')

@section('title', 'تعديل سؤال')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">تعديل السؤال</div>
        <div class="card-body">
            <form action="{{ route('lectures.questions.update', [$lecture->id, $question->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">نص السؤال</label>
                    <textarea name="question_text" class="form-control" rows="3" required>{{ old('question_text', $question->question_text) }}</textarea>
                    @error('question_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">مقطع القراءة</label>
                    <textarea name="read_text" class="form-control" rows="3">{{ old('read_text', $question->read_text) }}</textarea>
                    @error('read_text')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">الفيديو</label>
                    <input type="file" name="video" class="form-control mt-2" accept="video/*">
                    @if ($question->video)
                        <video controls width="200">
                            <source src="{{ asset("storage/".$question->video) }}" type="video/mp4">
                            المتصفح لا يدعم تشغيل الفيديو.
                        </video>
                    @else
                        <span class="text-muted">غير متوفر</span>
                    @endif
                    @error('video')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">المقطع الصوتي</label>
                    <input type="file" name="record" class="form-control mt-2" accept="audio/*">
                    @if ($question->record)
                    <audio controls>
                        <source src="{{ asset("storage/".$question->record) }}" type="audio/mpeg">
                        المتصفح لا يدعم تشغيل الصوت.
                    </audio>
                @else
                    <span class="text-muted">غير متوفر</span>
                @endif
                    @error('record')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3" id="options-container">
                    <label class="form-label">الخيارات</label>
                    @foreach ($question->options as $index => $option)
                        <div class="option-group mb-2" data-index="{{ $index }}">
                            <div class="input-group">
                                <input type="text" name="options[{{ $index }}][text]" class="form-control" placeholder="الخيار {{ $index + 1 }}" value="{{ old('options.' . $index . '.text', $option->option_text) }}" required>
                                <div class="input-group-text">
                                    <input type="radio" name="correct_option" value="{{ $index }}" {{ old('correct_option', $question->options->firstWhere('is_correct', true)->id ?? '') == $option->id ? 'checked' : '' }} required>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm remove-option">X</button>
                            </div>
                            @error('options.' . $index . '.text')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-secondary mb-3" id="add-option">إضافة خيار آخر</button>
                <br>
                <button type="submit" class="btn btn-success">حفظ التعديلات</button>
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
        let optionIndex = {{ $question->options->count() }};

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

        // Initial setup for remove buttons
        attachRemoveListeners();
    });
</script>
@endsection