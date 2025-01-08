# Application Todo List

Une application simple de gestion de tâches construite avec PHP et PostgreSQL.

## 🚀 Fonctionnalités

- Affichage des tâches
- Ajout de nouvelles tâches
- Marquage des tâches comme complétées/non complétées
- Suppression des tâches
- Persistance des données en base PostgreSQL

## 🛠 Prérequis

- Docker
- Docker Compose
- Git
- Navigateur web pour pgAdmin

## 📦 Installation

1. Clonez le repository :
```bash
git clone [url-du-repo]
cd [nom-du-dossier]
```

2. Lancez l'application avec Docker Compose :
```bash
docker compose up --build
```

## 🌐 Utilisation

Accédez à l'application via votre navigateur : [http://localhost:8080](http://localhost:8080)


## 📊 Accès à pgAdmin

pgAdmin est accessible via votre navigateur : [http://localhost:8081](http://localhost:8081)


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
  DB_NAME: todolist
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
CREATE TABLE tasks (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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
http://localhost:8081

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
     - Maintenance database: todolist
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
3. Committez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

## 📄 Licence

Distributed under the MIT License. See `LICENSE` for more information.
