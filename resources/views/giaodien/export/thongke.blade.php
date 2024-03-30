<!DOCTYPE html>
<html lang="vi">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">

      <title>Quan Ly Kho Hang</title>

      <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
      </style>

</head>
<body>

    @php
        function vn_to_str($str){
 
            $unicode = array(
            
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            
            'd'=>'đ',
            
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            
            'i'=>'í|ì|ỉ|ĩ|ị',
            
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            
            'D'=>'Đ',
            
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            
            );
            
            foreach($unicode as $nonUnicode=>$uni){
            
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
            
            }
            $str = str_replace(' ',' ',$str);
            
            return $str;
            
        }
    @endphp


<table>
  
        <tr>
            <th>STT</th>
            <th>Product code</th>
            <th>Product name</th>
            <th>Quantity of imported products</th>
            <th>Quantity of products exported</th>
            <th>Quantity of products in stock</th>
        </tr>

        @php
            $stt = 0;
        @endphp

        @if (!empty($thongke))
            
            @foreach ($thongke as $value)
                
                <tr>
                    <td>{{ $stt }}</td>
                    <td>{{ $value->MASP }}</td>
                    <td>{{ vn_to_str($value->TENSP) }}</td>
                    <td>{{ $value->SLNHAP }}</td>
                    <td>{{ $value->SLXUAT }}</td>
                    <td>{{ $value->SLTONKHO }}</td>
                </tr>

                @php
                    $stt += 1;
                @endphp

            @endforeach

        @endif
                    
</table>

</body>
</html>