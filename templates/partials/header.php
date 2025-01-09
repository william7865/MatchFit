<link rel="stylesheet" href="/css/header.css">
<header>
    <div class="logo">logo</div>
    <nav>
        <ul>
            <li><a href="/">Accueil</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="/coach">Coach</a></li>
                <li><a href="/free-courses">Cours</a></li>
                <li>
                    <form action="/logout" method="post" style="display:inline;">
                        <button type="submit">Déconnexion</button>
                        
                    </form>
                </li>
            <?php else: ?>
                <div class="buttons">
                <a href="/login" class="btn-nav">Connexion</a>
                <a href="/register" class="btn-nav">Inscription</a>
                </div>
            <?php endif; ?>
        </ul>
    </nav>
</header>