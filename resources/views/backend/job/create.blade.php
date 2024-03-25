@extends('backend.layouts.app')
@section('title')
    {{ __('Add New Job') }}
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/forms/switches.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/dropify/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/jquery-step/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/forms/theme-checkbox-radio.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form id="job_form" action="{{ route('admin.jobs.store') }}" enctype="multipart/form-data"
                  method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div id="job_form_steps">
                            <h3>{{ __('Select Category') }}</h3>
                            <section>
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <h5 class="mb-2">{{ __('Categories') }}</h5>
                                        @foreach($categories as $category)
                                            <label class="category-filter-btn">
                                                <input type="radio" name="parent_category"
                                                       value="{{$category->id}}"
                                                       {{ old('parent_category') == $category->id  ? 'checked' : '' }} data-required="true"
                                                       data-parent="true">
                                                <span class="text">{{ $category->name ?? '' }}</span>
                                            </label>
                                        @endforeach
                                        @error('parent_category')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <h5 class="mb-2">{{ __('Sub Categories') }}</h5>
                                        <div class="sub-cat-wrap"></div>
                                        @error('category')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="text-danger mt-3 category-error d-none"></p>
                                    </div>
                                </div>

                            </section>
                            <h3>{{ __('Job Information') }}</h3>
                            <section>
                                <div class="form-group">
                                    <label for="title">{{ __('Write an accurate job Title') }}</label>
                                    <input type="text" name="title" id="title"
                                           class="form-control @error('title') is-invalid @enderror"
                                           value="{{ old('title') }}" required>
                                    @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="job-steps pb-3">
                                    <div class="form-group mb-2">
                                        <label>{{__('What specific tasks need to be Completed')}}</label>
                                        <div class="step-box py-2">
                                            <textarea name="steps[]" rows="3"
                                                      class="form-control"></textarea>
                                        </div>
                                    </div>
                                    @error('steps')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <button type="button" class="btn btn-info"
                                            id="add-job-step">{{ __('Add Step') }}</button>
                                </div>
                                <div class="form-group">
                                    <label for="proof_details">{{__('Required proof the job was Completed ')}}</label>
                                    <textarea name="proof_details" id="proof_details" rows="4"
                                              class="form-control @error('proof_details') is-invalid @enderror"
                                              required>{{ old('proof_details') }}</textarea>
                                    @error('proof_details')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="image">{{ __('Thumbnail Image') }}</label>
                                        <input type="file" name="image" id="image">
                                        @error('image')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </section>
                            <h3>{{ __('Budget & Setting') }}</h3>
                            <section>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row py-2 align-items-center">
                                            <div class="col-md-6">
                                                <label for="num_of_worker">{{ __('Worker Need') }}</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" name="num_of_worker" id="num_of_worker"
                                                       class="form-control @error('num_of_worker') is-invalid @enderror"
                                                       value="{{ old('num_of_worker') ?? 1 }}" min="1" required>
                                                @error('num_of_worker')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row py-2 align-items-center">
                                            <div class="col-md-6">
                                                <label for="per_worker_amount">{{ __('Each worker Earn') }}</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" name="per_worker_amount" id="per_worker_amount"
                                                       class="form-control @error('per_worker_amount') is-invalid @enderror"
                                                       value="{{ old('per_worker_amount') ?? 0.001 }}" min="1"
                                                       step="0.001" required>
                                                @error('per_worker_amount')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row py-2 align-items-center">
                                            <div class="col-md-6">
                                                <label for="num_of_screenshot">{{ __('Require Screenshots') }}</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" name="num_of_screenshot" id="num_of_screenshot"
                                                       class="form-control @error('num_of_screenshot') is-invalid @enderror"
                                                       value="{{ old('num_of_screenshot') ?? 1 }}">
                                                @error('num_of_screenshot')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row py-2 align-items-center">
                                            <div class="col-md-6">
                                                <label for="estimated_day">{{ __('Estimated Day') }}</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" name="estimated_day" id="estimated_day"
                                                       class="form-control @error('estimated_day') is-invalid @enderror"
                                                       value="{{ old('estimated_day') ?? 1 }}" min="1" required>
                                                @error('estimated_day')
                                                <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="text-center">{{ __('Estimated Job Cost') }}</h6>
                                                <div class="input-group mb-4">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon5">৳</span>
                                                    </div>
                                                    <input type="text" class="form-control"
                                                           id="calculate_estimated_job_cost"
                                                           placeholder="{{ __('Estimated Job Cost') }}" value=""
                                                           readonly>
                                                </div>
                                                <div class="form-group text-right" id="deposit-url">
                                                    <a href="{{ route('deposits.index') }}"
                                                       class="btn btn-dark btn-sm">{{ __('Deposit') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="status">{{ __('Status') }}</label>
                                            <div>
                                                <label class="switch s-dark mr-2">
                                                    <input type="checkbox" name="status"
                                                           id="status" {{ old('status') ? 'checked' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            @error('status')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-step/jquery.steps.min.js') }}"></script>
    <script>
        $('#job_form_steps').steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            autoFocus: true,
            cssClass: 'circle wizard',
            onStepChanging: (event, currentIndex, newIndex) => {
                if (currentIndex > newIndex) {
                    return true;
                }
                return formValidate(event, currentIndex);
            },
            labels: {
                finish: 'Submit',
            },
            onFinished: (event, index) => {
                console.log(formValidate(event, index));
                if (formValidate(event, index)) {
                    $('#job_form').submit();
                } else {
                    return formValidate(event, index);
                }
            }
        });

        function formValidate(event, currentIndex) {
            let formId = event.target.getAttribute('id');
            let currentInputs = $('#' + formId + '-p-' + currentIndex).find('input,select,textarea');
            let negativeNum = 0;
            $.each(currentInputs, (index, element) => {
                if (element.hasAttribute('required')) {
                    if (element.value === '') {
                        element.classList.add('is-invalid');
                        negativeNum++;
                    } else {
                        element.classList.remove('is-invalid');
                    }
                } else if (element.type === 'radio' && element.getAttribute('data-required') === 'true') {
                    let categoryErrorBox = $('.category-error');
                    if (document.querySelectorAll('input[type="radio"][name="' + element.name + '"]:checked').length <= 0) {
                        negativeNum++;
                        console.log(categoryErrorBox)
                        let categoryErrorMessage = 'Category Field Is Required.';
                        if (element.hasAttribute('data-child')) {
                            categoryErrorMessage = 'Sub Category Field Is Required.'
                        }
                        categoryErrorBox.html(categoryErrorMessage);
                        if (categoryErrorBox.hasClass('d-none')) {
                            categoryErrorBox.removeClass('d-none')
                            categoryErrorBox.addClass('d-block')
                        }
                    } else if (categoryErrorBox.hasClass('d-block')) {
                        categoryErrorBox.removeClass('d-block')
                        categoryErrorBox.addClass('d-none')
                    }
                }
                if (element.hasAttribute('min')) {
                    if (element.value < element.getAttribute('min')) {
                        element.classList.add('is-invalid');
                        negativeNum++;
                    } else {
                        element.classList.remove('is-invalid');
                    }
                }
            });
            return negativeNum <= 0;

        }

        $('input[type="radio"][name="parent_category"]').on('change', function () {
            let catId = $(this).val();
            getCategoryByAjax(catId, function (data) {
                let options = '';
                let minAmount = Number.parseFloat(data.data.min_cost_per_work);
                $.each(data.data.children, function (index, category) {
                    options += `<label class="category-filter-btn">
                                            <input type="radio" name="category"
                                                   value="${category.id}" data-required="true" data-child="true">
                                            <span class="text">${category.name}</span>
                                        </label>`;
                })
                if (data.data.children.length > 0) {
                    minAmount = data.data.children[0].min_cost_per_work;
                }
                $('.sub-cat-wrap').html(options);
                let per_worker_amount = $('#per_worker_amount');
                per_worker_amount.val(minAmount);
                per_worker_amount.attr('min', minAmount);
            });
        });
        $(document).on('change', 'input[type="radio"][name="category"]', function () {
            let catId = $(this).val();
            getCategoryByAjax(catId, function (data) {
                let minAmount = Number.parseFloat(data.data.min_cost_per_work);
                let per_worker_amount = $('#per_worker_amount');
                per_worker_amount.val(minAmount);
                per_worker_amount.attr('min', minAmount);
            });
        });

        function getCategoryByAjax(catId, callback) {
            $.ajax({
                url: '{{ route('ajax.category') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    "id": catId, "_token": "{{ csrf_token() }}"
                },
                success: function (data) {
                    callback(data);
                }
            });
        }

        $('#category').select2({
            placeholder: "Select Category",
        });
        $('#image').dropify();

        $('#add-job-step').on('click', function (e) {
            e.preventDefault();
            let stepBox = `<div class="step-box py-2">
                                             <button type="button" class="badge badge-danger border-0 job-step-del float-right mb-1">Delete</button>
                                            <textarea name="steps[]" rows="3"
                                                      class="form-control"></textarea>

                                        </div>`;
            let job_steps_wrap = $('.job-steps').children('.form-group');
            job_steps_wrap.append(stepBox);
        });
        $(document).on('click', '.job-step-del', function (e) {
            e.preventDefault();
            $(this).parent('.step-box').remove();
        });

        $('#num_of_worker').on('keypress blur', function (e) {
            calculateEstimatedJobCost();
        });

        $('#per_worker_amount').on('keypress blur', function (e) {
            calculateEstimatedJobCost();
        });
        $('#num_of_screenshot').on('keypress blur', function (e) {
            calculateEstimatedJobCost();
        });

        function calculateEstimatedJobCost() {
            let depositUrlBox = $('#deposit-url');
            depositUrlBox.hide();
            const userBalance = "{{ auth()->user()->balance ?? 0 }}";
            let screenshot_amount = Number.parseFloat({{ !empty(get_setting('screenshot_amount')) ? get_setting('screenshot_amount') : 1 }});
            let num_of_screenshot = Number.parseFloat($('#num_of_screenshot').val());
            let num_of_worker = Number.parseFloat($('#num_of_worker').val());
            let per_worker_amount = Number.parseFloat($('#per_worker_amount').val());
            let totalJobCost = 0.00;
            let totalScreenshotAmount = 0.00;
            if (!isNaN(screenshot_amount) && !isNaN(num_of_screenshot)) {
                totalScreenshotAmount = screenshot_amount * num_of_screenshot;
            }
            if (!isNaN(num_of_worker) && !isNaN(per_worker_amount)) {
                totalJobCost = (num_of_worker * per_worker_amount) + totalScreenshotAmount;
            }
            let calculate_estimated_job_cost = $('#calculate_estimated_job_cost');
            calculate_estimated_job_cost.val(totalJobCost.toFixed(3));
        }

        calculateEstimatedJobCost();
    </script>
@endpush
