

const variantData = window.variantData || {};

function updateSizes() {
    const color = document.getElementById("color").value;
    const sizeDropdown = document.getElementById("size");
    sizeDropdown.innerHTML = "<option value=''>Select size</option>";

    if (variantData[color]) {
        variantData[color].forEach(size => {
            const opt = document.createElement("option");
            opt.value = size;
            opt.textContent = size;
            sizeDropdown.appendChild(opt);
        });
    }
}
// Form interaction and event handling based on W3Schools and MDN
// https://www.w3schools.com/jsref/event_onchange.asp
// https://developer.mozilla.org/en-US/docs/Web/Events