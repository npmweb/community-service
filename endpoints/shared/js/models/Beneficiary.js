var app = app || {};

app.Beneficiary = Backbone.Model.extend({});

app.BeneficiaryCollection = Backbone.Collection.extend({
  model: app.Beneficiary,
  initialize: function( criteria ) {
    this.setCriteria(criteria);
  },
  url: function() {
    var url = app.baseUrl + '/beneficiaries?'
      + (this.criteria ? $.param(this.criteria) : '')
      + app.bustCache(true);
    return url;
  },
  parse: function(response) {
    return response.models;
  },
  setCriteria: function( criteria ) {
    this.criteria = criteria;
    if( this.criteria ) {
      this.fetch({reset:true});
    } else {
      this.parse({models:[]});
      this.reset();
    }
  }
});
