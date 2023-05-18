</main>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-center small">
            <div class="text-muted">Copyright &copy; Atep Sutisna 2023</div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="/js/scripts.js"></script>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tabel').DataTable({
            "lengthMenu": [
                [5, 25, 50, -1],
                [5, 25, 50, "All"]
            ]
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#checkAll').change(function() {
            const isChecked = $(this).is(':checked');
            $('input[id^="check"]').prop('checked', isChecked);
        });

        $('input[id^="check"]').change(function() {
            const totalCheckboxes = $('input[id^="check"]').length;
            const checkedCheckboxes = $('input[id^="check"]:checked').length;

            $('#all').prop('checked', totalCheckboxes === checkedCheckboxes);
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('.show_confirm').click(function(event) {
        let form = $(this).closest("form");
        let name = $(this).data("name");
        event.preventDefault();

        Swal.fire({
            title: 'Are you sure ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@if (session()->has('message'))
    <script>
        Swal.fire({
            icon: "success",
            showCancelButton: true,
            cancelButtonText: 'Ok',
            cancelButtonColor: '#3085d6',
            title: 'Success',
            text: '{{ session('message') }}',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif
@if (session()->has('error'))
    <script>
        Swal.fire({
            icon: "error",
            showCancelButton: true,
            cancelButtonText: 'Ok',
            cancelButtonColor: '#3085d6',
            title: 'Failed',
            text: "{{ session('error') }}",
            showConfirmButton: false,
            // timer: 1500
        })
    </script>
@endif
</body>

</html>
