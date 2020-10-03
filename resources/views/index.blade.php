@extends('layout.master')


@section('row')



  

    <!-- <div id="tes"></div> -->

    <div id="tessatu" style="height: 400px"></div>

    {{-- <a href="{{route('printdata')}}" target="_blank">
    <button type="button" class="btn btn-info btn-sm" > <i class="icon-download mt-2">Export Data</i></button>
    </a>    --}}
    


<!--     
<script>



$(document).ready(function(){

var sesi = [];
var datamaster =[];
var datatidaktersedia = []

    $.ajax({
    url: '{{route('getajax')}}',
    method: 'get',
    dataType: 'json',
    success: function(data){
       data.forEach((key,value)=> {
        sesi.push(`Sesi ${key.Sesi}`);
        datamaster.push(key.Tersedia.length);
        datatidaktersedia.push(Object.entries(key.ttsd).length);
        // console.log());
        
       })

       console.log(datatidaktersedia);

       Highcharts.chart('tes', {
    chart: {
        type: 'column'
    },
 
    title: {
        text: 'Data Statistik Yang Sudah Di Audit'
    },


    xAxis: {
        categories: sesi,
        min : 0,
        visibile:false

    },

    yAxis: {
        min: 0,
        title: {
            text: 'Banyaknya Data'
        }
    },
    tooltip: {
     
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },

    series: [{
        name: 'Tersedia',
        data: datamaster

    }, {
        name: 'Tidak Tersedia',
        data: datatidaktersedia

    }]
});
       
    }
    });

  



});

</script>  -->



<script>

$(document).ready(function(){

var sesi = [];
var datamaster =[];
var datatidaktersedia = []

    $.ajax({
    url: '{{route('getajax')}}',
    method: 'get',
    dataType: 'json',
    success: function(data){
       data.forEach((key,value)=> {
        sesi.push(`Sesi ${key.Sesi}`);
        datamaster.push(key.Tersedia.length);
        datatidaktersedia.push(Object.entries(key.ttsd).length);
    
        
       })

      //  console.log(datatidaktersedia);

       $('#tessatu').highcharts({
    chart: {
      type: 'column'
    },
    mapNavigation: {
      enableMouseWheelZoom: true
    },
    title: {
      text: 'Data Statistik Yang Sudah Di Audit'
    },
    xAxis: {
      categories: sesi,
      max :4,
        visibile:false,
      scrollbar: {
        enabled: true
      }
    },
    yAxis: {
      scrollbar: {
        enabled: true
      }
    },
    plotOptions: {
    	series: {
      	stacking: 'normal'
      }
    },
    series: [{
        name: 'Tersedia',
        data: datamaster
    }, {
        name: 'Tidak Tersedia',
        data: datatidaktersedia
    }]
  });
       
    
    
    
    
    }
    });


});

</script>

@endsection





@section('dashboard')


<script src="https://cdn.jsdelivr.net/npm/alasql@0.6.3/dist/alasql.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.4/xlsx.core.min.js"></script>
{{-- 
<button id="button-a" Create Excel></button> --}}

<button onclick="saveFile()">Save XLSX file</button>

<script>

$(document).ready(function(){

var sheet;


$.ajax({

    url : '{{route('getSheet')}}',
    method : 'get',
    dataType : 'json',
    success : function(data){
    sheet=data;
    console.log(data)
    }
});

window.saveFile = function saveFile () {
  var data1 =[sheet];
  
    var opts = [{sheetid:'One',header:true},{sheetid:'Two',header:false}];
    
    var res = alasql('SELECT * INTO XLSX("Laporan.xlsx",?) FROM ?',[opts,data1]);
}
  

});


 
</script>



@endsection