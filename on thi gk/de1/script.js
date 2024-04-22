const nameCustomer = document.querySelector(".name-customer");
const addressCustomer = document.querySelector(".address-customer");
let obj; //! giang? thieu'
const list = document.querySelector(".list");
const listOfItems = [
  {
    img: "",
    name: "EA SPORT",
    nsx: "Electronic Art",
    price: 150000,
    quantity: 1,
  },
  {
    img: "",
    name: "Marvel Spider man-2",
    nsx: "Electronic Art",
    price: 150000,
    quantity: 1,
  },
  {
    img: "",
    name: "Sonic superstar",
    nsx: "Electronic Art",
    price: 150000,
    quantity: 1,
  },
  {
    img: "",
    name: "League of legend",
    nsx: "Riot Games",
    price: 300000,
    quantity: 1,
  },

  {
    img: "",
    name: "Hogwarts Legacy",
    nsx: "WB Games",
    price: 150000,
    quantity: 1,
  },
  {
    img: "",
    name: "Minecraft",
    nsx: "Microsoft",
    price: 150000,
    quantity: 1,
  },
];

const form = $("form");

// Render from existing data
listOfItems.forEach(item => {
  const markup = `
    <div class="item">
      <img src="" height="100px" alt="" />
      <p class='name'>${item.name}</p>
      <p>
        nxs:
        <span class="nsx">${item.nsx}</span>
      </p>
      <p>
        Gia:
        <span class="price">${item.price}</span>
      </p>
      <div>
      so luong:
      <input type="number" name="" id="" value="1" />
      chon mua
      <input type="checkbox" name="buy" id="buy" />
    </div>
    `;
console.log(markup)
  list.innerHTML += markup;
});

form.on("submit", e => {
  e.preventDefault();

   obj = {
    name: nameCustomer.value || "",
    address: addressCustomer.value || "",
    txt: "",
    totalBill: 0,
  };

  const checkboxes = $("input[type=checkbox]:checked");
  console.log(checkboxes);

  checkboxes.each((_, item) => {
    const div = $(item).closest("div");
    const name1 = div.closest(".item").find(".name").text();
    const quantity = div.find("input[type=number]").val(); 
    const price = +div.closest(".item").find(".price").text();
    const sum = price * quantity;
    obj.totalBill += sum;

    const txtMarkup = `
      <tr>
        <td>${name1}</td>
        <td>${quantity}</td>
        <td>${price}</td>
        <td>${sum}</td>
      </tr>
    `;

    obj.txt += txtMarkup;
    console.log(obj.txt);
  });
  const table = createTable();
  const w = window.open("./bill.html", "_self");

  w.document.write(table);
});

const createTable = () => {
  // Tinh tong
  const billTotalMarkup = `
    <tr>
      <td>Tổng tiền</td>
      <td>${obj.totalBill} đ</td>
    </tr>
  `;

  obj.txt += billTotalMarkup;

  // Tao bang
  const tableMarkup = `
    <table>
        <thead><td>Hóa đơn</td></thead>
        <tbody>
          <tr>
            <td colspan="2">Họ tên</td>
            <td colspan="2" class="name">${obj.name}</td>
          </tr>
          <tr>
            <td colspan="2">Địa chỉ/ Số điện thoại</td>
            <td colspan="2" class="address_number">${obj.address}</td>
          </tr>
          <tr>
            <td>Đĩa game</td>
            <td>SL</td>
            <td>ĐƠn giá</td>
            <td>Thành tiền</td>
          </tr>

          ${obj.txt}

        </tbody>
      </table> 
  `;

  return tableMarkup;
};
