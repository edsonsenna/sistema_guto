$(document).ready(function() {


   
    $('.client_modal').select2({
      dropdownParent: $('#criarServico')
    });
    $('.service_type_modal').select2({
      dropdownParent: $('#criarServico')
    });
    $('.place_modal').select2({
      dropdownParent: $('#criarServico'),
      ajax: {
        url: "http://localhost:8080/sistema_guto/index.php/Service/get_json_places",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term // search term
            };
        },
        processResults: function (data) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            console.log(data);
            var newArr = [];
            $.each(data, function(index, item){
              newArr.push({
                'id': item.place_id,
                'text': item.place_name
              });
            });
            console.log(newArr);
            return {
                results: newArr
            };
        },
        cache: true
      }
    });

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
      defaultDate: new Date(),
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      dayClick: function(date, jsEvent, view){
        $('#cadastro').css("display", "block");
        $('#criarServico #dia').text(date);
        $('#criarServico #criarServicoTitle').text('Criar Serviço - ' + date.format('DD-MM-YYYY'));
        document.getElementById('dia').value = date.format('YYYY-MM-DD');
        $('#criarServico').modal('show');
        
      
      },
      events: function(start, end, timezone, callback) {
        $.ajax({
            url: 'http://localhost:8080/sistema_guto/index.php/Service/get_json',
            dataType: 'json',
            type:'post',
            data: {
                
            },
            success: function(doc) {
                var events = [];
               
                doc.forEach(function(r){
                  events.push({
                    id: r.service_id,
                    title: r.service_name,
                    start: r.service_start_date,
                    end: r.service_end_Date,
                    color: r.service_color
                  });
                });
             
              callback(events);
            }
        });
    }
 
    });

    $('#place').on("select2:close", function (e) {

      let placeEl = document.getElementById('place');
      let serviceTypeEl = document.getElementById('service_type');
      var data = "";
      console.log(e);
      $.ajax({
        url: 'http://localhost:8080/sistema_guto/index.php/Service/get_service_type_json/',
        type:'GET',
        success: function(response) {
            data = response;
            return response;
        }
      });
      $('.service_type_modal').select2({

        dropdownParent: $('#criarServico')
      });
      console.log(data);
    });
    
    $('#dias_1').change(function(){
      $('#dias_semana').css("display", "none");
    });
    $('#dias_2').change(function(){
      $('#dias_semana').css("display", "block");
    });
    $('#dias_3').change(function(){
      $('#dias_semana').css("display", "block");
    });    

    
  });
