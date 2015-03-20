var app = app || {};

app.bustCache = function(alreadyInQueryString) {
  var string;
  if( alreadyInQueryString ) {
    string = '&';
  } else {
    string = '?';
  }
  return string+'bustcache='+(new Date()).getTime();
};

app.showBtn = function(route, remote, wide) {
  var link = '<a';

  if (remote) {
    if (wide) {
      link += ' data-reveal-id="remoteModalWide"';
    } else {
      link += ' data-reveal-id="remoteModal"';
    }
    link += ' data-reveal-ajax="'+route+'"';
  } else {
    link += ' href="'+route+'"';
  }

  link += ' class="button radius success tiny">';
  link += '<i class="fi-eye ';

  link += 'tooltips" data-original-title="View" title="View"> </i></a> ';

  return link;
}

app.editBtn = function(route, remote, wide) {
  var link = '<a';

  if (remote) {
    if (wide) {
      link += ' data-reveal-id="remoteModalWide"';
    } else {
      link += ' data-reveal-id="remoteModal"';
    }
    link += ' data-reveal-ajax="'+route+'"';
  } else {
    link += ' href="'+route+'"';
  }

  link += ' class="button radius success tiny">';
  link += '<i class="';

  if (remote) {
    link += 'fi-pencil ';
  } else {
    link += 'fi-magnifying-glass ';
  }

  link += ' tooltips" data-original-title="Edit" title="Edit"> </i></a> ';

  return link;
}

app.deleteBtn = function(route, csrf, removeNotDelete) {
  var icon = removeNotDelete ? 'archive' : 'trash';
  var message = removeNotDelete
    ? 'Are you sure you want to remove from this year\\\'s campaign?'
    : 'Are you sure you want to delete?';

  var form = '<form method="POST" action="'+route+'" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE">';
  form +=    '<input name="_token" type="hidden" value="'+csrf+'">';
  form +=    '<button onclick="return confirm(\''+message+'\')" class="button radius alert tiny" type="submit">';
  form +=    '<i class="fi-'+icon+' tooltips" data-original-title="Delete" title="Delete"> </i></button> ';
  form +=    '</form>';
  return form;
}

app.noCascadeDeleteBtn = function( modelName, childModelName, warning, removeNotDelete ) {
  var icon = removeNotDelete ? 'archive' : 'trash';
  var action = removeNotDelete ? 'archive' : 'delete';
  var message = 'Cannot '+action+' this '+modelName+' because it has non-cancelled '
    + childModelName + ' records under it. Please cancel all '+childModelName
    + ' records and then '+action+' the '+modelName+'. '+warning;

  return '<button class="button radius alert tiny" onclick=\'return alert("'+message+'")\'><i class="fi-'+icon+' tooltips" data-original-title="Delete" title="Delete"> </i></button>';
}

app.addBtn = function(route, csrf, attrs) {
  var form = '<form method="POST" action="'+route+'" accept-charset="UTF-8">';
  form +=    '<input name="_token" type="hidden" value="'+csrf+'">';
  if( attrs ) {
    $.each( attrs, function(key, value) {
      form += '<input type="hidden" name="'+key+'" value="'+value+'">';
    });
  }
  form +=    '<button class="button radius success tiny" type="submit">';
  form +=    '<i class="fi-plus tooltips" data-original-title="Add" title="Add"> </i></button> ';
  form +=    '</form>';
  return form;
}

app.grayCancelled = function( model, field ) {
  var value = model.get(field);
  if( 'cancelled' == model.get('status') ) {
    return '<span class="text-muted">'+value+'</span>';
  } else {
    return value;
  }
}

/**
 * Load JSON saved into an "application/json" script tag by the server-
 * side code.
 *
 * @require jQuery
 * @require underscore.js
 */
function load_json( id ) {
  return JSON.parse(_.unescape($('#'+id).text()));
}
