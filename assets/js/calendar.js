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
      events: [ 
      ]
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
