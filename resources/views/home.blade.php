@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header "><center>{{ __('Welcome to this beautiful admin panel.') }}</center></div>

                <div class="card-body">
                    @if ($user->roles_id==1)
                    Your loged as admin

                    @else ($user->roles_id ==2)
                    Your loged as user
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="ecommerce-gallery" data-mdb-zoom-effect="true" data-mdb-auto-height="true">
                <div class="row py-3 shadow-5">
                    <div class="col-12 mt-1">
                    <div class="lightbox">
                        <img
                        src="https://cc-prod.scene7.com/is/image/CCProdAuthor/product-photography_P3B_720x350?$pjpeg$&jpegSize=200&wid=720"
                        alt="Gallery image 1"
                        class="ecommerce-gallery-main-img active w-100"
                        />
                    </div>
                    </div>
                    <div class="col-3 mt-1">
                    <img
                        src="https://i.pinimg.com/originals/99/24/58/9924587556a951a18b5ee12d296d323b.jpg"
                        alt="Gallery image 2"
                        class="w-100"
                    />
                    </div>
                    <div class="col-3 mt-1">
                    <img
                        src="https://i.pinimg.com/originals/99/24/58/9924587556a951a18b5ee12d296d323b.jpg"
                        alt="Gallery image 3"
                        class="w-100"
                    />
                    </div>
                    <div class="col-3 mt-1">
                    <img
                        src="https://i.pinimg.com/originals/99/24/58/9924587556a951a18b5ee12d296d323b.jpg"
                        alt="Gallery image 4"
                        class="w-100"
                    />
                    </div>
                    <div class="col-3 mt-1">
                    <img
                        src="https://i.pinimg.com/originals/99/24/58/9924587556a951a18b5ee12d296d323b.jpg"
                        alt="Gallery image 5"
                        class="w-100"
                    />
                    </div>
                </div>
                </div>
                </div>
                </div>
                    </div>
                    <div class="py-5 text-right"><a href="#" class="btn btn-primary px-5 py-3 text-uppercase">Show me more</a></div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop

@section('footer')
    <strong>CopyRight &copy; {{date('Y')}}
    <a href="#" target="_blank">Dini Nurhayati</a>.</strong> All Right reserved
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop