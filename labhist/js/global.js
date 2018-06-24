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

// Moving projects from the nav to across the top on desktop

var isDesktop = window.outerWidth > 800,
	projects = document.getElementById("projects")

if(isDesktop) {
	document.body.insertBefore(projects, document.body.firstChild)
}