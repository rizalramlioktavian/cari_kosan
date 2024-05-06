window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
        $(this).remove();
    });
}, 5000);

function deleteData(dataId) {
    Swal.fire({
        title: "Apakah kamu yakin ingin menghapus data ini?",
        text: "Data ini tidak akan bisa dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            $("#deleteForm-" + dataId).submit();
        }
    });
}
