@component('mail::message')

# Mail from Stefan for training!

This order is for **{{ $data->name }}** and command need to be send to ,
**{{ $data->contacts }}** .Comments from customer: **{{ $data->comments }}**.
<table border="1px" width="230px" height="120px">
@foreach($products as $type => $result)
<tr>
    <td><img src="{{ $result['image'] }}" width="100%" height="100%" alt="image"></td>
    <td>
        <ul style="list-style-type:none;margin-left:-30px;width:110px">
           <li>{{ $result['title'] }}</li>
           <li>{{ $result['description'] }}</li>
        </ul>
    </td>  
    <td>{{ $result['price'] }}</td>    
</tr>      
@endforeach
</table>

Thanks for ordering!
@endcomponent