# Docker WordPress demo

This workspace contains a minimal WordPress stack with MariaDB, managed by Docker Compose.

##TEST1

## Demo URL

This project is not hosted publicly.

- Site URL: `http://localhost:8081`
- WordPress admin: `http://localhost:8081/wp-admin/`

Use the local Docker setup below to run the demo site on your machine.

## Start from scratch

If you are starting with only these two pieces:

- `compose.yml`
- `wp-content/themes/base-theme-starter/`

set up the workspace like this:

```text
.
|-- compose.yml
`-- wp-content/
	`-- themes/
		`-- base-theme-starter/
```

The `wp-content` folder is important because it is bind-mounted into the WordPress container from `compose.yml`.

## Local development setup

### Prerequisites

- Docker Desktop installed and running
- Port `8081` available on your machine

### 1. Create the local WordPress content folders

If they do not exist yet, create these folders next to `compose.yml`:

```text
wp-content/
wp-content/themes/
wp-content/themes/base-theme-starter/
```

If you do not already have a `wp-content/` folder, create it yourself first. That is enough for this Docker setup.

You do not need to download WordPress core just to get `wp-content/`.

If you specifically want the default WordPress themes, plugins, or starter files inside `wp-content/`, download the latest WordPress package from `wordpress.org`, then copy only the `wp-content/` folder contents you want into your local project.

##TEST4

Your custom theme files should live in `wp-content/themes/base-theme-starter/`.

You do not need to manually add WordPress core files. Docker will provide those inside the container.

### 2. Start Docker

From the project root, run:

```bash
docker compose up --build
```

This starts:

- `db`: MariaDB 11
- `wordpress`: WordPress 6.8 on Apache and PHP 8.3

Docker will:

- create the MariaDB data volume
- create the WordPress volume
- mount your local `wp-content/` folder into `/var/www/html/wp-content`

### 3. Complete the WordPress installer

When the containers are ready, open `http://localhost:8081` in your browser and complete the WordPress installer.

After installation, log in to `http://localhost:8081/wp-admin/`.

### 4. Activate your theme

In WordPress admin:

- go to `Appearance > Themes`
- find `Base Theme Starter`
- activate it

If the theme does not appear, confirm the folder is exactly:

```text
wp-content/themes/base-theme-starter/
```

and that it contains a valid WordPress theme with at least `style.css` and `functions.php`.

### 5. Install the theme setup

Once Docker is running and WordPress is working in the browser, open a new terminal and go to the theme folder:

```bash
cd wp-content/themes/base-theme-starter
```

Then install the theme dependencies and build the assets:

```bash
npm install
npm run build:css
npm run build:blocks
```

If you are actively styling the theme, you can also run:

```bash
npm run watch:css
```

### 6. Work on the theme locally

Because `wp-content/` is mounted from your machine, changes you make in:

```text
wp-content/themes/base-theme-starter/
```

are immediately reflected inside the running WordPress container.

If your theme uses Node tooling, run those commands from the theme directory in a separate terminal.

### Stop the site

```bash
docker compose down
```

### Reset the site completely

```bash
docker compose down --volumes
```

That removes the named Docker volumes as well, including the MariaDB data and the persisted WordPress container files.

## Files

- `compose.yml`: runs WordPress and MariaDB on port 8081
- `wp-content/`: local bind-mounted WordPress content directory
- `wp-content/themes/base-theme-starter/`: your custom theme source

## Run in VS Code

Open the integrated terminal in this folder and run:

```bash
docker compose up --build
```

Then open `http://localhost:8081` and complete the WordPress installer.

Theme, plugin, and upload files are exposed locally in `wp-content/`, so you can edit themes directly from the workspace.

## Persistence

This setup stores data in Docker named volumes and a local bind mount:

- `db_data`: MariaDB database files
- `wordpress_data`: WordPress core files and configuration
- `wp-content/`: local WordPress content files for themes, plugins, and uploads

Your site content and database remain available after stopping the stack with `docker compose down`.

To remove everything, including saved data, run:

```bash
docker compose down --volumes
```

## Stop

```bash
docker compose down
```
