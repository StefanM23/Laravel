<html>
    <head>
    
    <!-- Load the jQuery JS library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
    
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <!-- Custom JS script -->
    <script type="text/javascript">  
        var config = {
            routes: {
                index: '{{ route('index') }}',
                cart:  '{{ route('cart.index') }}',
            }
        };


        $(document).ready(function () {
            
            function renderList(products, type) {
                html = [
                        '<tr>',
                            '<th>Image</th>',
                            '<th>Title</th>',
                            '<th>Description</th>',
                            '<th>Price</th>',
                            '<th></th>',
                        '</tr>',

                ].join('');
                
                $.each(products, function (key, product) {
                    if (type != 'cart') {
                        html += [
                                '<tr>',
                                    '<td><img src="image/' + product.image + '" alt="image"></td>', 
                                    '<td>' + product.title + '</td>',                       
                                    '<td>' + product.description + '</td>',                       
                                    '<td>' + product.price + '</td>',     
                                    '<td><form name="ajaxform" action="' + config.routes.index + '">@csrf<button type="submit" class="add-data">Add</button><input type="hidden" name="id" value="' + product.id + '"></form></td>',                  
                                '</tr>'
                        ].join('');
                    } else {
                        html += [
                            '<tr>',
                                '<td><img src="image/' + product.image + '" alt="image"></td>', 
                                '<td>' + product.title + '</td>',                       
                                '<td>' + product.description + '</td>',                       
                                '<td>' + product.price + '</td>',  
                                '<td><form name="ajaxform" action="#cart">@csrf<button type="submit" class="delete-data">Delete</button><input type="hidden" name="id" value="' + product.id + '"></form></td>',                      
                            '</tr>'                        
                        ].join('');
                    }

                });
                
                return html;
            }
           
            /**
            * URL hash change handler
            */
            window.onhashchange = function () {

                // First hide all the pages
                $('.page').hide();

                switch(window.location.hash) {
                    case '#cart':
                        // Show the cart page
                        $('.cart').show();
                        // Load the cart products from the server
                        $.ajax('cart', {
                            dataType: 'json',
                            success: function (response) {
                                // Render the products in the cart list
                                $('.cart .list').html(renderList(response, 'cart'));
                            }
                        });
                        break;
                    default:
                        // If all else fails, always default to index
                        // Show the index page
                        $('.index').show();
                        // Load the index products from the server
                        $.ajax('index', {
                            dataType: 'json',
                            success: function (response) {
                                // Render the products in the index list
                                $('.index .list').html(renderList(response));
                            }
                        }).done(() => {
                            actionAddRemove();
                        });
                        
                        break;
                }
            }
            
            
            function actionAddRemove() {
                $("form").on('submit', function(event) {
                    switch ($('button').attr('class')) {
                    case 'add-data':
                        $.ajax('index', {
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": $(this).serializeArray()[1].value,
                                },
                            type: "POST",
                            beforeSend:function(){
                                $(".add-data").addClass('disabled').text('Loading...');
                            },
                            success: function (response) {
                                $(".add-data").removeClass('disabled').text('Add');
                                console.log(response);
                                // renderList(response);
                                $('.index .list').html(renderList(response));  
                            }
                        }).done(() => {
                            actionAddRemove();
                        });
                        break;
                    case 'delete-data':
                    $.ajax('cart/{cartID}', {
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "id": $(this).serializeArray()[1].value,
                                },
                            type: "POST",
                            beforeSend:function(){
                                $(".delete-data").addClass('disabled').text('Loading...');
                            },
                            success: function (response) {
                                $(".delete-data").removeClass('disabled').text('Add');
                                console.log(response);
                                // renderList(response);
                                $('.index .list').html(renderList(response));  
                            }
                        }).done(() => {
                            actionAddRemove();
                        });
                      
                        break;
                }
                event.preventDefault();
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
            <a href="#cart" class="button">Go to cart</a>
        </div>
       
        <!-- The cart page -->
        <div class="page cart">
            <!-- The cart element where the products list is rendered -->
            <table class="list"></table>
           
            <!-- A link to go to the index by changing the hash -->
            <a href="#" class="button">Go to index</a>
        </div>
    </body>
</html