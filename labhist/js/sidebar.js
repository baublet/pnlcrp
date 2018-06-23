var sidebar = document.querySelector(".sidebar"),
	hammertime = new Hammer(sidebar)

hammertime.on('swiperight', function(ev) {
	if(!sidebar.classList) return
	sidebar.classList.remove("shown")
})

hammertime.on('swipeleft', function(ev) {
	if(!sidebar.classList) return
	sidebar.classList.add("shown")
})