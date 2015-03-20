var app = app || {};

app.AttributeValue = Backbone.Model.extend({});

app.AttributeValueCollection = Backbone.Collection.extend({
  model: app.AttributeValue,
  initialize: function( attrUid, type ) {
    this.attrUid = attrUid;
    // this.fetch({reset:true});
  },
  url: function() {
    return app.baseUrl + '/attribute-values?attr='+this.attrUid+app.bustCache(true);
  },
  parse: function(response) {
    return response.models;
  }
});
