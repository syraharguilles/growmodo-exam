(function () {
  const blocks = document.querySelectorAll('.bts-block-faq-boxes');
  if (!blocks.length) {
    return;
  }

  blocks.forEach((block) => {
    block.dataset.enhanced = 'true';
  });
})();
