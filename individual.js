require.config({
    paths: {
      'knockout': 'https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest',
    },
  });
  require(['knockout'], function (ko) {
    function AppViewModel() {
        var self = this;

        self.userName = ko.observable();
        self.accNum = ko.observable();
        self.emailId = ko.observable();
        self.passWord = ko.observable();
        

        // Function to perform form validation
        self.validateForm = function() {
            var name = /^[A-Z]{1}[a-z]+$/;
            var email = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.((com)|(in)|(co\.in))$/;
            var Pass = /^[A-Za-z0-9+]{8,15}$/;
           

            if (!name.test(self.userName())) {
                alert('Please enter a valid first name.');
                return false;
            }

            // if (!name.test(self.lastName())) {
            //     alert('Please enter a valid Last name.');
            //     return false;
            // }

            if (!email.test(self.emailId())) {
                alert('Please enter a valid email address.');
                return false;
            }

            // if (!Pass.test(self.passWord())) {
            //     alert('Password must contain 8 to 15 characters with at least one uppercase, lowercase, and digits');
            //     return false;
            // }

          

            return true;
        };

        self.registerUser = function() {
            if (self.validateForm()) {

                console.log('got validated')
                var existingData = localStorage.getItem('userData');
                var userData = [];

                if (existingData) {
                    userData = JSON.parse(existingData);
                    for (var i = 0; i < userData.length; i++) {
                        if (userData[i].accNum == self.accNum()) {
                            alert('Account number already exists. Please enter a unique account number.');
                            return ;
                        }
                }
                }

                userData.push({
                    userName: self.userName(),
                    accNum: self.accNum(),
                    emailId: self.emailId(),
                    Password: self.passWord(),
                   
                });
                localStorage.setItem('userData', JSON.stringify(userData));
                for (var i = 0; i < localStorage.length; i++){
                    if(!(accNum in localStorage.key)){
                        localStorage.setItem("accountBalance",0);
                    }
                }

                localStorage.setItem('userData', JSON.stringify(userData));

                self.loginButton();
            }
        };

        self.loginButton = function() {
            window.location.href = 'login.html';
        };
    }
    ko.applyBindings(new AppViewModel());
});



