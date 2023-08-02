  require(['knockout'], function (ko) {
    function AppViewModel(){
        var userData = localStorage.getItem('userData');
        userData = JSON.parse(userData);
        this.emailId = ko.observable();
        this.passWord = ko.observable();

        // To check the user data, whether it is available in local storage.
        this.submitButton = function () {
            var user = userData.find(function (user) {
                return user.emailId === this.emailId() && user.Password === this.passWord();
            }, this);
        
            if (user) {
                localStorage.setItem('newData', JSON.stringify(user));
                localStorage.setItem('accNum', JSON.stringify(user.accNum));
                localStorage.setItem('name', JSON.stringify(user.userName));
                redirectToHome();
            } else {
                alert('Please enter a valid email address or password');
            }
        }
        // Once verified it redirects to home page
        function redirectToHome() {
            window.location.href = 'home.html';
        }
        
    }
    self.newUserlog = function() {
            window.location.href = 'index.html';
        };
    ko.applyBindings(new AppViewModel());
  });