 @if($errors->any())
        <div class="container">
            <div class="raw">
                <div class="col-md-10">
                    <div class="alert alert-danger"></div>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
