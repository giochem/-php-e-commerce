<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <label for="product_name">Product Name</label>
                <select class="form-control" id="product_name">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="From">From</label>
                <input type="date" id="from" name="from" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="To">To</label>
                <input type="date" id="to" name="to" class="form-control" />
            </div>
            <div class="col-md-3 d-flex align-items-center justify-content-center"">
                <input type="button" class="btn btn-success" value="Filter" onclick="getData()" />
            </div>
        </div>
    </div>
</div>
