require.config({
    paths: {
      'knockout': 'https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest',
    },
  });
  require(['knockout'], function (ko) {
    function AppViewModel(){
        var userData = localStorage.getItem('userData');
        userData = JSON.parse(userData);
        var matched = false;
        this.emailId= ko.observable();
        this.passWord= ko.observable();
        this.submitButton = function(){
            for (var i = 0; i < userData.length; i++) {
                var user = userData[i];
                if (user.emailId === this.emailId() && user.Password === this.passWord()) {
                    matched = true;
                    localStorage.setItem('newData', JSON.stringify(user))
                    localStorage.setItem('accNum', JSON.stringify(user.accNum))
                    localStorage.setItem('name', JSON.stringify(user.userName))
                    break;
                }
            }
            if (matched) {
                window.location.href = 'home.html';
            } else {
                $('.error-message').text('Invalid email or password.');
            }
        }
    }
    self.newUserlog = function() {
            window.location.href = 'registrstion.html';
        };
    ko.applyBindings(new AppViewModel());
  });