<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="padding-left: 5%;">PERPUSTAKAAN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="padding-right: 5%;">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item" style="padding-right: 5%;">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Data
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ url('/data-buku') }}">Data Buku</a></li>
                        <li><a class="dropdown-item" href="{{ url('/data-kategori') }}">Data Kategori</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
