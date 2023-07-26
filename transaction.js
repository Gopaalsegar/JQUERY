require.config({
    paths: {
      'knockout': 'https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest',
    },
  });
  require(['knockout'], function (ko) {

    function Transaction(date, type, amount) {
        this.date = date;
        this.type = type;
        this.amount = amount;
    }

    function AccountViewModel() {
        var self = this;

        self.accountBalance = ko.observable(0);
        self.transactionAmount = ko.observable();
        self.transactions = ko.observableArray([]);

        self.init = function() {
            var accNum = localStorage.getItem("accNum");
            var accNum1 = JSON.parse(accNum);
            var acctBalance = parseFloat(localStorage.getItem(accNum1));

            self.accountBalance(acctBalance);

            if (localStorage.getItem('transactions')) {
                var transactions = JSON.parse(localStorage.getItem('transactions'));
                var accountTransactions = transactions.filter(function(transaction) {
                    return transaction.accountNumber === accNum1;
                });

                accountTransactions.forEach(function(transaction) {
                    self.transactions.push(new Transaction(transaction.date, transaction.type, transaction.amount));
                });
            }
        };

        self.credit = function() {
            var amount = parseFloat(self.transactionAmount());
            var acctBalance = parseFloat(self.accountBalance());
            console.log(typeof(amount));
            // if (acctBalance + amount < 0 && amount <= 0) {
            //     console.log(typeof(amount));
            //     alert('Not a valid transaction');
            //     return;
            // } else {
            //     acctBalance += amount;
            //     self.updateAccountBalance(acctBalance);
            //     self.savetran('Credit', amount);
            // }
            if (amount < 0) {
                alert('Negative amount not allowed for credit.');
                return;
            }
        
            if (acctBalance + amount < 0) {
                alert('Not a valid transaction');
            } else {
                acctBalance += amount;
                self.updateAccountBalance(acctBalance);
                self.savetran('Credit', amount);
            }
        };

        self.debit = function() {
            var amount = parseFloat(self.transactionAmount());
            var acctBalance = parseFloat(self.accountBalance());

            // if (acctBalance - amount < 0) {
            //     if (amount < 0) {
            //         alert('Negative number not allowed');
            //     }
            //     alert('Not enough money in your account');
            // } else {
            //     acctBalance -= amount;
            //     self.updateAccountBalance(acctBalance);
            //     self.savetran('Debit', amount);
            // }
            if (amount < 0) {
                alert('Negative amount not allowed for debit.');
                return;
            }
        
            if (acctBalance - amount < 0) {
                alert('Not enough money in your account');
            } else {
                acctBalance -= amount;
                self.updateAccountBalance(acctBalance);
                self.savetran('Debit', amount);
            }
        };

        self.updateAccountBalance = function(balance) {
            localStorage.setItem('accountBalance', balance);
            self.accountBalance(balance);
            var accNum1 = JSON.parse(localStorage.getItem("accNum"));
            localStorage.setItem(accNum1, balance);
        };

        self.savetran = function(type, amount) {
            var transactions = [];

            if (localStorage.getItem('transactions')) {
                transactions = JSON.parse(localStorage.getItem('transactions'));
            }

            var accNum1 = JSON.parse(localStorage.getItem("accNum"));
            var transaction = {
                accountNumber: accNum1,
                date: new Date().toLocaleString(),
                type: type,
                amount: amount
            };

            transactions.push(transaction);
            localStorage.setItem('transactions', JSON.stringify(transactions));
            self.transactions.push(new Transaction(transaction.date, transaction.type, transaction.amount));
        };

        self.init();
    }

    // Apply Knockout bindings to the view model
    var viewModel = new AccountViewModel();
    ko.applyBindings(viewModel);
  });
