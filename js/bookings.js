// console.log("Connected")

const areaCheckBox = document.getElementById("areaCheckBox")
const specialityCheckBox = document.getElementById("specialityCheckBox")

const fieldToggler = (checkbox, target) => {
    checkbox.addEventListener('click', (e) => {
        document.getElementById(target).style = checkbox.checked ? "display: flex" : "display: none"
    })
}

// * check for toggle for area checkbox
fieldToggler(areaCheckBox, "srch")
fieldToggler(specialityCheckBox, "srch2")