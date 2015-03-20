var app = app || {};

app.updateStateFieldShown = function(prefix) {
  if(!prefix) {
    prefix = '';
  }

  // hide all state fields
  $('.'+prefix+'state').parent().parent().hide();

  // reset name of currently-shown state field
  if( ($state = $('[name='+prefix+'state]')).length ) {
    $state.attr('name',$state[0].id);
  }

  // show new state field
  switch( $('#'+prefix+'country').val() ) {
    case 'US':
      $('#'+prefix+'state_us').parent().parent().show();
      $('#'+prefix+'state_us').attr('name',prefix+'state');
      break;
    case 'CA':
      $('#'+prefix+'state_canada').parent().parent().show();
      $('#'+prefix+'state_canada').attr('name',prefix+'state');
      break;
    default:
      $('#'+prefix+'state_other').parent().parent().show();
      $('#'+prefix+'state_other').attr('name',prefix+'state');
  }
};
