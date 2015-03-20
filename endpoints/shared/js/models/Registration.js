var app = app || {};

app.Registration = Backbone.Model.extend({});

app.RegistrationCollection = Backbone.Collection.extend({
  model: app.Registration,
  initialize: function( occUid ) {
    this.occUid = occUid;
    // this.fetch({reset:true});
  },
  url: function() {
    return app.baseUrl
      + '/registrations'
      + ( this.occUid ? '?occ='+this.occUid : '' )
      + app.bustCache(this.occUid);
  },
  parse: function(response) {
    return response.models;
  }
});
