var app = app || {};

app.Participant = Backbone.Model.extend({});

app.ParticipantCollection = Backbone.Collection.extend({
  model: app.Participant,
  initialize: function( regUid ) {
    this.regUid = regUid;
    // this.fetch({reset:true});
  },
  url: function() {
    return app.baseUrl
      + '/participants?'
      + ( this.regUid ? 'registration='+this.regUid : '' )
      + '&' + app.bustCache(false);
  },
  parse: function(response) {
    return response.models;
  }
});
