$(document).ready(function() {


   
    $('.cliente_modal').select2({
      dropdownParent: $('#criarServico')
    });
    $('.tipo_servico_modal').select2({
      dropdownParent: $('#criarServico')
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
            url: 'http://localhost:3000/sistema_guto/index.php/Servico/get_json',
            dataType: 'json',
            type:'post',
            data: {
                
            },
            success: function(doc) {
                var events = [];
               
                doc.forEach(function(r){
                  events.push({
                    id: r.id_servico,
                    title: r.nome_servico,
                    start: r.data_inicio_servico,
                    end: r.data_vencimento_servico
                  });
                });
             
              callback(events);
            }
        });
    }
      
      
      
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
