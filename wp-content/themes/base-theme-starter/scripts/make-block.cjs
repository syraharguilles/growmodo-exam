const fs = require('fs');
const path = require('path');

const themeRoot = path.resolve(__dirname, '..');
const blocksRoot = path.join(themeRoot, 'blocks');

function parseArgs(argv) {
  const parsed = {};

  for (let i = 0; i < argv.length; i += 1) {
    const token = argv[i];
    if (!token.startsWith('--')) {
      continue;
    }

    const cleaned = token.slice(2);
    if (cleaned.includes('=')) {
      const [key, ...rest] = cleaned.split('=');
      parsed[key] = rest.join('=').trim();
      continue;
    }

    const next = argv[i + 1];
    if (next && !next.startsWith('--')) {
      parsed[cleaned] = next.trim();
      i += 1;
      continue;
    }

    parsed[cleaned] = true;
  }

  return parsed;
}

const args = parseArgs(process.argv.slice(2));

function getArgValue(name) {
  const value = args[name];
  return typeof value === 'string' ? value : '';
}

function hasFlag(name) {
  return args[name] === true;
}

function slugify(input) {
  return input
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/^-+|-+$/g, '');
}

function titleFromSlug(slug) {
  return slug
    .split('-')
    .filter(Boolean)
    .map((chunk) => chunk.charAt(0).toUpperCase() + chunk.slice(1))
    .join(' ');
}

const requestedName = getArgValue('name') || getArgValue('slug');
if (!requestedName) {
  console.error('Missing required --name=<block-name>.');
  process.exit(1);
}

const slug = slugify(requestedName);
if (!slug) {
  console.error('Invalid block name. Use letters, numbers, and dashes.');
  process.exit(1);
}

const blockTitle = getArgValue('title') || titleFromSlug(slug);
const withCss = hasFlag('css');
const withJs = hasFlag('js');
const withAcfFields = !hasFlag('no-acf-fields');

const blockDir = path.join(blocksRoot, slug);
if (fs.existsSync(blockDir)) {
  console.error(`Block folder already exists: ${blockDir}`);
  process.exit(1);
}

fs.mkdirSync(blockDir, { recursive: true });
fs.mkdirSync(path.join(blockDir, 'templates'), { recursive: true });
fs.mkdirSync(path.join(blockDir, 'src'), { recursive: true });

const blockJson = {
  name: `acf/${slug}`,
  title: blockTitle,
  description: `ACF-powered ${blockTitle} block.`,
  category: 'layout',
  icon: 'layout',
  keywords: [slug, 'acf', 'starter'],
  supports: {
    align: ['wide', 'full'],
    anchor: true,
    jsx: true,
  },
  attributes: {
    align: {
      type: 'string',
      default: 'wide',
    },
  },
  acf: {
    mode: 'preview',
    renderTemplate: 'templates/render.php',
  },
};

if (withCss) {
  blockJson.style = 'file:./style.css';
  blockJson.editorStyle = 'file:./style.css';
}

if (withJs) {
  blockJson.viewScript = 'file:./script.js';
}

fs.writeFileSync(
  path.join(blockDir, 'block.json'),
  `${JSON.stringify(blockJson, null, 2)}\n`,
  'utf8'
);

const renderTemplate = `<?php
/**
 * ${blockTitle} block template.
 *
 * @package Base_Theme_Starter
 */

$default_align_class = empty($block['align']) ? ' alignwide' : '';
$block_classes = 'bts-block bts-block-${slug}' . $default_align_class;

$wrapper_attributes = function_exists('get_block_wrapper_attributes')
  ? get_block_wrapper_attributes(array('class' => $block_classes))
  : 'class="' . esc_attr($block_classes) . '"';
?>
<section <?php echo $wrapper_attributes; ?>>
    <div class="surface">
        <p class="mb-2 text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">${blockTitle}</p>
      <h2 class="text-3xl font-bold leading-tight">Edit ${blockTitle} in blocks/${slug}/templates/render.php</h2>
    </div>
</section>
`;
fs.writeFileSync(path.join(blockDir, 'templates', 'render.php'), renderTemplate, 'utf8');

if (withCss) {
  const cssTemplate = `@layer components {
  .bts-block-${slug} {
    @apply my-8;
  }
}
`;
  fs.writeFileSync(path.join(blockDir, 'style.src.css'), cssTemplate, 'utf8');
}

if (withJs) {
  const jsTemplate = `(function () {
  const blocks = document.querySelectorAll('.bts-block-${slug}');
  if (!blocks.length) {
    return;
  }

  blocks.forEach((block) => {
    block.dataset.enhanced = 'true';
  });
})();
`;
  fs.writeFileSync(path.join(blockDir, 'src', 'script.src.js'), jsTemplate, 'utf8');
}

if (withAcfFields) {
  const groupKey = `group_${slug.replace(/-/g, '_')}_block`;
  const fieldPrefix = `field_${slug.replace(/-/g, '_')}`;
  const acfJsonDir = path.join(blockDir, 'acf-json');
  fs.mkdirSync(acfJsonDir, { recursive: true });

  const fieldGroup = {
    key: groupKey,
    title: `${blockTitle} Fields`,
    fields: [
      {
        key: `${fieldPrefix}_title`,
        label: 'Title',
        name: 'title',
        type: 'text',
      },
      {
        key: `${fieldPrefix}_content`,
        label: 'Content',
        name: 'content',
        type: 'textarea',
        rows: 4,
      },
    ],
    location: [
      [
        {
          param: 'block',
          operator: '==',
          value: `acf/${slug}`,
        },
      ],
    ],
    menu_order: 0,
    position: 'normal',
    style: 'default',
    label_placement: 'top',
    instruction_placement: 'label',
    hide_on_screen: '',
    active: true,
    description: '',
    show_in_rest: 0,
    modified: Math.floor(Date.now() / 1000),
  };

  fs.writeFileSync(
    path.join(acfJsonDir, `${groupKey}.json`),
    `${JSON.stringify(fieldGroup, null, 2)}\n`,
    'utf8'
  );
}

console.log(`Created block scaffold: blocks/${slug}`);
console.log('Next: run npm run build:blocks');
console.log('Note: src/style.src.css does not need @tailwind directives; build:blocks injects them automatically.');
