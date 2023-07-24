function Product(name, price, imageUrl) {
    this.name = name;
    this.price = price;
    this.imageUrl = imageUrl;
}

function ProductListViewModel() {
    var self = this;

    // Observable array to hold the list of products
    self.products = ko.observableArray([
        new Product("Iphone 14",100000, "iphone-14.jpg"),
        new Product("Product 2", 20, "samsung.webp"),
        new Product("Product 3", 30, "mi.jpg"),
    ]);
    }

   


// Apply the bindings
ko.applyBindings(new ProductListViewModel());