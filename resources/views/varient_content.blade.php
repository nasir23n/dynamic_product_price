
<style>

/* .img {
    width: 100%;
} */


.varient_wrap {
    display: flex;
    flex-wrap: wrap;
}
.varient_wrap .img {
    max-width: 400px;
}
img {
    display: block;
    width: 100%;
    /* height: 100%; */
    object-fit: cover;
}
.varient_wrap .inf {
    flex: 1;
}
.check_wrap {
    display: flex;
    border: 1px solid #ddd;
    padding-left: 11px;
    border-radius: 8px;
    padding: 5px 10px;
    cursor: pointer;
}
.check_wrap strong {
    padding-left: 25px;
}
.variant_img {
    max-width: 50px;
    border: 1px solid #ccc;
    padding: 3px;
    border-radius: 5px;
}
.variant_img img {
    border-radius: 5px;
}

.d_parent {

}
.loop_wrap {
    display: inline-flex;
    flex-wrap: wrap;
}
/* .check_wrap */

</style>

<div class="varient_wrap">
    <div class="img">
        <img src="{{ $product->image }}" alt="">
    </div>
    <div class="inf">
        <h2>{{ $product->name }}</h2>

        <p>Select Varient</p>
        <div class="price">
            Price: <strong>TK{{ $product->stock->min('price') }}-TK{{ $product->stock->min('price') }}</strong>
        </div>
        <form id="p_deside_varient">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="">
                @foreach ($product->attributes as $key => $item)
                    <h5>{{ $item }}: </h5>
                    <div class="d_parent">
                        @foreach ($product->options[$item] as $opt)
                            <div class="loop_wrap">
                                <label class="check_wrap">
                                    <input class="form-check-input position-absolute" type="radio" name="variation_{{ $key }}" value="{{ $opt }}" required>
                                    <strong>{{ $opt }}</strong>
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            {{-- @foreach ($product->stock as $item)
                <div class="position-relative">
                    <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="radio" name="variation" id="variation_{{ $item->id }}" value="{{ $item->id }}" @checked($loop->first)>
                    <label class="list-group-item check_wrap py-3 pe-5" for="variation_{{ $item->id }}">
                        <div>
                            <div class="variant_img">
                                <img src="{{ $item->image }}" alt="">
                            </div>
                        </div>
                        <div>
                            <strong class="fw-semibold">{{ $item->sku }}</strong>
                            <span class="d-block small opacity-75">TK {{ $item->price }}</span>
                        </div>
                    </label>
                </div>
            @endforeach --}}
            </div>
            {{-- @foreach ($product->options as $key => $item)
                <div>
                    <strong>{{ $key }}</strong>
                    @foreach ($item as $el)
                        <span class="badge bg-success">{{ $el }}</span>
                    @endforeach
                </div>
            @endforeach --}}
            <button type="submit" class="btn btn-primary">Add To Cart</button>
        </form>
    </div>
</div>

<script>
$('#p_deside_varient input').change(function (e) {
    e.preventDefault();
    let srl = $('#p_deside_varient').serializeArray();
    $.ajax({
        type: 'POST',
        url: `{{ route('varient_price') }}`,
        data: srl,
        success: function (data) {
            if (data.price) {
                $('.price').html(`Price: TK ${data.price}`);
            }
        }
    });
});
$('#p_deside_varient').submit(function (e) {
    e.preventDefault();
    // let srl = $(this).serializeArray();
    // $.ajax({
    //     type: 'POST',
    //     url: `{{ route('cart.add') }}`,
    //     data: srl,
    //     success: function (data) {
    //         console.log(data);
    //         $('.price').html(`Price: TK ${data.price}`);
    //     }
    // });
});
</script>