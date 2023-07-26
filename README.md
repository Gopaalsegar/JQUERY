# Requirement
-Create a joint account and Individual account in a Bank using localStorage.
-When credit and debit happens in one account it has to be reflected in the other joint account as well.
-Credit and debit also carries in individual account.
-Transaction history according to account number should be carried.
# Solution
- Seperate user login page for Joint account and Individual account by select from main.html
- registrstion.html is used for Joint account registration.
- individual.html is used for individual account registration.
- Registering as a joint account and individual account user, the userData will get stored in local storage.
- By using that userData the user can able to login to the home page i.e., home.html.
- home.html shows the name of the logged user and bbutton to transaction page.
- transaction.html carries credit and debit operation and displays account balance and transaction history.

# Registration
- validation for the user name, password and account number.
- If the userData is not avalable in the local storage it will create the userData in local storage to store all the data.
- If userData is already available, then is push th new data with the existing data in the userData.
- If the account number is new, account balanace will be 0.
- all above will be same for both joint and individual account.
- If account number is already available use the existing balance according to the balance. Because it is joint account so account can be already available.
- If the account number is already existy it shows alert for user in the individual account registration.

# Login
- Login will be carried by using email address and password.

# Transaction
- credit will add amount, debit will subtract amount in account balance and store in local stroage with account number, date and type of transaction.
- Account number and balance will store seperately.


