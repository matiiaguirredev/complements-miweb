
const quill = new Quill("#editor", {
  theme: "snow",
  modules: {
    toolbar: [
      [{ font: [] }, { size: [] }],
      ["bold", "italic", "underline", "strike"],
      [{ color: [] }, { background: [] }],
      [{ script: "super" }, { script: "sub" }],
      [{ header: [!1, 1, 2, 3, 4, 5, 6] }, "blockquote", "code-block"],
      [
        { list: "ordered" },
        { list: "bullet" },
        { indent: "-1" },
        { indent: "+1" },
      ],
      ["direction", { align: [] }],
      ["link", "image", "video"],
      ["clean"],
    ],
  },
});


quill.on("text-change", function () {
  // Obtén el contenido del editor
  const blockquotes = quill.root.querySelectorAll("blockquote");

  // Añadir clase 'blockquote' a cada blockquote
  blockquotes.forEach(blockquote => {
    if (!blockquote.classList.contains("blockquote")) {
      blockquote.classList.add("blockquote");
    }
  });

  // Actualizar el valor de algún elemento, por ejemplo un input hidden
  document.getElementById("content").value = quill.root.innerHTML;
});
