const fs = require('fs');
const path = require('path');
const { spawnSync } = require('child_process');

const themeRoot = path.resolve(__dirname, '..');
const blocksRoot = path.join(themeRoot, 'blocks');

if (!fs.existsSync(blocksRoot)) {
  console.log('No blocks directory found.');
  process.exit(0);
}

const blockDirs = fs
  .readdirSync(blocksRoot, { withFileTypes: true })
  .filter((entry) => entry.isDirectory())
  .map((entry) => path.join(blocksRoot, entry.name));

if (!blockDirs.length) {
  console.log('No block folders to build.');
  process.exit(0);
}

let hasErrors = false;

for (const blockDir of blockDirs) {
  const blockName = path.basename(blockDir);
  const srcCssInSrcDir = path.join(blockDir, 'src', 'style.src.css');
  const srcCssInBlockRoot = path.join(blockDir, 'style.src.css');
  const srcCss = fs.existsSync(srcCssInSrcDir) ? srcCssInSrcDir : srcCssInBlockRoot;
  const outCss = path.join(blockDir, 'style.css');
  const srcJsInSrcDir = path.join(blockDir, 'src', 'script.src.js');
  const srcJsInBlockRoot = path.join(blockDir, 'script.src.js');
  const srcJs = fs.existsSync(srcJsInSrcDir) ? srcJsInSrcDir : srcJsInBlockRoot;
  const outJs = path.join(blockDir, 'script.js');

  if (fs.existsSync(srcCss)) {
    const tempCssInput = path.join(blockDir, '.style.build.css');
    const cssSource = fs.readFileSync(srcCss, 'utf8');
    const cssWithoutTailwindDirectives = cssSource
      .replace(/^\s*@tailwind\s+(base|components|utilities)\s*;\s*$/gm, '')
      .trim();

    const cssBuildInput = `@tailwind components;\n@tailwind utilities;\n\n${cssWithoutTailwindDirectives}\n`;
    fs.writeFileSync(tempCssInput, cssBuildInput, 'utf8');

    const cssBuild = spawnSync(
      'npx',
      [
        'tailwindcss',
        '-c',
        path.join(themeRoot, 'tailwind.config.js'),
        '-i',
        tempCssInput,
        '-o',
        outCss,
        '--minify',
      ],
      { stdio: 'inherit', cwd: themeRoot, shell: true }
    );

    if (fs.existsSync(tempCssInput)) {
      fs.unlinkSync(tempCssInput);
    }

    if (cssBuild.status !== 0) {
      console.error(`Failed CSS build for block: ${blockName}`);
      hasErrors = true;
    } else {
      console.log(`Built CSS: blocks/${blockName}/style.css`);
    }
  }

  if (fs.existsSync(srcJs)) {
    fs.copyFileSync(srcJs, outJs);
    console.log(`Built JS: blocks/${blockName}/script.js`);
  }
}

if (hasErrors) {
  process.exit(1);
}

console.log('Block build complete.');
