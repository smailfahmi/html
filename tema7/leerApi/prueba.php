<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg   bg-primary">
        <div class="container-fluid bg-primary w-100 h-100">
            <a class="navbar-brand bg-light rounded p-1" href="#">ELtiempo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#">Pais</a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Configuracion
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container ">
        <div class="card bg-primary m-3 p-2">
            <div class="card-body d-flex justify-content-center">
                <div class="row">
                    <div class="col form-check">
                        <input class="form-check-input" type="radio" name="exampleRadio" id="radio1" value="option1">
                        <label class="form-check-label" for="radio1">
                            Hoy
                        </label>
                    </div>
                    <div class="col form-check">
                        <input class="form-check-input" type="radio" name="exampleRadio" id="radio2" value="option2">
                        <label class="form-check-label" for="radio2">
                            5Dias
                        </label>
                    </div>
                    <div class="col form-check">
                        <input class="form-check-input" type="radio" name="exampleRadio" id="radio3" value="option3">
                        <label class="form-check-label" for="radio3">
                            Mas
                        </label>
                    </div>
                </div>
            </div>
            <form class="d-flex d-flex align-item-center justify-content-center" role="search"> <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>
    </div>


    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Hoy</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                    type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Dia 1</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab1-pane"
                    type="button" role="tab" aria-controls="contact-tab1-pane" aria-selected="false">Dia 2</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab2" data-bs-toggle="tab" data-bs-target="#contact-tab2-pane"
                    type="button" role="tab" aria-controls="contact-tab2-pane" aria-selected="false">Dia 3</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab3" data-bs-toggle="tab" data-bs-target="#contact-tab3-pane"
                    type="button" role="tab" aria-controls="contact-tab3-pane" aria-selected="false">Dia 4</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                tabindex="0">...</div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                1
            </div>
            <div class="tab-pane fade" id="contact-tab1-pane" role="tabpanel" aria-labelledby="contact-tab1"
                tabindex="0">2
            </div>
            <div class="tab-pane fade" id="contact-tab2-pane" role="tabpanel" aria-labelledby="contact-tab2"
                tabindex="0">3
            </div>
            <div class="tab-pane fade" id="contact-tab3-pane" role="tabpanel" aria-labelledby="contact-tab3"
                tabindex="0">4
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>