const form = document.querySelector("#shortly");
const url = document.querySelector("#url");
const copy = document.querySelector('button[data-test="copy-button"]');

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const length = url.length;
  if (length > 255 || length < 5) {
    alert("Invalid input length (min: 5 | max: 255)");
    return false;
  }

  try {
    await axios
      .post("/", {
        url: url.value,
      })
      .then((res) => {
        url.value = res.data.url;
      });
  } catch (error) {
    console.log(error);
  }

  copy.addEventListener("click", () => {
    navigator.clipboard.writeText(url.value);
  });
});
