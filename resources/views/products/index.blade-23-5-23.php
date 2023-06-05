<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ url('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{-- Toastr --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <title>Ajax CRUD</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3 my-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-2" style="float: right;" data-toggle="modal"
                    data-target="#addproduct">
                    Add product
                </button>
                <div class="mb-3 mt-2">
                    <label for="" class="form-label">Search</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder=""
                        aria-describedby="helpId">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="table-panel">
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
                                        <a href="" data-toggle="modal" data-target="#updateproduct"
                                            data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                            data-price="{{ $product->price }}" data-category="{{ $product->category }}"
                                            data-status="{{ $product->status }}" class="update-product"><i
                                                class="fas fa-edit"></i> </a>
                                        <a href="" data-id="{{ $product->id }}" class="delete-product"><i
                                                class="fas fa-trash-alt"></i></a>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addproduct" tabindex="-1" aria-labelledby="addproductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="errMsgContainer text-center"></div>
                <form id="product-form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addproductLabel">Add product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="prodcutName">Name</label>
                            <input type="text" class="form-control prodcut_name" name="name" id="prodcutName"
                                placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="prodcutPrice">price</label>
                            <input type="text" class="form-control prodcut_price" name="price" id="prodcutPrice"
                                placeholder="Price">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Category select</label>
                            <select class="form-control category" id="categoryselect" name="category">
                                <option value="man">man</option>
                                <option value="woman">woman</option>
                                <option value="children">children</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 ">
                                <label for="prodcutName">Status</label>
                                <input type="hidden" value="0" class="js-switch status" name="status">
                                <input type="checkbox" value="1" class="js-switch status" name="status"
                                    @if ('checked') checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-click">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- update Modal -->
    <div class="modal fade" id="updateproduct" tabindex="-1" aria-labelledby="updateproductLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="up-errMsgContainer text-center"></div>
                <form id="up-product-form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateproductLabel">Update product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="id" id="updata-id" class="up-id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="prodcutName">Name</label>
                            <input type="text" class="form-control up_name" name="name" id="up-name">
                        </div>
                        <div class="form-group">
                            <label for="prodcutPrice">price</label>
                            <input type="text" class="form-control up_price" name="price" id="up-price">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Category select</label>

                            <select class="form-control up-category" id="up-category" name="category">
                                <option value="man">man</option>
                                <option value="woman">woman</option>
                                <option value="children">children</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 ">
                                <label for="prodcutName">Status</label>
                                <input type="checkbox" class="js-switch mycheckbox up-status" id="up-status"
                                    name="status">
                            </div>

                            {{-- <td><%if (TableData.Rows[data][3].ToString() == "True")    
                        { %>  
                    <input type="checkbox" class="chcktbl1" checked="checked" name="chcktbl1" data-id="  
                        <%=TableData.Rows[data]["id"]%>" /><%} %><%else    
                        { %>  
                        <input type="checkbox" class="chcktbl1" name="chcktbl1" data-id="  
                            <%=TableData.Rows[data]["id"]%>" /><%} %>  
                        </td> --}}

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-click-update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    {{-- toastr --}}
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script> --}}

    <script>
        $(document).ready(function() {
            // alert("kk");
        })
    </script>

    <script type="text/javascript>">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
    {{-- Ajax crud --}}
    <script>
        $(document).ready(() => {
            // $(".category option[value=children]").attr('selected', 'selected');
        });
        $(document).ready(function() {
            //add
            $(document).on('click', '.btn-click', function(e) {
                e.preventDefault();
                let name = $('.prodcut_name').val();
                let price = $('.prodcut_price').val();
                // let category = $('.category').val();

                let status = $('.status:checked').val() ? $('.status:checked').val() : '0';
                var token = '{{ csrf_token() }}';
                let dataall = {
                    'name': name,
                    'price': price,
                    'category': category,
                    'status': status,
                };
                alert(category);
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
                // alert(status);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('products.store') }}",
                    data: dataall,
                    dataType: "json",

                    success: function(res) {
                        if (res.status == 'success') {
                            $('#addproduct').modal('hide'); // Modal hide
                            $('#product-form')[0].reset(); // form refresh 
                            $('.table').load(location.href +
                                ' table'); //data display without reload
                            Command: toastr["success"]("Product Added",
                                "success")

                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }

                        }
                    },
                    error: function(jqXhr, json, errorThrown) { // this are default for ajax errors 
                        $('.errMsgContainer').html('');
                        var errors = jqXhr.responseJSON;
                        $('#product-form')[0].reset(); // form refresh 
                        $.each(errors['errors'], function(index, value) {
                            $('.errMsgContainer').append('<span class="text-danger">' +
                                value + '</span>' + '<br>')
                        });
                        Command: toastr["error"]("Error!", "success")

                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                });
                // https://www.binaryboxtuts.com/php-tutorials/laravel-tutorials/laravel-8-ajax-crud-app-easy-step-by-step-tutorial/
                // https
                //     : //stackoverflow.com/questions/48370280/422-unprocessable-entity-error-when-submitting-form-with-ajax
                // alert(status);
            })
            // show prodcut value for update
            $(document).on('click', '.update-product', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let name = $(this).data('name');
                let price = $(this).data('price');
                let category = $(this).data('category');
                let status = $(this).data('status');

                $('#updata-id').val(id)
                $('#up-name').val(name)
                $('#up-price').val(price)
                $('#up-category').val(category)

                $("#up-category option[value=category]").attr('selected', 'selected');
                // https://www.geeksforgeeks.org/how-to-change-selected-value-of-a-drop-down-list-using-jquery/
                // $(this).find(':selected')[0].name;
                $('#up-status').val(status)
                if (status == 1) {
                    $(".mycheckbox").attr('checked', true);
                } else {
                    $(".mycheckbox").attr('checked', false);
                }
                // https://www.edureka.co/community/82797/how-to-set-checked-for-a-checkbox-with-jquery
                // https://stackoverflow.com/questions/48784717/update-query-when-check-the-checkbox-with-ajax

                // https: //www.codexworld.com/dynamic-dependent-select-box-using-jquery-ajax-php/
            })
            // Update
            $(document).on('click', '.btn-click-update', function(e) {
                e.preventDefault();

                let id = $('.up-id').val();
                let name = $('.up_name').val();
                let price = $('.up_price').val();
                let category = $('.up-category').val();
                let statusId = $('.up-status').is(':checked') ? 1 : 0;
                // alert(category);
                let dataall = {
                    'id': id,
                    'name': name,
                    'price': price,
                    'category': category,
                    'status': statusId,
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    // headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    type: "POST",
                    url: "{{ route('products.update') }}",
                    data: dataall,
                    dataType: "json",
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#updateproduct').modal('hide'); // Modal hide
                            $('#up-product-form')[0].reset(); // form refresh 
                            $('.table').load(location.href +
                                ' table'); //data display without reload

                            Command: toastr["success"]("Product Update",
                                "success")

                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }


                        }
                    },
                    error: function(jqXhr, json, errorThrown) { // this are default for ajax errors 
                        $('.up-errMsgContainer').html('');
                        var errors = jqXhr.responseJSON;
                        $('#up-product-form')[0].reset(); // form refresh 
                        $.each(errors['errors'], function(index, value) {
                            $('.up-errMsgContainer').append(
                                '<span class="text-danger">' +
                                value + '</span>' + '<br>')
                        });


                    }


                });

            })
            // Delete
            $(document).on('click', '.delete-product', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let dataall = {
                    'id': id,
                };
                if (confirm("Are your sure delete the product")) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{{ route('products.delete') }}",
                        data: dataall,
                        dataType: "json",

                        success: function(res) {
                            if (res.status == 'success') {
                                $('.table').load(location.href +
                                    ' table'); //data display without reload
                                Command: toastr["success"]("Product Delete?",
                                    "success")

                                toastr.options = {
                                    "closeButton": false,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "positionClass": "toast-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                }
                            }
                        }
                    });
                }
            })
            // Pagination
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1]
                product(page)
            })

            function product(page) {
                $.ajax({
                    url: "pagination/paginate-data?page=" + page,
                    success: function(res) {
                        $('.table-panel').html(res)
                    }
                });
            }
            // Seach
            $(document).on('keyup', function(e) {
                e.preventDefault();
                let search = $("#search").val();
                var data = {
                    "search": search
                };

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: "{{ route('products.search') }}",
                    data: data,
                    success: function(res) {
                        $('.table-panel').html(res)
                        if (res.status == "Nothing Found") {
                            $('.table-panel').html('<span class="text-danger">' +
                                ' No found any data' + '</span>')
                        }
                    }
                });


            });


        });
    </script>
    {!! Toastr::message() !!}
</body>

</html>
