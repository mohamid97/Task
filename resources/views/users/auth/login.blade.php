@extends('users.layout.app')
@section('content')
    <div class="container">
        <form class="col-md-4 login-form">
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <span class="text text-danger credentials-error"></span>
            <div class="mb-3">
                <label for="exampleInputUsername" class="form-label">Username</label>
                <input name="username" type="text" class="form-control" id="exampleInputUsername" placeholder="Type Your User Name" required>
                <span class="text text-danger username-error"></span>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="*******" required>
                <span class="text text-danger password-error"></span>

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(".login-form").submit(function(e){
            e.preventDefault();
            let formData = $(".login-form").serialize();
            $.ajax({
                url:'/check-login',
                type:'POST',
                data:formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data){
                     window.location.href = data;
                },
                error:function (e){
                    var err = eval("(" + e.responseText + ")");
                    if(err.errors){
                        $('.username-error').text(err.errors.username);
                        $('.password-error').text(err.errors.password);
                    }
                    if(err.credentials){
                        $('.credentials-error').text(err.credentials);
                    }

                }

            });
        });
    </script>
@endsection

