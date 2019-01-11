$(document).ready(function() {


    $('.client_modal').select2({
      dropdownParent: $('#criarServico')
    });



    // Call Ajax to get JSON and populate select with places

    $.ajax({
      url: "http://localhost:8080/sistema_guto/index.php/Service/get_json_places",
      dataType: 'json',
      success: function (data) {
          var option = "";
          $.each(data, function(index, item){
            (index === 0) ? option += '<option value="'+item.place_id+'" selected>'+item.place_name+'</option>' : option += '<option value="'+item.place_id+'">'+item.place_name+'</option>';
          });
          $('#place').html(option).show();
          $.ajax({
            url: "http://localhost:8080/sistema_guto/index.php/Service/get_json_service_type/1",
            dataType: 'json',
            success: function (data) {
                var option = "";
                $.each(data, function(index, item){
                  (index === 0) ? option += '<option value="'+item.service_type_id+'" selected>'+item.service_type_description+'</option>' : option += '<option value="'+item.service_type_id+'">'+item.service_type_description+'</option>';
                });
                $('#service_type').html(option).show();
                
                $.ajax({
                  url: "http://localhost:8080/sistema_guto/index.php/Service/get_json_equipment/1",
                  dataType: 'json',
                  success: function (data) {
                      var option = "";
                      $.each(data, function(index, item){
                        (index === 0) ? option += '<option value="'+item.equipment_id+'" selected>'+item.equipment_name+'</option>' : option += '<option value="'+item.equipment_id+'">'+item.equipment_name+'</option>';
                      });
                      $('#equipment').html(option).show();
                      
                  }
                });
            }
          });
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

    // Get Change on select box to display selection of days or not
    
    $('#dias_1').change(function(){
      $('#dias_semana').css("display", "none");
    });
    $('#dias_2').change(function(){
      $('#dias_semana').css("display", "block");
    });
    $('#dias_3').change(function(){
      $('#dias_semana').css("display", "block");
    });    

    // Get change on place field to load services

    $('#place').change(function(e){
     // console.log(this.value);
      let id = this.value;
      $.ajax({
        url: "http://localhost:8080/sistema_guto/index.php/Service/get_json_service_type/"+id,
        dataType: 'json',
        success: function (data) {
            var option = "";
            if(data.length === 0){
              option += '<option selected="selected" disabled="true"> Não existem serviços disponíveis.</option>';
            }
            else{
              $.each(data, function(index, item){
                (index === 0) ? option += '<option value="'+item.service_type_id+'" selected>'+item.service_type_description+'</option>' : option += '<option value="'+item.service_type_id+'">'+item.service_type_description+'</option>';
              });
            } 
            $('#service_type').html(option).show();
            
            $.ajax({
              url: "http://localhost:8080/sistema_guto/index.php/Service/get_json_equipment/"+id,
              dataType: 'json',
              success: function (data) {
                  var option = "";
                  if(data.length === 0){
                    option += '<option selected="selected" disabled="true"> Não existem equipamentos disponíveis.</option>';
                  }
                  else{
                    $.each(data, function(index, item){
                      (index === 0) ? option += '<option value="'+item.equipment_id+'" selected>'+item.equipment_name+'</option>' : option += '<option value="'+item.equipment_id+'">'+item.equipment_name+'</option>';
                    });
                  } 
                  
                  $('#equipment').html(option).show();
                  
              }
            });
        }
      });
    });

    $('#service_type').change(function(e){
      // console.log(this.value);
       let id = this.value;
       $.ajax({
         url: "http://localhost:8080/sistema_guto/index.php/Service/get_json_service_type/"+id,
         dataType: 'json',
         success: function (data) {
             var option = "";
             if(data.length === 0){
               option += '<option selected="selected" disabled="true"> Não existem serviços disponíveis.</option>';
             }
             else{
               $.each(data, function(index, item){
                 (index === 0) ? option += '<option value="'+item.service_type_id+'" selected>'+item.service_type_description+'</option>' : option += '<option value="'+item.service_type_id+'">'+item.service_type_description+'</option>';
               });
             } 
             $('#service_type').html(option).show();
         }
       });
     });
    
  });
