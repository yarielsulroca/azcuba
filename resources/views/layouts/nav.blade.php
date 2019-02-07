<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <a class="navbar-brand" href="#">MEN&Uacute;</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>

            @hasrole('Administrador')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Nomencladores
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">                    
                    <a class="dropdown-item" href="/municipios">Municipios</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/tipo-unidad">Tipo de unidad</a>
                    <a class="dropdown-item" href="/unidades">Unidad</a>
                    <a class="dropdown-item" href="/cai">CAI</a>  
                    <a class="dropdown-item" href="/periodos">Periodos de subida</a>                  
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/trazas">Trazas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/usuario">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/backup">Salvar BD</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/mediciones">Mediciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reportes</a>
                </li>
            @endhasrole

            <li>
                <a class="nav-link" href="#" onclick="form.submit()">Cerrar</a>
            </li>
        </ul>            
    </div>

    <form name="form" action="/logout" method="POST">
        @csrf
    </form>
</nav>