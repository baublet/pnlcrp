var isDesktop = window.outerWidth > 800,
	projects = document.getElementById("projects")

if(isDesktop) {
	document.body.insertBefore(projects)
}