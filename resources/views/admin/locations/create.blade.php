@extends('admin.layouts.master')
@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Thêm cơ sở
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <form method="post" action="{{ route('admin.locations.store') }}">
                                    @csrf
                                    <div class="form-group m-form__group m--margin-top-10">
                                        <div class="alert alert-danger m-alert m-alert--default" role="alert">
                                            Những field có dấu * bắt buộc phải điền
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Tên <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="name"
                                               value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                            <b class="text-danger">{{ $errors->first('name') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Email <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="email"
                                               value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <b class="text-danger">{{ $errors->first('email') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Tỉnh thành <b class="text-danger">*</b></label>
                                        <select class="form-control m-input" name="province_id" id="province_id">
                                            @foreach ($provinces as $province)
                                                <option></option>
                                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('province_id'))
                                            <b class="text-danger">{{ $errors->first('province_id') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Điện thoại <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="phone"
                                               value="{{ old('phone') }}">
                                        @if ($errors->has('phone'))
                                            <b class="text-danger">{{ $errors->first('phone') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <label>Địa chỉ <b class="text-danger">*</b></label>
                                        <input type="text" class="form-control m-input" name="address"
                                               value="{{ old('address') }}">
                                        @if ($errors->has('address'))
                                            <b class="text-danger">{{ $errors->first('address') }}</b>
                                        @endif
                                    </div>
                                    <div class="form-group m-form__group">
                                        <button class="btn btn-primary">Thêm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#province_id").select2({placeholder: "Chọn tỉnh thành"});
        });
    </script>
@endsection
