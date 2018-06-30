// Sidebar swiping

var sidebar = document.querySelector(".sidebar"),
	hammerSidebar = new Hammer(sidebar)

hammerSidebar.on("swiperight", function(ev) {
	if(!sidebar.classList) return
	sidebar.classList.remove("shown")
})

hammerSidebar.on("swipeleft", function(ev) {
	if(!sidebar.classList) return
	sidebar.classList.add("shown")
})

hammerSidebar.on("tap", function(ev) {
	if(!sidebar.classList) return
	sidebar.classList.add("shown")
})


// Moving projects from the nav to across the top and
// navigation overflow to the left side on desktop

var isDesktop = window.outerWidth > 800,
	projects = document.getElementById("projects")

if(isDesktop) {
	document.body.insertBefore(projects, document.body.firstChild)
}

// On Click CSS Class Toggles

var clickToggles = document.querySelectorAll("[data-on-click-toggle-class]"),
	clickTogglesLength = clickToggles.length

for(var i = 0; i < clickTogglesLength; i++) {
	var element = clickToggles[i]
	clickToggles[i].addEventListener("click", function(event) {
		var toggleClass = element.dataset.onClickToggleClass
		if(element.classList.contains(toggleClass)) {
			element.classList.remove(toggleClass)
		} else {
			element.classList.add(toggleClass)
		}
	})
}