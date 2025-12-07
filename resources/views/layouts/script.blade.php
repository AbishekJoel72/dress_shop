<!-- Modal -->
<div class="modal fade" id="sessionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-3">
            <div class="modal-body">
                <h5 id="modalMessage"></h5>
                <button type="button" class="btn btn-primary mt-3" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if (session('success'))
            document.getElementById("modalMessage").innerText = "{{ session('success') }}";
            document.querySelector("#sessionModal .modal-content").classList.add("border-success");
            var myModal = new bootstrap.Modal(document.getElementById('sessionModal'));
            myModal.show();
        @endif

        @if (session('error'))
            document.getElementById("modalMessage").innerText = "{{ session('error') }}";
            document.querySelector("#sessionModal .modal-content").classList.add("border-danger");
            var myModal = new bootstrap.Modal(document.getElementById('sessionModal'));
            myModal.show();
        @endif
    });
</script>
