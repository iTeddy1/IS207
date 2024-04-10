const btn = document.querySelector("button");
const luongThang = document.querySelector(".result");
const heSo = document.querySelector(".hs td input");
const luong = document.querySelector(".luong td input");

btn.addEventListener("click", e => {
  e.preventDefault();

  const result = Math.trunc(heSo.value * luong.value) + "";
  if (!validate(result) || !(heSo.value > 0)) {
    renderError();
  } else luongThang.innerHTML = result;
});

luong.addEventListener("input", e => {
  if (!validate(e.target.value)) {
    alert("Input must be a number!!");
    e.target.value = "";
  }
});

const validate = value => {
  const pattern = "^[0-9]+$";
  if (!value || !value.match(pattern)) {
    return false;
  }
  return true;
};

const renderError = () => {
  luongThang.innerHTML = `<p class='error'>Input is not a right value</p>`;
};
