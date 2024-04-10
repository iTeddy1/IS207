const btn = document.querySelector("button");
const luongThang = document.querySelector(".result");
const heSo = document.querySelector(".hs td input");
const luong = document.querySelector(".luong td input");

const validate = value => {
  if (
    !value ||
    +value < 0 ||
    isNaN(value) ||
    value.includes(" ") ||
    value === ""
  ) {
    return false;
  }
  return true;
};

btn.addEventListener("click", e => {
  e.preventDefault();

  if (!validate(luong.value) || !validate(heSo.value)) {
    renderError();
    return;
  }

  const result = (heSo.value * luong.value).toFixed(2);
  luongThang.innerHTML = result;
});

const renderError = () => {
  luongThang.innerHTML = `<p class='error'>Input is not a right value</p>`;
};
