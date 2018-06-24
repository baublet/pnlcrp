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