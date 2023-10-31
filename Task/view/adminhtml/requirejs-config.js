var config = {
    paths: {
        'jquery': 'jquery/jquery' // Map the 'jquery' module to the actual jQuery file
    },
    shim: {
        'jquery': {
            exports: '$' // Define jQuery as the exported variable
        }
    }
};