<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
      <!-- Main CSS-->
      <link rel="stylesheet" type="text/css" href={{ asset("/admin/css/main.css") }}>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
      <!-- or -->
      <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
      <!-- Font-icon css-->
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">


      {{-- <link href={{ asset("/chart/css/bootstrap.min.css") }} rel="stylesheet">
	<link href={{ asset("/chart/css/font-awesome.min.css") }} rel="stylesheet">
	<link href={{ asset("/chart/css/datepicker3.css") }} rel="stylesheet">
	<link href={{ asset("/chart/css/styles.css") }} rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> --}}


      <title>Quan Ly Kho Hang</title>

      <style>
            body{
            background:#eee;
            }
            .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
            }
            .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: 1rem;
            }
            .text-reset {
            --bs-text-opacity: 1;
            color: inherit!important;
            }
            a {
            color: #5465ff;
            text-decoration: none;
            }
      </style>

      @php

            if (isset($data_BD_Cot_nhap) && isset($data_BD_Cot_xuat) && isset($data_tron) && isset($data_duong)) {

                  // echo $data_tron[0]['y'];

                  echo '<script>
                        window.onload = function () {
                        
                              var bieudocot = new CanvasJS.Chart("bieudocot", {
                                    animationEnabled: true,
                                    title:{
                                          text: "Biểu đồ nhập xuất kho qua từng tháng"
                                    },	
                                    axisY: {
                                          title: "Nhập",
                                          titleFontColor: "#4F81BC",
                                          lineColor: "#4F81BC",
                                          labelFontColor: "#4F81BC",
                                          tickColor: "#4F81BC"
                                    },
                                    axisY2: {
                                          title: "Xuất",
                                          titleFontColor: "#C0504E",
                                          lineColor: "#C0504E",
                                          labelFontColor: "#C0504E",
                                          tickColor: "#C0504E"
                                    },	
                                    toolTip: {
                                          shared: true
                                    },
                                    legend: {
                                          cursor:"pointer",
                                          itemclick: toggleDataSeries
                                    },
                                    data: [{
                                          type: "column",
                                          name: "Số lượng nhập (sản phẩm)",
                                          legendText: "Số lượng nhập",
                                          showInLegend: true, 
                                          dataPoints:[
                                                { label: "Tháng 1", y: '.$data_BD_Cot_nhap[0].' },
                                                { label: "Tháng 2", y: '.$data_BD_Cot_nhap[1].' },
                                                { label: "Tháng 3", y: '.$data_BD_Cot_nhap[2].' },
                                                { label: "Tháng 4", y: '.$data_BD_Cot_nhap[3].' },
                                                { label: "Tháng 5", y: '.$data_BD_Cot_nhap[4].' },
                                                { label: "Tháng 6", y: '.$data_BD_Cot_nhap[5].' },
                                                { label: "Tháng 7", y: '.$data_BD_Cot_nhap[6].' },
                                                { label: "Tháng 8", y: '.$data_BD_Cot_nhap[7].' },
                                                { label: "Tháng 9", y: '.$data_BD_Cot_nhap[8].' },
                                                { label: "Tháng 10", y: '.$data_BD_Cot_nhap[9].' },
                                                { label: "Tháng 11", y: '.$data_BD_Cot_nhap[10].' },
                                                { label: "Tháng 12", y: '.$data_BD_Cot_nhap[11].' },
                                          ]
                                    },
                                    {
                                          type: "column",	
                                          name: "Số lượng xuất (sản phẩm)",
                                          legendText: "Số lượng xuất",
                                          axisYType: "secondary",
                                          showInLegend: true,
                                          dataPoints:[
                                                { label: "Tháng 1", y: '.$data_BD_Cot_xuat[0].' },
                                                { label: "Tháng 2", y: '.$data_BD_Cot_xuat[1].' },
                                                { label: "Tháng 3", y: '.$data_BD_Cot_xuat[2].' },
                                                { label: "Tháng 4", y: '.$data_BD_Cot_xuat[3].' },
                                                { label: "Tháng 5", y: '.$data_BD_Cot_xuat[4].' },
                                                { label: "Tháng 6", y: '.$data_BD_Cot_xuat[5].' },
                                                { label: "Tháng 7", y: '.$data_BD_Cot_xuat[6].' },
                                                { label: "Tháng 8", y: '.$data_BD_Cot_xuat[7].' },
                                                { label: "Tháng 9", y: '.$data_BD_Cot_xuat[8].' },
                                                { label: "Tháng 10", y: '.$data_BD_Cot_xuat[9].' },
                                                { label: "Tháng 11", y: '.$data_BD_Cot_xuat[10].' },
                                                { label: "Tháng 12", y: '.$data_BD_Cot_xuat[11].' },
                                          ]
                                    }]
                              });
                              bieudocot.render();

                              function toggleDataSeries(e) {
                                    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                          e.dataSeries.visible = false;
                                    }
                                    else {
                                          e.dataSeries.visible = true;
                                    }
                                    bieudocot.render();
                              }';

                              // -----------------------------------------------------
                        echo ' var bieudotron = new CanvasJS.Chart("bieudotron", {
                                    theme: "light2", // "light1", "light2", "dark1", "dark2"
                                    exportEnabled: true,
                                    animationEnabled: true,
                                    title: {
                                          text: "Biểu đồ tròn số lượng sản phẩm tồn kho"
                                    },
                                    data: [{
                                          type: "pie",
                                          startAngle: 25,
                                          toolTipContent: "<b>{label}</b>: {y}%",
                                          showInLegend: "true",
                                          legendText: "{label}",
                                          indexLabelFontSize: 16,
                                          indexLabel: "{label} - {y}%",
                                          dataPoints: [';
                                                
                                                foreach ($data_tron as $key => $value) {
                                                      echo '{ y: '.$value['y'].', label: "'.$value['label'].'" },';
                                                }

                                          echo ']
                                    }]
                              });
                              bieudotron.render();';

                              // -----------------------------------------------------
                        echo ' var bieudoduong = new CanvasJS.Chart("bieudoduong", {
                                    theme: "light1", // "light1", "light2", "dark1"
                                    animationEnabled: true,
                                    exportEnabled: true,
                                    title: {
                                          text: "Số lượng sản phẩm trong kho"
                                    },
                                    axisX: {
                                          margin: 10,
                                          labelPlacement: "inside",
                                          tickPlacement: "inside"
                                    },
                                    axisY2: {
                                          title: "số lượng sản phẩm",
                                          titleFontSize: 14,
                                          includeZero: true,
                                          suffix: ""
                                    },
                                    data: [{
                                          type: "bar",
                                          axisYType: "secondary",
                                          yValueFormatString: "#,###.##",
                                          indexLabel: "{y}",
                                          dataPoints: [';

                                                foreach ($data_duong as $key => $value) {
                                                      echo '{ label: "'.$value['label'].'", y: '.$value['y'].' },';
                                                }

                                          echo ']
                                    }]
                              });
                              bieudoduong.render();

                        }
                  </script>';



            };
            
      @endphp


