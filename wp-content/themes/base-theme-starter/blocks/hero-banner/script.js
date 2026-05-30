(function () {
  const blocks = document.querySelectorAll('.bts-block-hero-banner');
  if (!blocks.length) {
    return;
  }

  blocks.forEach((block) => {
    block.dataset.enhanced = 'true';
  });
})();
