require.config({
    paths: {
        'knockout': 'knockout',
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
        self.validateForm = function () {
            var name = /^[A-Z]{1}[a-z]+$/;
            var email = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.((com)|(in)|(co\.in))$/;
            var Pass = /^[A-Za-z0-9+]{8,15}$/;
            var acc = /^[0-9]{9,18}$/;
            if (!name.test(self.userName())) {
                alert('Please enter a valid first name.');
                return false;
            }
            if (!acc.test(self.accNum())) {
                alert('Please enter a valid account.');
                return false;
            }

            if (!email.test(self.emailId())) {
                alert('Please enter a valid email address.');
                return false;
            }
            if (!Pass.test(self.passWord())) {
                alert('Password must contain 8 to 15 characters with at least one uppercase, lowercase, and digits');
                return false;
            }
            return true;
        };
        //Pushing userdata to local storage and checking uniqueness of account number
        self.registerUser = function () {
            if (self.validateForm()) {

                console.log('got validated')
                var existingData = localStorage.getItem('userData');
                var userData = [];

                if (existingData) {
                    userData = JSON.parse(existingData);

                    // To check whether account number is unique or not.
                    var accountExists = userData.some(function (item) {
                        return item.accNum === self.accNum();
                    });

                    if (accountExists) {
                        alert('Account number already exists. Please enter a unique account number.');
                        return;
                    }
                }

                userData.push({
                    userName: self.userName(),
                    accNum: self.accNum(),
                    emailId: self.emailId(),
                    Password: self.passWord(),

                });
                localStorage.setItem('userData', JSON.stringify(userData));
                Object.keys(localStorage).forEach(function (key) {
                    if (!(accNum in localStorage.key)) {
                        localStorage.setItem("accountBalance", 0);
                    }
                });

                localStorage.setItem('userData', JSON.stringify(userData));

                self.loginButton();
            }
        };

        self.loginButton = function () {
            window.location.href = 'login.html';
        };
    }
    ko.applyBindings(new AppViewModel());
});



