(function () {
  const blocks = document.querySelectorAll('.bts-block-testimonials');
  if (!blocks.length) {
    return;
  }

  blocks.forEach((block) => {
    block.dataset.enhanced = 'true';
  });
})();
