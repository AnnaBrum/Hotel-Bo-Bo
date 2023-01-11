const links = document.querySelectorAll("a");

for (const link of links) {
    const li = document.createElement("li");
    li.className = "menu-item";
    const a = document.createElement("a");
    a.textContent = section.dataset.nav;
    a.href = `#${section.id}`;
    li.appendChild(a);
    navList.appendChild(li);
};