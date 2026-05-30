(function () {
  const blocks = document.querySelectorAll('.bts-block-featured-properties');
  if (!blocks.length) {
    return;
  }

  blocks.forEach((block) => {
    block.dataset.enhanced = 'true';
  });
})();
