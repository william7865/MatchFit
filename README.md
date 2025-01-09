## Application MatchFit

Le site MatchFit est une plateforme dédiée aux amateurs de sport et aux coachs professionnels. Il facilite les interactions entre coachs et utilisateurs tout en proposant des services personnalisés selon les préférences sportives de chacun, le tout fait avec l'utilisation de PHP et PostgreSQL.

## 🚀 Fonctionnalités

	•	Création de comptes pour les coachs et les utilisateurs
	•	Système de chat entre coachs et utilisateurs
	•	Suggestions personnalisées en fonction du sport choisi
	•	Système d’avis et notes sur les coachs
	•	Pages de profil détaillées pour coachs et utilisateurs
	•	Barre de recherche pour trouver des coachs ou des cours gratuits
	•	Navbar avec :
	•	Accueil
	•	Connexion/Déconnexion
	•	Profil
	•	Page des coachs
	•	Page des cours gratuits

## 🛠 Prérequis

- Docker
- Docker Compose
- Git
- Navigateur web pour pgAdmin

## 📦 Installation

1. Clonez le repository :
```bash
git clone [https://github.com/william7865/MatchFit]
cd [MatchFit]
```

2. Lancez l'application avec Docker Compose :
```bash
docker compose up --build
```

## 🌐 Utilisation

Accédez à l'application via votre navigateur : [http://localhost:8081]


## 📊 Accès à pgAdmin

pgAdmin est accessible via votre navigateur : [http://localhost:8082]


## 📁 Structure du projet

```
projet/
├── public/               # Fichiers publics
│   ├── index.php        # Point d'entrée
│   ├── .htaccess       
│   └── css/
│       └── style.css    # Styles CSS
├── src/                 # Code source
│   ├── Controllers/     # Contrôleurs
│   ├── Models/         # Modèles
│   └── Database/       # Configuration BD
├── templates/           # Templates
│   ├── layout.php      # Template principal
│   └── tasks/          # Templates des tâches
├── composer.json        # Dépendances PHP
├── Dockerfile          # Configuration Docker
├── docker compose.yml  # Configuration Docker Compose
└── init.sql           # Initialisation BD
```

## 🔧 Configuration

### Variables d'environnement (docker compose.yml)

```yaml
# PostgreSQL
environment:
     DB_HOST: db
      DB_PORT: 5432
      DB_NAME: matchfit
      DB_USER: postgres
      DB_PASSWORD: password

# pgAdmin
environment:
  PGADMIN_DEFAULT_EMAIL: admin@admin.com
  PGADMIN_DEFAULT_PASSWORD: admin
```

## 📝 Base de données

La base de données PostgreSQL est initialisée avec la structure suivante :

```sql
-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role VARCHAR(50) CHECK(role IN ('user', 'coach')) NOT NULL,
    status VARCHAR(50) CHECK(status IN ('available', 'unavailable')) DEFAULT 'unavailable',
    profile_picture VARCHAR(255) DEFAULT 'default.jpg'
);

-- Table des coachs (même que celle des utilisateurs mais avec plus de détails)
CREATE TABLE IF NOT EXISTS coaches (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    bio TEXT,
    video_url VARCHAR(255),
    status VARCHAR(50) CHECK(status IN ('available', 'unavailable')) DEFAULT 'unavailable'
);

-- Table des sports
CREATE TABLE IF NOT EXISTS sports (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL
);

-- Table des préférences sportives des utilisateurs
CREATE TABLE IF NOT EXISTS user_sports (
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    sport_id INT REFERENCES sports(id) ON DELETE CASCADE,
    PRIMARY KEY (user_id, sport_id)
);

-- Table des messages entre utilisateurs et coachs
CREATE TABLE IF NOT EXISTS messages (
    id SERIAL PRIMARY KEY,
    sender_id INT REFERENCES users(id) ON DELETE CASCADE,
    receiver_id INT REFERENCES users(id) ON DELETE CASCADE,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des avis
CREATE TABLE IF NOT EXISTS reviews (
    id SERIAL PRIMARY KEY,
    coach_id INT REFERENCES coaches(id) ON DELETE CASCADE,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    rating INT CHECK(rating >= 1 AND rating <= 5),
    comment TEXT
);
```

## 🔨 Développement

Pour le développement, les volumes Docker sont configurés pour refléter les changements en temps réel :

```yaml
volumes:
  - ./public:/var/www/html/public
  - ./src:/var/www/html/src
  - ./templates:/var/www/html/templates
```

## 🚀 Commandes utiles

```bash
# Démarrer l'application
docker compose up

# Démarrer l'application en arrière-plan
docker compose up -d

# Arrêter l'application
docker compose down

# Reconstruire les containers
docker compose up --build

# Voir les logs
docker compose logs

# Accéder au container PHP
docker compose exec php bash

# Accéder à la base de données
docker compose exec db psql -U postgres -d todolist

# Accéder à pgAdmin
http://localhost:8082

# Redémarrer pgAdmin si nécessaire
docker compose restart pgadmin
```

### Configuration initiale de pgAdmin

1. Connectez-vous avec :
   - Email: admin@admin.com
   - Mot de passe: admin

2. Pour ajouter le serveur PostgreSQL :
   - Clic droit sur "Servers" → "Register" → "Server"
   - Dans l'onglet "General" :
     - Name: TodoList (ou autre nom de votre choix)
   - Dans l'onglet "Connection" :
     - Host name/address: db
     - Port: 5432
     - Maintenance database: MatchFit
     - Username: postgres
     - Password: password

3. Vous pouvez maintenant :
   - Visualiser la structure de la base de données
   - Exécuter des requêtes SQL
   - Gérer les tables et les données
   - Exporter/Importer des données

## 🔨 Services Docker

L'application utilise trois services Docker :
1. **PHP/Apache** : Serveur web et application PHP
2. **PostgreSQL** : Base de données
3. **pgAdmin** : Interface d'administration de la base de données

## 🛡 Sécurité

- Échappement des données HTML
- Requêtes préparées pour la base de données
- Validation des entrées utilisateur

## 🤝 Contribution

1. Fork le projet
2. Créez votre branche (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m '......'`)
4. Push vers la branche (`git push origin main`)
5. Ouvrez une Pull Request

## 📄 Licence

Distributed under the MIT License. See `LICENSE` for more information.
