require.config({
  paths: {
    'knockout': 'knockout',
  },
});
require(['knockout'], function (ko) {
  function AppViewModel() {
    var self = this;

    // Observable variables to store data
    self.loggedInUser = ko.observable(''); 
    self.accounts = ko.observableArray([]);


    // Get data from localStorage 
    var acc = localStorage.getItem('accNum');
    var acc1 = JSON.parse(acc);
    var bal = localStorage.getItem("accountBalance");
    var found = false;

    Object.keys(localStorage).forEach(function (key) {
      if (key === acc1) {
        found = true;
        return; 
      }
    });

    if (!found) {
      localStorage.setItem(acc1, bal);
    }


    // Set the "Logged in as" message
    var name = localStorage.getItem('name');
    self.loggedInUser('Logged in as: ' + name);
  }

  // Apply the Knockout bindings
  var viewModel = new AppViewModel();
  ko.applyBindings(viewModel);
});