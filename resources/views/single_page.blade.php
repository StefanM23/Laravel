<html lang="{{ config('app.locale') }}">
    <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Load the jQuery JS library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
    
 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <!-- Custom JS script -->
    <script type="text/javascript"> 

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        //request for translate /to take JSON file with translation
        var fr;
        $.ajax({
            'async': false,
            'global': false,
            'url': "http://localhost/cms2/resources/lang/fr.json",
            'dataType': "json",
            'success': function (data) {
                fr = data;
            }
        });

        function __(text) {
            if ($('html').attr('lang') == 'fr' && fr[text]) {
                return fr[text];
            }
            return text;
        }
     
        $(document).ready(function () {
            //function for render index page
            function renderListIndex(products) {
                html = [
                        '<tr>',
                            '<th>'+ __('Image') + '</th>',
                            '<th>'+ __('Title') + '</th>',
                            '<th>'+ __('Description') + '</th>',
                            '<th>'+ __('Price') + '</th>',
                            '<th></th>',
                        '</tr>',

                ].join('');
                
                $.each(products, function (key, product) {
                    html += [
                        '<tr>',
                            '<td><img src="image/' + product.image + '" alt="'+ __('image') + '"></td>', 
                            '<td>' + product.title + '</td>',                       
                            '<td>' + product.description + '</td>',                       
                            '<td>' + product.price + '</td>',     
                            '<td><form class="ajaxadd">@csrf<button type="submit" class="add-data">'+ __('Add') + '</button><input type="hidden" name="id" value="' + product.id + '"></form></td>',                  
                        '</tr>'
                    ].join('');
                });

                return html;
            }

            //function for render a part from cart page
            function renderListCart(products) {
                html = [
                        '<tr>',
                            '<th>'+ __('Image') + '</th>',
                            '<th>'+ __('Title') + '</th>',
                            '<th>'+ __('Description') + '</th>',
                            '<th>'+ __('Price') + '</th>',
                            '<th></th>',
                        '</tr>',

                ].join('');

                $.each(products, function (key, product) {
                    html += [
                        '<tr>',
                            '<td><img src="image/' + product.image + '" alt="image"></td>', 
                            '<td>' + product.title + '</td>',                       
                            '<td>' + product.description + '</td>',                       
                            '<td>' + product.price + '</td>',  
                            '<td><form class="ajaxremove">@csrf<button type="submit" class="remove-data">'+ __('Remove') + '</button><input type="hidden" name="id" value="' + product.id + '"></form></td>',                      
                        '</tr>'                        
                    ].join('');
                });
                
                return html;
            }

            function renderListProducts(products) {
                html = [
                        '<tr>',
                            '<th>'+ __('Image') + '</th>',
                            '<th>'+ __('Title') + '</th>',
                            '<th>'+ __('Description') + '</th>',
                            '<th>'+ __('Price') + '</th>',
                            '<th></th>',
                            '<th></th>',
                        '</tr>',

                ].join('');

                
                $.each(products, function (key, product) {
                    html += [
                        '<tr>',
                            '<td><img src="image/' + product.image + '" alt="'+ __('image') + '"></td>', 
                            '<td>' + product.title + '</td>',                       
                            '<td>' + product.description + '</td>',                       
                            '<td>' + product.price + '</td>',
                            '<td><a href="#product/'+ product.id +'/edit" name="edit" class="edit">'+ __('Edit') + '</a></td>',
                            '<td><form class="ajaxdelete">@csrf<button type="submit" class="delete-data">'+ __('Delete') + '</button><input type="hidden" name="id" value="' + product.id + '"></form></td>',                      
                        '</tr>'                        
                    ].join('');
                });
                
                return html;
            }

            function renderListProductsEdit(product) {
                $('#idEdit').attr('value', product.id);
                $('#titleEdit').attr('value', product.title);
                $('#descriptionEdit').attr('value', product.description);
                $('#priceEdit').attr('value', product.price);
                $('#imageEdit').attr('value', product.image);
            }

           
            function renderListOrders(products) {
                var html = [];
                $.each(products, function (key, product) {

                    sum = product.order_product.reduce((start,priceAdd)=>{
                        return start + (parseFloat(priceAdd.price) || 0)
                    },0)
                   
                    html += [
                        '<li>',
                            '<div class="checkout-i">', 
                                '<div>'+ __('Date') + ': '+ product.create_date+'</div>',  
                                '<div>'+ __('Customer') + ':'+ product.customer_name+' </div>', 
                                '<div>'+ __('Address') + ': '+ product.customer_address+'</div>',                      
                                '<div>'+ __('Comments') + ': '+ product.customer_comment+'</div>', 
                                '<div>'+ __('Total order') + ': '+ sum +' </div>',                  
                            '</div>',
                            '<div class="checkout-j">',
                                '<a href="#order/'+ product.id +'" name="view">'+ __('View') + '</a>',
                            '</div>',          
                        '</li>'                        
                    ].join('');
                });
                
                return html;
            }

            function renderListOrder(order) {

                html = [
                        '<div class="section-i">',                           
                            '<div class="checkout-box">',
                                '<div class="checkout-i">',
                                    '<div>'+ __('Date') + ': '+ order.create_date +'</div>',
                                    '<div>'+ __('Customer') + ': '+ order.customer_name +'</div>',
                                    '<div>'+ __('Address') + ': '+ order.customer_address +'</div>',
                                    '<div>'+ __('Comments') + ': '+ order.customer_comment +'</div>',  
                                '</div>',
                            '</div>', 
                        '</div>',
                        '<div class="section-i">',        
                ].join('');
           
                $.each(order.product, function (key, product) {

                    html += [
                        '<div class="section-i-info">',
                            '<div class="section-x-info">', 
                                '<img src="http://localhost/cms2/public/image/'+ product.image +'" alt="'+ __('image') + '">',  
                            '</div>', 
                            '<div class="section-x-info">',
                                '<ul>',
                                    '<li>'+ __('Title') + ':'+ product.title +'</li>',                      
                                    '<li>'+ __('Description') + ':'+ product.description +'</li>',  
                                    '<li>'+ __('Price') + ':'+ product.pivot.price +' </li>',
                                '</ul>',  
                            '</div>',
                        '</div>', 
                    ].join('');
                });
   
                return html;
            }

            window.onhashchange = function () {

                // First hide all the pages
                $('.page').hide();
             
                var urlHash = window.location.hash;
                var id = urlHash.split('/')[1];
               
                switch(urlHash) {
                    case '#cart':
                        // Show the cart page
                        $('.cart').show();

                        // Load the cart products from the server
                        $.ajax('cart', {
                            dataType: 'json',
                            success: function (response) {
                                // Render the products in the cart list
                              
                                $('.cart .list').html(renderListCart(response));

                            }
                        }).done(()=>{
                            actionAddRemove('cart');
                        });

                        break;
                    case '#login':
                        if (!$('body').hasClass('onOff')) {
                            // Show the login page
                            $('.login').show();
                        } else {
                            window.location.hash = 'products';
                        }
                        
                        break; 
                    case '#products':
                        if ($('body').hasClass('onOff')) {
                            // Show the products page
                            $('.products').show();
                            // Load the cart products from the server
                            $.ajax('products', {
                                dataType: 'json',
                                success: function (response) {
                                    // Render the products in the cart list
                                    $('.products .list').html(renderListProducts(response));
                                }
                            }).done(() => {
                                actionDeleteRecord();
                            });;
                        } else {
                            window.location.hash = 'login';
                        }    

                        break; 
                    case '#product/'+ id + '/edit':
                        // Show the product-edit page
                        $('.products-edit').show();
                        $.ajax('product/'+ id + '/edit', {
                        dataType: 'json',
                        success: function (response) {
                            $('.products-edit').html(renderListProductsEdit(response));
                        }
                        }).done(()=>{
                            actionEditRecord();
                        });

                        break;
                    case '#product/create':
                        // Show the product-create page
                        $('.products-create').show();    
                        $.ajax('product/create', {
                            dataType: 'json',
                            success: function (response) { 
                            }
                        }).done(()=>{
                            actionAddRecord();
                        });
                      
                        break;
                    case '#orders':
                        // Show the order page
                        $('.orders').show();   
                          
                        $.ajax('orders', {
                            dataType: 'json',
                            success: function (response) { 
                                // Render the orders 
                                $('.checkout-box').html(renderListOrders(response));
                            }
                        })
                        break;    
                    case '#order/'+ id:
                        // Show the order page
                   
                        $('.order').show();  
                        $.ajax('orders_products/' + id, {
                            dataType: 'json',
                            success: function (response) { 
                                // Render the orders 
                                $('.full-section').html(renderListOrder(response[0]));
                            }
                        })
                        break;
                    default:
                        // Show the index page
                        $('.index').show();
                        // Load the index products from the server
                        $.ajax('index', {
                            dataType: 'json',
                            success: function (response) {
                                // Render the products in the index list
                                $('.index .list').html(renderListIndex(response));
                            }
                        }).done(() => {
                            actionAddRemove('index');
                        });
                        break;
                }
            }
            function actionEditRecord() {
                $(".ajaxedit").off('submit').on('submit', function(event) {
                    event.preventDefault();
                 
                    var id = $(this).serializeArray()[2].value;
                  
                    var formData = new FormData($('.ajaxedit')[0]);
             
                    $.ajax('product/'+ id, {
                        dataType: 'json',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {  
                        }
                    })
                });
            }

            function actionAddRecord() {
                $(".ajaxadd").off('submit').on('submit', function(event) {
                    event.preventDefault();
                    var formData = new FormData($('.ajaxadd')[0]);
                    $.ajax('product', {
                        dataType: 'json',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {}
                    })
                });
            }

            function actionDeleteRecord() {
                $('.ajaxdelete').on('submit', function(event) {
                    event.preventDefault();
                    var id = $(this).serializeArray()[1].value;
                    $.ajax('products/'+ id, {
                        dataType: 'json',
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                        },
                        beforeSend:function(){
                            $(".delete-data").addClass('disabled').text('Loading...');
                        },
                        success: function (response) {
                            $(".delete-data").removeClass('disabled').text('Remove');
                            $(event.target).parents('tr').remove(); 
                        }
                    });
                })
            }
            
            function actionAddRemove(type) {
                switch (type) {
                    case 'index':
                        $(".ajaxadd").on('submit', function(event) {
                            event.preventDefault();
                            $.ajax('index', {
                                dataType: 'json',
                                type: "POST",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    "id": $(this).serializeArray()[1].value,
                                },
                                beforeSend:function(){
                                    $(".add-data").addClass('disabled').text('Loading...');
                                },
                                success: function (response) {
                                    $(".add-data").removeClass('disabled').text('Add');
                                    $(event.target).parents('tr').remove(); 
                                }
                            }).done(() => {
                                 console.log('Remove');
                            });
                        });
                      
                        break;    
                    case 'cart':
                        $(".ajaxremove").on('submit', function(event) {
                            event.preventDefault();
                            var id = $(this).serializeArray()[1].value;
                            $.ajax('cart/'+ id, {
                                dataType: 'json',
                                type: "DELETE",
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'id': id,
                                },
                                beforeSend:function(){
                                    $(".delete-data").addClass('disabled').text('Loading...');
                                },
                                success: function (response) {
                                    $(".delete-data").removeClass('disabled').text('Remove');
                                    $(event.target).parents('tr').remove();
                                }
                            }).done(() => {
                                 console.log('DELETE');
                            });
                        }); 
                      
                    break;
                }
            }

            if (window.location.hash == "#cart") {
                $(".ajaxcheckout").on('submit',function(event) {
                    event.preventDefault();

                    $.ajax('cart', {
                        dataType: 'json',
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "name": $(this).serializeArray()[1].value,
                            "contacts": $(this).serializeArray()[2].value,
                            "comments": $(this).serializeArray()[3].value,
                        },
                        beforeSend:function(){
                            $(".checkout-data").addClass('disabled').text('Loading...');
                        },
                        success: function (response) {
                            $(".checkout-data").removeClass('disabled').text('Ckeckout');
                        }
                    })
                });
            }
       
            if (window.location.hash == "#login" && !$('body').hasClass('onOff')) {
                $(".ajaxlogin").off('submit').on('submit', function(event) {
                    event.preventDefault();

                    var formData = new FormData($(".ajaxlogin")[0]);

                    $.ajax('login', {
                        dataType: 'json',
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                        }
                    }).done(() => {
                        $('body').addClass('onOff')
                        window.location.hash = 'products';
                    });
                });
            }
               
            if (window.location.hash == "#products" && $('body').hasClass('onOff')) {       
                $("#logout-form").off('submit').on('submit', function(event) {
                    event.preventDefault();
                    var formData = new FormData($(".ajaxlogout")[0]);
                    console.log('da');
                    $.ajax('logout', {
                        dataType: 'json',
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {}
                    }).done(()=>{
                        $('body').removeClass('onOff')
                        window.location.hash = 'login';
                    })
                });
            } 
                  
            window.onhashchange();
        });
    </script>
    </head>
    <body>
        <!-- The index page -->
        <div class="page index">
            <!-- The index element where the products list is rendered -->
               
            <table class="list"></table>
               
            <!-- A link to go to the cart by changing the hash -->
            <a href="#cart" class="button">{{ __('Go to cart') }}</a>
        </div>
       
        <!-- The cart page -->
        <div class="page cart">
            <!-- The cart element where the products list is rendered -->
            <table class="list"></table>
            <div class="cart-section">
                <form class="ajaxcheckout">
                    @csrf
                    <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}"><br>
                    <textarea name="contacts" style="resize: none;"  cols="30" rows="2" placeholder="{{ __('Contact details') }}" value="{{ old('contacts') }}"></textarea><br>
                    <textarea name="comments" style="resize: none;" cols="30" rows="4" placeholder="{{ __('Comments') }}" value="{{ old('comments') }}"></textarea><br>
                    <a href="#" class="button">{{ __('Go to Index') }}</a>
                    <button type="submit" class="checkout-data" name="checkout" value>{{ __('Checkout') }}</button>
                </form>
            </div>
        </div>

        <!-- The login page -->
        <div class="page login">
            <div class="card-body">
                <form class="ajaxlogin">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit"  class="btn btn-primary login login-button">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

       
         <!-- The products page -->
         <div class="page products">
            <table class="list"></table>

            <div class="cart-section-products">
                <a href="#product/create" name='add'>{{ __('Add') }}</a>
            </div>

            <form id="logout-form" class="ajaxlogout">
                @csrf
                <button type="submit"  class="btn btn-primary login login-button">
                    {{ __('Logout') }}
                </button>
            </form>
        </div>  

        <!-- The edit page -->
        <div class="page products-edit">
            <form enctype="multipart/form-data"  class="ajaxedit myProductFrom">
                @csrf
                @method("PUT")
                <input type="hidden" name="id" id="idEdit">
                <input class="item-i" type="text" name="title" id="titleEdit"  placeholder="Title" value="{{ old('title') }}"><br>
                <input class="item-i" type="text" name="description" id="descriptionEdit" placeholder="Description" value="{{ old('description') }}"><br>
                <input class="item-i" type="text" name="price" id="priceEdit" placeholder="Price" value="{{ old('price') }}"><br>
                <input class="item-j" type="text" name="image" id="imageEdit" placeholder="Image" value="{{ old('image') }}">
                <input class="item-j" type="file" name="file"><br>
                <a class="item-j-y" href="#products">{{ __('Products') }}</a>
                <button class="item-j-y" type="submit" name="submit">{{ __('Save') }}</button>
            </form>  
        </div> 

        <!-- The create page -->
        <div class="page products-create">
            <form enctype="multipart/form-data"  class="ajaxadd myProductFrom">
                @csrf
                <input class="item-i" type="text" name="title"   placeholder="Title" value="{{ old('title') }}"><br>
                <input class="item-i" type="text" name="description"  placeholder="Description" value="{{ old('description') }}"><br>
                <input class="item-i" type="text" name="price"  placeholder="Price" value="{{ old('price') }}"><br>
                <input class="item-j" type="text" name="image"  placeholder="Image" value="{{ old('image') }}">
                <input class="item-j" type="file" name="file"><br>
                <a class="item-j-y" href="#products">{{ __('Products') }}</a>
                <button class="item-j-y" type="submit" name="submit">{{ __('Save') }}</button>
            </form>      
        </div> 

        <!-- The orders page -->
        <div class="page orders">
            <ul class="checkout-box"></ul>
        </div>

         <!-- The order page -->
         <div class="page order">
            <div class="full-section"></div>
            <a href="#orders">{{ __('Back') }}</a>
        </div>

    </body>
</html