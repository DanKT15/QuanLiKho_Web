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


                    @if (!empty($phieu))

                       <h2>Code orders: <span style="text-transform: lowercase; font-style: oblique">{{ vn_to_str($phieu['SOPHIEU']) }}</span></h2> 
                       <h3>Warehouse: <span style="text-transform: lowercase; font-style: oblique">{{ vn_to_str($kho) }}</span></h3>
                       <b>Date: <span style="text-transform: lowercase; font-style: oblique">{{ vn_to_str($phieu['NGAYLAP']) }}</span></b><br>
                       <b>Order maker: <span style="text-transform: lowercase; font-style: oblique">{{ $nhanvien }}</span></b><br>

                       @if (!empty($Trangthai))
                            @foreach ($Trangthai as $key => $values)
                                @if ($values['MATT'] == $phieu['MATT'])
                                    <b>Type: {{ vn_to_str($values['TENTT']) }}</b><br>
                                @endif
                            @endforeach
                        @endif

                        @if (!empty($DCnhapxuat))
                            @foreach ($DCnhapxuat as $key => $values)
                                @if ($values['MADC'] == $phieu['MADC'])
                                    <b>Destination: {{ vn_to_str($values['TENDC']) }} - Address: {{ vn_to_str($values['DCNHAPXUAT']) }}</b><br><br>
                                @endif
                            @endforeach
                        @endif
                       
                
                     @endif

                    <table>
                        
                        <tr>
                            <th>Product code</th>
                            <th>Product name</th>
                            <th>Quantity</th>
                            <th>Unit price</th>
                            <th>Into money</th>
                        </tr>
                        
                        

                            @php
                                $tong = 0;
                            @endphp

                            @if (!empty($ctphieu))
                                
                                @foreach ($ctphieu as $key => $value)
                                    
                                    @php
                                        $tong += $value['THANHTIEN'];
                                    @endphp

                                    <tr>

                                        <td>{{ vn_to_str($value['MASP']) }}</td>

                                        @if (!empty($sanpham))
                                            @foreach ($sanpham as $key => $values)
                                                @if ($values['MASP'] == $value['MASP'])
                                                    <td>{{ vn_to_str($values['TENSP']) }}</td>
                                                @endif
                                            @endforeach
                                        @endif

                                        <td>{{ $value['SOLUONG'] }}</td>
                                        <td>{{ number_format($value['DONGIA']) }}VND</td>
                                        <td>{{ number_format($value['THANHTIEN']) }}VND</td>
                                    </tr>

                                @endforeach

                                {{-- @dd($ctphieu) --}}

                            @endif
                                        
                        
                    </table>
                    <br>
                    <br>
                    <div>Total order: {{ number_format($tong) }}VND</div>

                    <br>
                    <div class="card-body">
                        <img src="data:image/png;base64,{{ $qrcode }}">
                    </div>

</body>
</html>