let tableArr = [
  {
    tableName: "Bàn 1",
    no: "desk-1",
    diskMenu: [],
    billSummary: 0,
    render: ".data-1",
    displaySum: ".result-1",
  },
  {
    tableName: "Bàn 2",
    no: "desk-2",
    diskMenu: [],
    billSummary: 0,
    render: ".data-2",
    displaySum: ".result-2",
  },
  {
    tableName: "Bàn 3",
    no: "desk-3",
    diskMenu: [],
    billSummary: 0,
    render: ".data-3",
    displaySum: ".result-3",
  },
];

let currentTable = tableArr[0]; // !default table
console.log(currentTable);

const deleteDisk = diskName => {
  // console.log($('.print').closest("table").find(".desk-header").text())

  let index = currentTable.diskMenu.findIndex(el => el.diskName === diskName);
  if (index === -1) return;

  currentTable.billSummary -=
    currentTable.diskMenu[index].value * currentTable.diskMenu[index].number;

  currentTable.diskMenu.splice(index, 1);

  renderMarkupArray(currentTable.diskMenu, $(currentTable.render));
  renderSummary($(currentTable.displaySum), currentTable);
};

const renderMarkup = (element, selector, haveBtn = true) => {
  const markup = `
    <tr class='row'>
      <td>${element.diskName}</td>
      <td>${element.number}</td>
      <td>${element.value + ".000"}</td>
      ${
        haveBtn
          ? `<td><button class='delete' onclick="deleteDisk('${element.diskName}')">xóa</button></td>`
          : ""
      }
    </tr>
  `;

  selector.append(markup);
};

const renderMarkupArray = (arr, selector, haveBtn = true) => {
  selector.empty();

  arr.forEach(element => {
    renderMarkup(element, selector, haveBtn);
  });
};

const renderSummary = (selector, table) => {
  selector.text(table.billSummary === 0 ? "" : table.billSummary + ".000 đ");
};

$(".disk").on("change", e => {
  const diskObj = {
    diskName: $(".disk").find(":selected").text(),
    number: 1,
    value: e.target.value,
  };

  checkExistAndAdd(currentTable.diskMenu, diskObj);

  renderMarkupArray(currentTable.diskMenu, $(currentTable.render));

  currentTable.billSummary = currentTable.diskMenu.reduce(
    (acc, curr) => acc + curr.value * curr.number,
    0,
  );

  renderSummary($(currentTable.displaySum), currentTable);
});

$(".desk").on("change", () => {
  const tableName = $(".desk").find(":selected").val();
  console.log(tableName);

  const index = tableArr.findIndex(table => table.no === tableName);
  if (index === -1) return;

  currentTable = tableArr[index];

  // console.log(currentTable, tableArr, currentTable.diskMenu);
});

// Print bill summary
$(".print").on("click", function (e) {
  e.preventDefault();

  const tabName = $(this).closest("table").find(".desk-header").text();
  const index = tableArr.findIndex(table => table.tableName === tabName);
  currentTable = tableArr[index];

  $(".bill-result").text("");
  $(".bill-date").text("");
  $(".bill-data").text("");
  $(".table-bill").text(tabName);

  renderMarkupArray(currentTable.diskMenu, $(".bill-data"), false);
  renderSummary($(".bill-result"), currentTable);
  displayTime($(".bill-date"));
  
  window.open('./bill.html')
});

const checkExistAndAdd = (arr, target) => {
  const index = arr.findIndex(el => el.diskName === target.diskName);

  if (arr.length === 0) {
    arr.push(target);
    return;
  }

  index === -1 ? arr.push(target) : arr[index].number++;
};

const displayTime = selector => {
  const timeOption = {
    minute: "numeric",
    hour: "numeric",
  };
  const dayArr = [
    "Chủ Nhật",
    "Thứ 2",
    "Thứ 3",
    "Thứ 4",
    "Thứ 5",
    "Thứ 6",
    "Thứ 7",
  ];
  const day = new Date().getDay();
  const time = new Date().toLocaleTimeString("vi-VN", timeOption);
  const date = new Date().toLocaleDateString("vi-VN");
  const current = dayArr[day] + ", " + date + ", " + time; //
  selector.text(current);
};
displayTime($(".date"));
