 $(document).ready(function() {
  // Bootstrap datepicker

  $('.input-daterange input').each(function() {

    $(this).datepicker('clearDates');
  });

  // Extend dataTables search
  $.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
    var min = $('#min').val();
    var max = $('#max').val();
    var createdAt = data[1] || 1; // Our date column in the table

    if (
      (min == "" || max == "") ||
      (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
    ) {
      return true;
    }
    return false;
    }
  );

  // Re-draw the table when the a date range filter changes
  $('.date-range-filter').change(function() {
    var table = $('#example23').DataTable();
    table.draw();
  });


  $('.date-range-filter').datepicker();
});