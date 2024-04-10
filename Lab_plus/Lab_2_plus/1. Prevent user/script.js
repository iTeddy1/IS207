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
    return;
  }

  const result = (heSo.value * luong.value).toFixed(2) ;
  luongThang.innerHTML = result;
});

luong.addEventListener("input", e => {
  if (!validate(e.target.value)) {
    alert("Input must be a positive number!!");
    e.target.value = "";
  }
});

heSo.addEventListener("input", e => {
  if (!validate(e.target.value)) {
    alert("Input must be a positive number!!");
    e.target.value = "";
  }
});


