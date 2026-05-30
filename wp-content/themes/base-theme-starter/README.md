# Base Theme Starter Theme

A separate classic WordPress theme scaffold that uses PHP templates and Tailwind CSS.

## Path

`wp-content/themes/base-theme-starter`

## Quick Start

1. Activate **Base Theme Starter** in WordPress admin.
2. Open this folder in a terminal.
3. Install tooling:
   npm install
4. Build CSS once:
   npm run build:css
5. Watch while developing:
   npm run watch:css

## Documentation

I built this as a classic WordPress theme with PHP templates and Tailwind CSS. I went with a classic theme instead of a full block theme because I wanted direct control over the markup in files like `front-page.php`, `header.php`, and `footer.php`, while still keeping the editor usable for content.

The project was developed locally with Docker Compose running WordPress and MariaDB. I used that setup so the environment stayed predictable and easy to start from a single command. Once WordPress was running, the theme work started with the basic setup, asset loading, and WordPress supports in `functions.php`. After that, I added ACF Pro integration, local JSON support, and a simple block build process so custom sections could be built in a repeatable way. Most of the design and development time went into the homepage. Right now, the homepage is the only part I would consider finished.

For styling, I used Tailwind so I could move quickly and keep the CSS organized. Global styles live in `src/input.css`, and block-specific styles live with each block. For content editing, I used the Advanced Custom Fields Pro plugin because it is faster to manage structured fields, repeaters, and block data that way than trying to force everything through native block settings. ACF Pro is also what made it practical to build reusable custom blocks and keep the field definitions versioned in JSON.

Tools and plugins used:

- WordPress as the CMS and template runtime
- Docker Compose for the local WordPress + MariaDB environment
- Tailwind CSS, PostCSS, and Autoprefixer for styling
- Node.js scripts for block scaffolding and block asset builds
- Advanced Custom Fields PRO for custom fields and dynamic blocks

The usual workflow was: update the PHP template, style it with Tailwind, set up the ACF fields, and then rebuild assets with `npm run build:css` and `npm run build:blocks` when needed. That setup worked well for homepage development and gives me a base to keep building the rest of the site.

## Notes

- This is a classic PHP theme (not a block theme).
- Edit templates directly (`header.php`, `index.php`, `single.php`, etc.).
- Tailwind source is in `src/input.css`.
- Compiled output is `assets/css/style.css`.

## ACF + Blocks Ready

- The theme enables Gutenberg supports in `functions.php` (`align-wide`, editor styles, responsive embeds, spacing controls).
- ACF integration is bootstrapped in `inc/acf.php`.
- A starter ACF block is included at `blocks/tpb-hero`.
- ACF JSON is saved/loaded from `acf-json` for version control.

### Use the starter block

1. Install and activate Advanced Custom Fields PRO.
2. Open the block editor and insert `TPB Hero`.
3. Fill in the generated fields (eyebrow, title, body, button text/url).
4. Re-run `npm run build:css` after class changes in PHP block templates.

### Scaffold new blocks with npm

Use the block generator to scaffold ACF blocks with optional CSS/JS files:

`npm run make:block -- --name=feature-card --title="Feature Card" --css --js`

Generated files can include:

- `block.json`
- `templates/render.php`
- `src/style.src.css` (optional)
- `src/script.src.js` (optional)
- `acf-json/*.json` (ACF local field group)

Build all block-level optional assets into `style.css` and `script.js`:

`npm run build:blocks`

This command scans `blocks/*` and compiles/copies only when `src/style.src.css` or `src/script.src.js` exists.
You do not need to add `@tailwind components` or `@tailwind utilities` in each `src/style.src.css`; the build script injects those automatically.

## Block Style Guide

Use this as the team standard for all new blocks.

### 1. Source of truth

- Global design tokens and reusable utilities live in `src/input.css`.
- Block-specific styles live in `blocks/<block-slug>/src/style.src.css`.
- Block-specific front-end behavior lives in `blocks/<block-slug>/src/script.src.js`.
- Do not hand-edit compiled files (`assets/css/style.css`, `blocks/<block-slug>/style.css`, `blocks/<block-slug>/script.js`).

### 2. Naming convention

- Prefix classes with `bts-`.
- Use block wrapper class: `bts-block bts-block-<block-slug>`.
- Use element naming like `bts-block-<block-slug>__title`, `bts-block-<block-slug>__content`.
- Use state naming like `is-active`, `is-loading` on the wrapper.

### 3. CSS rules

- Keep selectors scoped to the block wrapper.
- Prefer Tailwind `@apply` in `style.src.css` for maintainable styles.
- Avoid global element selectors (`h2`, `p`, `a`) unless scoped inside `.bts-block-<block-slug>`.
- Keep spacing, color, and typography consistent with global tokens/utilities.

### 4. JavaScript rules

- Start from the block wrapper and query inside it.
- Make scripts safe when block appears multiple times on one page.
- Avoid polluting global scope; use an IIFE or module-safe pattern.
- Add guards so script exits when block is not present.

### 5. Block file structure

Each block should follow:

- `blocks/<block-slug>/block.json`
- `blocks/<block-slug>/templates/render.php`
- `blocks/<block-slug>/src/style.src.css` (optional)
- `blocks/<block-slug>/src/script.src.js` (optional)
- `blocks/<block-slug>/acf-json/*.json`

### 6. Build workflow

1. Create block scaffold:
   `npm run make:block -- --name=<block-slug> --title="<Block Title>" --css --js`
2. Edit `templates/render.php`, `src/style.src.css`, `src/script.src.js`, and the block-local `acf-json` file.
3. Build block assets:
   `npm run build:blocks`
4. If global styles changed, also run:
   `npm run build:css`

### 7. ACF field sync rule

- If you change field definitions in `fields.php`, keep matching `acf-json` in sync.
- If you change fields from ACF admin, commit updated files in `acf-json`.
- Do not leave PHP field definitions and JSON with conflicting keys or locations.
