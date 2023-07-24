function EmployeeModel() {
    this.empName = ko.observable("");
    this.chosenItem = ko.observableArray("");
    this.empArray = ko.observableArray(['Scott','James','Jordan','Lee', 'RoseMary','Kathie']);  //Initial Values
    
    this.addEmp = function() {
       
       if (this.empName() != "") {
          this.empArray.push(this.empName());    //insert accepted value in array
          this.empName("");
       }
    }.bind(this);
 }
 

 ko.applyBindings( new EmployeeModel());