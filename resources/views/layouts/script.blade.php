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

    document.addEventListener("DOMContentLoaded", function() {
        const menuOpen = document.getElementById('menuOpen');
        const menuClose = document.getElementById('menuClose');
        const sidebar = document.getElementById('sidebar');
        const header = document.getElementById('mainHeader');
        const footer = document.getElementById('mainFooter');
        const main = document.querySelector('.main-container');

        menuOpen.addEventListener('click', () => {
            sidebar.classList.add('collapsed');
            header.classList.add('collapsed');
            footer.classList.add('collapsed');
            main.classList.add('collapsed');

            menuOpen.classList.add('d-none');
            menuClose.classList.remove('d-none');
        });


        menuClose.addEventListener('click', () => {
            sidebar.classList.remove('collapsed');
            header.classList.remove('collapsed');
            footer.classList.remove('collapsed');
            main.classList.remove('collapsed');

            menuClose.classList.add('d-none');
            menuOpen.classList.remove('d-none');
        });
    });

    document.addEventListener("DOMContentLoaded", function() {

        function setInvalid(input, message) {
            input.classList.remove("is-valid");
            input.classList.add("is-invalid");

            let error = input.parentElement.querySelector(".invalid-feedback");
            if (error) error.innerText = message;
        }

        function setValid(input) {
            input.classList.remove("is-invalid");
            input.classList.add("is-valid");

            let error = input.parentElement.querySelector(".invalid-feedback");
            if (error) error.innerText = "";
        }

        function clearState(input) {
            input.classList.remove("is-valid");
            input.classList.remove("is-invalid");

            let error = input.parentElement.querySelector(".invalid-feedback");
            if (error) error.innerText = "";
        }

        document.querySelectorAll("input, textarea, select").forEach(function(input) {

            input.addEventListener("input", function() {
                const value = this.value.trim();
                const isRequired = this.hasAttribute("required");


                if (isRequired) {
                    if (value === "") {
                        setInvalid(this, "This field is required");
                    } else {
                        setValid(this);
                    }
                } else {
                    if (value === "") {
                        clearState(this);
                    } else {
                        setValid(this);
                    }
                }
            });

        });

    });
</script>
