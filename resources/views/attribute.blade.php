@extends('layout')

@section('content')
    <br><br>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
       {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif


    @foreach ($product as $item)
        {{ $item->name }}
        <ul>
            @foreach ($item->product_attribute as $attr)
                <li>
                    {{ $attr->attribute->name }}
                    {{ $attr->attribute_value->value }}
                    {{ $attr->price }}
                </li>
            @endforeach
        </ul>
    @endforeach

    <form action="{{ route('attribute.store') }}" class="container" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Attribute Name</label>
            <input type="text" name="name" class="form-control rounded-0" id="name" placeholder="Attribute name">
        </div>
        <label class="form-label">Attribute Value</label>
        <div id="attr_values">
            <div class="mb-3 d-flex">
                <input type="text" name="values[]" class="form-control rounded-0" id="value" placeholder="Value">
            </div>
            {{-- <div class="mb-3 d-flex">
                <input type="text" class="form-control rounded-0" id="value" placeholder="Attribute value">
                <button class="btn btn-danger rounded-0"><i class="fa fa-minus"></i></button>
            </div> --}}
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-success rounded-0">Save</button>
            <button type="button" class="btn btn-primary rounded-0" id="add_value"><i class="fa fa-plus"></i></button>
        </div>
    </form>

    @push('js')
        <script>
            let attr_fld = `<div class="mb-3 d-flex">
                                <input type="text" name="values[]" class="form-control rounded-0" id="value" placeholder="Value">
                                <button type="button" class="btn btn-danger rounded-0" onclick="$(this).parent().remove()"><i class="fa fa-minus"></i></button>
                            </div>`;
            $('#add_value').click(function() {
                console.log(attr_fld);
                $('#attr_values').append(attr_fld);
            })
        </script>
        {!! Toastr::message() !!}
    @endpush

@endsection
