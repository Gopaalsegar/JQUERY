require.config({
    paths: {
      'knockout': 'https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest',
    },
  });
  require(['knockout'], function (ko) {
    function AppViewModel() {
        var self = this;

        // Observable variables to store data
        self.loggedInUser = ko.observable(''); // Will store "Logged in as: name"
        self.accounts = ko.observableArray([]);

        
        // Get data from localStorage 
        var acc = localStorage.getItem('accNum');
        var acc1 = JSON.parse(acc);
        var bal = localStorage.getItem("accountBalance");
        var found = false;


        for (var i = 0; i < localStorage.length; i++) {
            var key = localStorage.key(i);
            if (key === acc1) {
                found = true;
                break;
            }
        }

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