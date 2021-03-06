 <div class="container">
     <header class="row">
         <nav class="navbar navbar-expand-lg navbar-light bg-light">
             <div class="container">
                 <a class="navbar-brand" href="/home">freeAds</a>
                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                 </button>
                 <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                         <li class="nav-item">
                             <a class="nav-link active" aria-current="page" href="/home">Home</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="/annonces">Annonces</a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><button type="button" class="btn btn-dark">Logout</button></a>
                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                 {{ csrf_field() }}
                             </form>
                         </li>
                     </ul>
                     <form class="d-flex" method="GET" action="">
                         <input class="form-control  p-3" type="text" id="search" name="search" placeholder="Search" aria-label="Search" onkeypress=handle(event)>
                     </form>
                 </div>
             </div>
         </nav>
     </header>

     <body>