{{-- @dd($User) --}}

<br>
<br>

<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Thông tin chi tiết nhân viên</b></a></li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">

            @if (Session::Has('alert'))
                <div class="alert alert-success">
                    <strong>Success!</strong> {{ Session::Get('alert') }}.
                </div>
            @endif

            @if (Session::Has('err'))
                <div class="alert alert-warning">
                    <strong>Error!</strong> {{ Session::Get('err') }}.
                </div>
            @endif

            <div class="tile">
                <div class="tile-body">


                        @foreach ($User as $item)
                            {{-- @dd($item->TENNV) --}}
                        

                        <section style="background-color: #eee;">
                        <div class="container py-5">
                            <div class="row">
                            <div class="col">
                                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <button type="button" class="btn btn-warning"><a href="{{ route('taikhoan.index') }}">Quay về</a></button>
                                    </li>
                                </ol>
                                </nav>
                            </div>
                            </div>

                            <div class="row">

                            <div class="col-lg-12">
                                <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="{{ asset('images/'.$item->HINHANH)}}" alt="avatar"
                                    class="rounded-circle img-fluid" style="width: 150px;">
                                    <h5 class="my-3">{{ $item->TENNV }}</h5>
                                    <div class="d-flex justify-content-center mb-2">

                                        <form class="btn" action="{{ route('taikhoan.edit', ['id' => $item->MANV]) }}" method="get">
                                            @csrf
                                            <input type="hidden" name="MANV" value="">
                                            <button type="submit" class="btn btn-success">Cập nhật thông tin</button>
                                        </form>
                                        
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="card mb-4">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">MANV</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $item->MANV }}</p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">TENNV</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $item->TENNV }}</p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">SDT</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $item->SDT }}</p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $item->email }}</p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">password</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $item->password }}</p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $item->DC }}</p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">GIOITINH</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $item->GIOITINH }}</p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">TENKHO</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $item->TENKHO }}</p>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">QUANTRI</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $item->QUANTRI }}</p>
                                        </div>
                                    </div>

                                </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </section>

                        @endforeach

                </div>
            </div>
        </div>
    </div>
</main>
