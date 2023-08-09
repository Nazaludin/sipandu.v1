<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Pelatihan
                    </div>
                    <h2 class="page-title">
                        Agenda
                    </h2>
                </div>

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card card-round">
                        <div class="card-body">
                            <h4 class="card-title">Detail Pelatihan</h4>
                            <div class="row px-3 justify-content-between">
                                <div class="col-6 mb-4">
                                    <a href="<?= base_url('pelatihan/agenda'); ?>" class="btn btn-outline-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-big-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M20 15h-8v3.586a1 1 0 0 1 -1.707 .707l-6.586 -6.586a1 1 0 0 1 0 -1.414l6.586 -6.586a1 1 0 0 1 1.707 .707v3.586h8a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1z"></path>
                                        </svg>
                                        Back</a>
                                </div>

                            </div>
                            <!-- Comment Row -->
                            <div class="card">
                                <div class="row g-0">
                                    <div class="col-12 col-md-3 border-end">
                                        <div class="card-body">
                                            <h4 class="subheader">Pendaftar Pelatihan</h4>
                                            <div id="container-user" class="list-group list-group-flush list-group-hoverable overflow-auto" style="max-height: 50rem">
                                                <a class="list-group-item list-group-item-action active bg-azure-lt" onclick="getUserCourse()">
                                                    <div class="row align-items-center justify-content-start">
                                                        <div class="col-auto"><span class="badge bg-red"></span></div>
                                                        <div class="col-auto text-truncate">
                                                            <div class="text-reset d-block">Nazaludin Nur Rahmat</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <input type="hidden" id="csrf" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

                                    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
                                    <script>
                                        // $(document).ready(function() {
                                        //     getUserCourse();
                                        // });


                                        function getUserCourse() {
                                            console.log(csrfName, csrfHash);
                                            var csrfName = $('#csrf').attr('name'); // CSRF Token name
                                            var csrfHash = $('#csrf').val(); // CSRF hash

                                            $.post("list-user-course", {
                                                    id_course: <?= json_decode($pelatihan)->courses->id; ?>,
                                                    [csrfName]: csrfHash,
                                                },

                                                function(data) {
                                                    console.log(data);
                                                    // let table = document.getElementById("table-download-dokument");
                                                    let dataJSON = JSON.parse(data);
                                                    console.log(dataJSON.hash);
                                                    // csrfName = data.token;
                                                    $('#csrf').val(dataJSON.hash);
                                                    createUserList(dataJSON.user);
                                                    // generateTableHead(table, data);
                                                    // generateTable(table, dataTable);

                                                });

                                        }

                                        function getUserUploadDocument(id_user) {

                                            $.post("list-user-upload-document", {
                                                    id_course: <?= json_decode($pelatihan)->courses->id; ?>,
                                                    id_user: id_user,
                                                    [csrfName]: csrfHash,
                                                },

                                                function(data) {
                                                    console.log(data);
                                                    // let table = document.getElementById("table-download-dokument");
                                                    // let dataJSON = JSON.parse(data);
                                                    // createUserList(dataJSON);
                                                    // generateTableHead(table, data);
                                                    // generateTable(table, dataTable);

                                                });

                                        }

                                        function doSomething(evt) {
                                            alert(evt.currentTarget.myParam)
                                        }

                                        // add event listener to element 


                                        function createUserList(jsonData) {
                                            jsonData.forEach((item) => {
                                                let container = document.getElementById("container-user");
                                                let a = document.createElement("a");
                                                a.className = "list-group-item list-group-item-action";
                                                a.addEventListener("click", ceateUserDetail, false);
                                                a.id_user = item['id'];
                                                // a.onclick = ceateUserDetail(item['id']);

                                                let div_content = document.createElement("div");
                                                div_content.className = "row align-items-center justify-content-start";

                                                let div1 = document.createElement("div");
                                                div1.className = "col-auto";
                                                let span1 = document.createElement("span");
                                                span1.className = "badge bg-red";
                                                div1.appendChild(span1);

                                                let div2 = document.createElement("div");
                                                div2.className = "col-auto text-truncate";
                                                let div2_inner = document.createElement("div");
                                                div2_inner.className = "text-reset d-block";
                                                console.log(item);
                                                div2_inner.textContent = item['nama'];
                                                div2.appendChild(div2_inner);

                                                div_content.appendChild(div1);
                                                div_content.appendChild(div2);

                                                a.appendChild(div_content);
                                                container.appendChild(a);
                                            });

                                        }

                                        function ceateUserDetail(evt) {
                                            console.log(evt.currentTarget.id_user);
                                            // jsonData.forEach((item) => {
                                            //     let container = document.getElementById("container-user");
                                            //     let a = document.createElement("a");
                                            //     a.className = "list-group-item list-group-item-action";
                                            //     a.onclick = "list-group-item list-group-item-action";

                                            //     let div_content = document.createElement("div");
                                            //     div_content.className = "row align-items-center justify-content-start";

                                            //     let div1 = document.createElement("div");
                                            //     div1.className = "col-auto";
                                            //     let span1 = document.createElement("span");
                                            //     span1.className = "badge bg-red";
                                            //     div1.appendChild(span1);

                                            //     let div2 = document.createElement("div");
                                            //     div2.className = "col-auto text-truncate";
                                            //     let div2_inner = document.createElement("div");
                                            //     div2_inner.className = "text-reset d-block";
                                            //     console.log(item);
                                            //     div2_inner.textContent = item['nama'];
                                            //     div2.appendChild(div2_inner);

                                            //     div_content.appendChild(div1);
                                            //     div_content.appendChild(div2);

                                            //     a.appendChild(div_content);
                                            //     container.appendChild(a);
                                            // });

                                        }


                                        function generateTable(table, jsonData) {
                                            jsonData.forEach((item) => {


                                                // Get the values of the current object in the JSON data
                                                let vals = Object.values(item);
                                                console.log(vals);

                                                let td1 = document.createElement("td");
                                                td1.className = "text-center";
                                                var input = document.createElement("input");
                                                input.type = "checkbox";
                                                input.className = "form-check-input-sm";
                                                td1.appendChild(input);
                                                tr.appendChild(td1);

                                                let td2 = document.createElement("td");
                                                td2.innerText = vals[1];
                                                tr.appendChild(td2);

                                                // Loop through the values and create table cells
                                                // vals.forEach((elem) => {
                                                //     let td = document.createElement("td");
                                                //     td.innerText = elem; // Set the value as the text of the table cell
                                                // Append the table cell to the table row
                                                // });
                                                table.appendChild(tr); // Append the table row to the table
                                            });
                                            container.appendChild(table) // Append the table to the container element
                                        }



                                        function tryParseJSONObject(jsonString) {
                                            try {
                                                var o = JSON.parse(jsonString);
                                                if (o && typeof o === "object") {
                                                    return o;
                                                }
                                            } catch (e) {}

                                            return false;
                                        };
                                    </script>
                                    <div class="col-12 col-md-9 d-flex flex-column">
                                        <div class="card-body">
                                            <h2 class="mb-4">My Account</h2>
                                            <h3 class="card-title">Profile Details</h3>
                                            <div class="row align-items-center">
                                                <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url(./static/avatars/000m.jpg)"></span>
                                                </div>
                                                <div class="col-auto"><a href="#" class="btn">
                                                        Change avatar
                                                    </a></div>
                                                <div class="col-auto"><a href="#" class="btn btn-ghost-danger">
                                                        Delete avatar
                                                    </a></div>
                                            </div>

                                        </div>
                                        <div class="card-footer bg-transparent mt-auto">
                                            <div class="btn-list justify-content-end">
                                                <a href="#" class="btn">
                                                    Cancel
                                                </a>
                                                <a href="#" class="btn btn-primary">
                                                    Submit
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- END tab pane ringkasan -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Recent comment and chats -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->