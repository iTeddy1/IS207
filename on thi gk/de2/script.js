const form = $("form");
let obj;
const list = $(".list");
const arrayOfObject = [];
form.on("submit", e => {
  e.preventDefault();

  obj = {
    img: "https://cdn.tgdd.vn/Products/Images/42/153856/iphone-11-tgdd42.jpg",
    name: "",
    price: 0,
    cond: "",
    seller: "",
    contact: "", // Lay tu telephone. Array.prototype.split()
    details: "",
    txt: "",
  };

  // obj.img = $("input[name=img]").val();
  obj.name = $("input[name=tensp]").val();
  obj.price = $("input[name=gia]").val();
  obj.cond = $("input[name=tinhtrang]").val();
  obj.seller = $("input[name=nguoiban]").val();
  const addressAndContact = $("input[name=diachi-sdt]").val().split(" / ");
  // console.log($("input[name=diachi-sdt]").val());
  obj.contact = addressAndContact[0];
  obj.details = $("input[name=chitiet]").val();

  const productMarkup = `
    <div style="display: flex;flex-direction: column;">
      <img src="${obj.img}" width='200px' heigh='200px'> <br>
      <h1 href='#' onclick="detailsAppend('${obj.name}')">${obj.name}</h1> <br>
      Giá:  ${obj.price} <br>
      Tình trạng:  ${obj.cond} <br>
      Người bán:  ${obj.seller} <br>
      Liên hệ: ${obj.contact} <br>
    </div>
  `;

  obj.txt += productMarkup;
  arrayOfObject.push(obj);
  list.append(obj.txt);
  console.log(obj, addressAndContact);
});

// $("a").on("click",);
const detailsAppend = name => {
  const currentObj = arrayOfObject.find(item => item.name === name);
  if (!currentObj) return;

  const detailsTable = `
  <div style="display: flex;flex-direction: column;">
    <img src="${currentObj.img}" width='200px' heigh='200px'> <br>
    <h1> ${currentObj.name} </h1> <br>
    Giá:  ${currentObj.price} <br>
    Tình trạng:  ${currentObj.cond} <br>
    Người bán:  ${currentObj.seller} <br>
    Liên hệ: ${currentObj.contact} <br>
    Chi Tiết: ${currentObj.details}
  </div>`;

  const w = window.open("./details.html", "_self");
  w.document.write(detailsTable);
};

$("button[type=button]").on("click", e => {
  e.preventDefault();

  // clear input
  $("input").each(function () {
    this.value = "";
  });
});
