var app = app || {};

app.Attribute = Backbone.Model.extend({});

app.AttributeCollection = Backbone.Collection.extend({
  model: app.Attribute,
  initialize: function( orgUid, type ) {
    this.setOrgUid(orgUid);
  },
  url: function() {
    return app.baseUrl + '/attributes?org='+this.orgUid+'&type='+this.type+app.bustCache(true);
  },
  parse: function(response) {
    return response.models;
  },
  setOrgUid: function( orgUid ) {
    this.orgUid = orgUid;
    if( this.orgUid ) {
      // this.fetch({reset:true});
    } else {
      this.parse({models:[]});
      this.reset();
    }
  }
});
