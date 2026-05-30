(function () {
  const blocks = document.querySelectorAll('.bts-block-cta-boxed');
  if (!blocks.length) {
    return;
  }

  blocks.forEach((block) => {
    block.dataset.enhanced = 'true';
  });
})();
