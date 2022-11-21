@extends('layouts.master')

@section('content')
    <style>
        .crd_btn_wrap {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            align-items: center;
        }

        .crd_btn {
            display: inline;
            background: #009c9a33;
            border: 1px solid #009c9a;
            border-radius: 4px;
        }

        .crd_btn:hover {
            background: #009c9a;
            color: #fff;
        }
    </style>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="preload_wrap">
                        <div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            @foreach ($products as $item)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <img src="{{ $item->image }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $item->name }}
                            </h5>
                            @if ($item->options)
                                <p>${{ $item->stock->min('price') }} - ${{ $item->stock->max('price') }}</p>
                            @else
                                <p>${{ $item->price }}</p>
                            @endif
                            <div class="d-flex crd_btn_wrap">
                                {{-- $item->attributes --}}
                                @if ($item->options)
                                    <button class="btn crd_btn show_crd_modal" pd_id="{{ $item->id }}">ADD CART</button>
                                @else
                                    <button class="btn crd_btn">ADD TO CART</button>
                                @endif
                                <button class="btn crd_btn">BUY NOW</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cart" aria-labelledby="cartLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="cartLabel">Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images,
                lists, etc.
            </div>
            <div class="dropdown mt-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Dropdown button
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" />
    </script>
    <script>
        var myOffcanvas = document.getElementById('cart')
        var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
        const myModal = new bootstrap.Modal('#exampleModal', {
            keyboard: true
        });
        anime({
            targets: '.btn',
            translateY: [-100, 0],
            delay: anime.stagger(50, {from: 'center'})
        });
        document.getElementById('exampleModal').addEventListener('show.bs.modal', function(e) {
            let mparent = $(this);
            mparent.find('.modal-body').html(`
                <div class="preload_wrap">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `);
        });

        $('.show_crd_modal').click(function() {
            let id = $(this).attr('pd_id');
            myModal.show();
            let dialog = $(myModal._dialog);
            
            $.ajax({
                type: "POST",
                url: "{{ route('varient_price') }}",
                data: {
                    _token: `{{ csrf_token() }}`,
                    pid: id
                },
                success: function(data) {
                    console.log(data);
                    // dialog.find('.modal-title').html(`${data.title}`);
                    dialog.find('.modal-body').html(data);

                    // dialog.find('.modal-body').html(`
                    //     ${data.name}
                    //     <span class="badge bg-success">sd</span>
                    // `);
                }
            });
            // bsOffcanvas.show();
        });
        // bsOffcanvas.show();
    </script>
@endsection
