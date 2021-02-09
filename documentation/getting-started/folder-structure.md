# Folder structure
A Glowie application is bundled with two main folders: `app` and `library` along with a main `.htaccess` Apache configuration file and a sample `.gitignore` in the root directory. You only need to point your server to this root directory and Glowie will do the rest for you.

Here you will understand what every folder means and how your application is organized.

### App folder
The `app` folder has everything related to your application. The folders within this folder are:

**config**
Your application environment and routing configuration files (see [App configuration](docs/getting-started/app-configuration)).

**controllers**
Application controllers.

**languages**
Application internationalization configs.

**models**
Application database models.

**public**
Application public accessible folder. All your application assets and public frontend files must be stored here.

**views**
All your application views and templates.

### Library folder
The `library` folder stores everything related to the system core of your application. The folders within this folder are:

**core**
Glowie core system. Do not edit anything in this folder!

**plugins**
Application third-party plugins are stored here (see [Plugins](docs/components/plugins)).