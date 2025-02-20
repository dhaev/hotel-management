 jQuery.noConflict();
 jQuery(document).ready(function($) {
    $('#example23').DataTable( {
        columnDefs: [ {
            targets: [ 1 ],
            orderData: [ 0, 1 ]
        }, {
            targets: [ 1 ],
            orderData: [ 1, 0 ]
        }, {
            targets: [ 11 ],
            orderData: [ 11, 0 ]
        } ]
    } );
} );