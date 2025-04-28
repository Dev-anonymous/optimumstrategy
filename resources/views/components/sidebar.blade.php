<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            @php
                $user = auth()->user();
            @endphp
            @if ('admin' == $user->user_role)
                <li>
                    <a menulabel class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                    </a>
                    <ul aria-expanded="true">
                        <li><a href="{{ route('admin.home') }}">Accueil</a></li>
                        <li><a href=" {{ route('admin.client') }}">Clients</a></li>
                        <li><a href=" {{ route('admin.contact') }}">Contact & Feedback</a></li>
                    </ul>
                </li>
                <li>
                    <a menulabel class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa fa-shopping-bag menu-icon"></i><span class="nav-text">Magasin</span>
                    </a>
                    <ul aria-expanded="true">
                        <li><a href=" {{ route('admin.commande') }}">Commandes</a></li>
                        <li><a href=" {{ route('admin.livre') }}">Livres</a></li>
                    </ul>
                </li>
                <li>
                    <a menulabel class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa fa-book menu-icon"></i><span class="nav-text">Blog</span>
                    </a>
                    <ul aria-expanded="true">
                        <li><a href=" {{ route('admin.blog') }}">Mon Blog</a></li>
                        <li><a href=" {{ route('admin.categorie') }}">Catégories</a></li>
                    </ul>
                </li>
                <li>
                    <a menulabel class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icon-settings menu-icon"></i><span class="nav-text">Paramètres</span>
                    </a>
                    <ul aria-expanded="true">
                        <li><a href="{{ route('admin.taux') }}">Taux</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
