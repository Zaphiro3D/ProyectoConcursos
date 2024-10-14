
<div class="container-xxl">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Nuevo Agente</h4>
        </div>
    </div>

    <!-- General Form -->
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Input Type</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form>
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Text</label>
                                    <input type="text" id="simpleinput" class="form-control">
                                </div>
                                    <div class="mb-3">
                                    <label for="example-email" class="form-label">Email</label>
                                    <input type="email" id="example-email" name="example-email" class="form-control" placeholder="Email">
                                </div>

                                <div class="mb-3">
                                    <label for="example-password" class="form-label">Password</label>
                                    <input type="password" id="example-password" class="form-control" value="password">
                                </div>

                                <div class="mb-3">
                                    <label for="example-palaceholder" class="form-label">Placeholder</label>
                                    <input type="text" id="example-palaceholder" class="form-control" placeholder="placeholder">
                                </div>

                                <div class="mb-3">
                                    <label for="example-textarea" class="form-label">Text area</label>
                                    <textarea class="form-control" id="example-textarea" rows="5" spellcheck="false"></textarea>
                                </div> 

                                <div class="mb-3">
                                    <label for="example-disable" class="form-label">Readonly</label>
                                    <input class="form-control" type="text" value="Readonly input here..." aria-label="readonly input example" readonly>
                                </div>

                                <div>
                                    <label for="example-disable" class="form-label">Disabled</label>
                                    <input type="text" class="form-control" id="example-disable" disabled="" value="Disabled value">
                                </div>

                            </form>
                        </div>

                        <div class="col-lg-6">
                            <form>
                                <div class="mb-3">
                                    <label for="example-select" class="form-label">Input Select</label>
                                    <select class="form-select" id="example-select">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Disabled</label>
                                    <select id="simpleinput" class="form-select" aria-label="Default select example">
                                        <option selected>Select Menu</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleColorInput" class="form-label">Color picker</label>
                                    <input type="color" id="exampleColorInput" value="#563d7c" title="Choose your color" class="form-control form-control-color">
                                </div>

                                <div class="mb-3">
                                    <label for="example-date" class="form-label">Date</label>
                                    <input type="date" id="example-date" class="form-control" name="date">
                                </div>

                                <div class="mb-3">
                                    <label for="example-multiselect" class="form-label">Multiple Select</label>
                                    <select id="example-multiselect" multiple class="form-control">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="example-custom" class="form-label">Button With Dropdowns</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="example-custom" aria-label="Text input with dropdown button">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#">Separated link</a></li>
                                        </ul>
                                        </div>
                                </div>

                                <div>
                                    <label for="exampleDataList" class="form-label">Datalist example</label>
                                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                                    <datalist id="datalistOptions">
                                        <option value="San Francisco">
                                        <option value="New York">
                                        <option value="Seattle">
                                        <option value="Los Angeles">
                                        <option value="Chicago">
                                    </datalist>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Floating Labels</h5>
                </div><!-- end card header -->
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6 class="fs-15 mb-3">Example</h6>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>

                            <h6 class="fs-15 mb-3">Textareas</h6>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                <label for="floatingTextarea">Comments</label>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <h6 class="fs-15 mb-3">Selects</h6>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="floatingSelect">Works with selects</label>
                            </div>

                            <h6 class="fs-15 mb-3">Layout</h6>

                            <div class="row g-2">
                                <div class="col-md">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInputGrid" placeholder="name@example.com" value="mdo@example.com">
                                        <label for="floatingInputGrid">Email address</label>
                                    </div>
                                </div>

                                <div class="col-md">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelectGrid">
                                            <option selected>Open this select menu</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                        <label for="floatingSelectGrid">Works with selects</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Flatpickr Time Picker</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label">Time Picker</label>
                                <input id="basic-timepicker" type="text" class="form-control" placeholder="Basic timepicker">
                            </div>

                            <div class="mb-0">
                                <label class="form-label">24-hour Time Picker</label>
                                <input id="24hours-timepicker" type="text" class="form-control" placeholder="24-hour Time Picker">
                            </div>
                        </div>


                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label">Time Picker w/ Limits</label>
                                <input id="minmax-timepicker" type="text" class="form-control"
                                    placeholder="Limits">
                            </div>

                            <div class="mb-0">
                                <label class="form-label">Preloading Time</label>
                                <input id="preloading-timepicker" type="text" class="form-control" placeholder="Preloading Time">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Input Group</h5>
                </div><!-- end card header -->
                
                <div class="card-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                        
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">@example.com</span>
                    </div>
                        
                    <div class="mb-3">
                        <label for="basic-url" class="form-label">Your vanity URL</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
                            <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                        </div>
                        <div class="form-text" id="basic-addon4">Example help text goes outside the input group.</div>
                    </div>
                        
                    <div class="input-group mb-3">
                        <span class="input-group-text">$</span>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        <span class="input-group-text">.00</span>
                    </div>
                        
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username">
                        <span class="input-group-text">@</span>
                        <input type="text" class="form-control" placeholder="Server" aria-label="Server">
                    </div>
                        
                    <div class="input-group">
                        <span class="input-group-text">With textarea</span>
                        <textarea class="form-control" aria-label="With textarea"></textarea>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Switches</h5>
                </div><!-- end card header -->
                
                <div class="card-body">

                    <h6 class="fs-15 mb-3">Left Side Switches</h6>

                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDisabled" disabled>
                        <label class="form-check-label" for="flexSwitchCheckDisabled">Disabled switch checkbox input</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckCheckedDisabled" checked disabled>
                        <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Disabled checked switch checkbox input</label>
                    </div>

                </div>
            </div>
        </div>

    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Flatpickr Date picker</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label">Basic</label>
                                <input type="text" class="form-control" id="basic-datepicker" placeholder="Basic datepicker">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> <!-- container-fluid -->

