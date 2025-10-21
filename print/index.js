const d = new Date();
let dateFormat = "AHC" + d.toLocaleDateString('en-GB').split('/').reverse().join('') + ".png";
let printBtn = document.querySelector("#print");
let saveBtn = document.querySelector("#save");

printBtn.addEventListener("click", function () {
  window.print();
});

saveBtn.addEventListener("click", function () {
  html2canvas(document.querySelector("#save_to_image")).then(function (canvas) {
    var link = document.querySelector("#save_to_image");
    link.setAttribute("download", dateFormat);
    link.setAttribute(
      "href",
      canvas.toDataURL("image/png").replace("image/png", "image/octet-stream")
    );
    link.click();
  });
});