</head>
<body>

<!-- Navbar-->
<header class="app-header">
  <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
    aria-label="Hide Sidebar"></a>
  <!-- Navbar Right Menu-->
  <ul class="app-nav">
    
    <!-- User Menu-->
    <li>
      <form method="POST" action="{{ route('logout') }}">
            @csrf
      
            <a class="app-nav__item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                  <i class='bx bx-log-out bx-rotate-180'></i> 
            </a>
           
        </form>
    </li>
  </ul>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user">
      <p class="app-sidebar__user-name"><b>{{ Auth::user()->TENNV }}</b></p>
      <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
  </div>
  <hr>
  <ul class="app-menu">

      {{-- @dd(Auth::user()->QUANTRI) --}}
          
            <li><a class="app-menu__item" href="{{ route('dashboard') }}"><i class='app-menu__icon bx bx-dollar'></i><span
                  class="app-menu__label">Dashboard</span></a></li>
      
            <li><a class="app-menu__item " href="{{ route('phieunhapxuat.index') }}"><i class='app-menu__icon bx bx-id-card'></i> <span
                  class="app-menu__label">Quản Lý Phiếu</span></a></li>
      
            <li><a class="app-menu__item" href="{{ route('taikhoan.index') }}"><i class='app-menu__icon bx bx-user-voice'></i><span
                  class="app-menu__label">Quản Lý Nhân Sự</span></a></li>
      
            <li><a class="app-menu__item" href="{{ route('kho.index') }}"><i class='app-menu__icon bx bx-purchase-tag-alt'></i><span 
                  class="app-menu__label">Quản Lý Kho</span></a></li>
      
            <li><a class="app-menu__item" href="{{ route('sanpham.index') }}"><i class='app-menu__icon bx bx-purchase-tag-alt'></i><span 
                  class="app-menu__label">Quản Lý Sản Phẩm</span></a></li>
      
            <li><a class="app-menu__item" href="{{ route('loaisp.index') }}"><i class='app-menu__icon bx bx-task'></i><span
                  class="app-menu__label">Quản Lý Phân Loại</span></a></li>
      
            <li><a class="app-menu__item " href="{{ route('nhacungcap.index') }}"><i class='app-menu__icon bx bx-id-card'></i> <span
                  class="app-menu__label">Quản Lý Nhà Cung Cấp</span></a></li>
      
            <li><a class="app-menu__item " href="{{ route('trangthai.index') }}"><i class='app-menu__icon bx bx-purchase-tag-alt'></i> <span
                  class="app-menu__label">Quản Lý Trạng Thái</span></a></li>
      
            <li><a class="app-menu__item" href="{{ route('diachinhapxuat.index') }}"><i class='app-menu__icon bx bx-run'></i><span
                  class="app-menu__label">Quản Lý Địa Chỉ</span></a></li>

     

  </ul>
</aside>


    