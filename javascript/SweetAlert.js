var loc = document.location;
var cancel = $('.Cancel');

function swetCancel(canceltitle) {
    var modal = $('#' + canceltitle);
    var backdrop = $('.modal-backdrop');

    Swal.fire({
        title: 'Are you sure?',
        text: "Sure for Cancel this?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Cancel it!'
      }).then((result) => {
        if (result.isConfirmed) {
            modal.removeClass('show');
            modal.attr("style", "display:none;");
            backdrop.remove();
            // cancelRefresh();
            resetData();
        }
    })
}

function swetConfirm(canceltitle) {
    var modal = $('#' + canceltitle);

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        //   window.location.reload();
        }
    })
}

async function alert(title, message, icon) {
    Swal.fire({
        icon: icon,
        title: title,
        text: message,
        showConfirmButton: true,
        confirmButtonColor: '#3085d6',
        timer: 2000
    });
}