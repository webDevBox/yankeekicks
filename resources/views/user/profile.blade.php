@extends('layouts.user')
@section('styles')
 <!-- dropify CSS -->
 <link href="{{ asset('theme/assets/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="header-title mb-4 col-12">
                        <div><h4 class="text-orange">Edit Profile</h4></div>
                    </div>
                    <div class="col-12">
                     <form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="name" class="col-form-label">Name</label>
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                                        @if ($errors->has('name'))<p style="color:red;">{{ $errors->first('name') }}</p>@endif
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="name" class="col-form-label">Address</label>
                                        <textarea name="address" class="form-control" required>{{ $user->address }}</textarea>
                                        @if ($errors->has('address'))<p style="color:red;">{{ $errors->first('address') }}</p>@endif
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="name" class="col-form-label">City</label>
                                        <input type="text" name="city" value="{{ $user->city }}" class="form-control" required>
                                        @if ($errors->has('city'))<p style="color:red;">{{ $errors->first('city') }}</p>@endif
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="name" class="col-form-label">Old Password</label>
                                        <input type="password" name="oldPassword" placeholder="Enter Old Password" class="form-control">
                                        @if ($errors->has('oldPassword'))<p style="color:red;">{{ $errors->first('oldPassword') }}</p>@endif
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="name" class="col-form-label">New Password</label>
                                        <input type="password" name="password" placeholder="Enter New Password" class="form-control">
                                        @if ($errors->has('password'))<p style="color:red;">{{ $errors->first('password') }}</p>@endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="logo" class="col-form-label">Profile Image</label>
                                <input type="file" name="image" data-show-remove="false" id="input-file-now" class="dropify" data-height="300" @if($user->image != null) data-default-file="{{ asset(userImage()) }}"
                                @else data-default-file="{{ asset('files/images/user/dummy.png') }}" @endif>
                                @if ($errors->has('image'))<p style="color:red;">{{ $errors->first('image') }}</p>@endif
                            </div>
                            
                        </div>
                       
                        
                        <input type="submit" name="submit" value="Update Profile" class="btn btn-primary btn-rounded">
                    </form>
                    </div>

                
                </div>
            </div>
        </div> <!-- end row -->

    </div> <!-- container -->

</div> <!-- content -->

@endsection

@section('script')

{{-- <script>
    $('.dropify').on('dropify.afterClear', function(){
        $('#image').val('del'); 
    });
</script> --}}

<script src="{{ asset('theme/assets/js/dropify.min.js')}}"></script>
<script>
    // dropify JS
    $(document).ready(function(){
        // Basic
        $('.dropify').dropify();
        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove:  'Supprimer',
                error:   'Désolé, le fichier trop volumineux'
            }
        });
        // Used events
        var drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function(event, element){
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element){
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element){
            console.log('Has Errors');
        });
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e){
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
</script>

@endsection