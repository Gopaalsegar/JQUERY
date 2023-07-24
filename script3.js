function MyViewModel(){
    this.numb1= ko.observable();
    this.numb2= ko.observable();
    this.average = ko.computed(function(){
        if(typeof(this.numb1()) !== "number" || typeof(this.numb2()) !== "number") {
            this.numb1(Number(this.numb1()));
            this.numb2(Number(this.numb2()));
    }
    avg=(this.numb1()+this.numb2())/2;
    return avg;
},this);
}
ko.applyBindings(new MyViewModel());