<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->status }}</td>
                <td>
                    <a href="" data-toggle="modal" data-target="#updateproduct" data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                        data-status="{{ $product->status }}" class="update-product"><i class="fas fa-edit"></i> </a>
                    <a href="" data-id="{{ $product->id }}" class="delete-product"><i
                            class="fas fa-trash-alt"></i></a>
            </tr>
        @endforeach

    </tbody>
</table>

{{ $products->links() }}
