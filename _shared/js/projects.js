var consortiumName = "The Civil Rights and Labor History Consortium",
    projects = [{
        "title": "Seattle Civil Rights and Labor History Project",
        "url": "http://depts.washington.edu/civilr/",
        "img": "http://depts.washington.edu/labhist/frontpagespecials/civil%20rights%20project.jpg"
    }, {
        "title": "Great Depression in Washington State Project",
        "url": "http://depts.washington.edu/depress/",
        "img": "http://depts.washington.edu/labhist/frontpagespecials/230/GD%20project2.jpg"
    }, {
        "title": "Data Mapping Washington Labor and Civil Rights History",
        "url": "http://depts.washington.edu/labhist/maps-intro.shtml",
        "img": "http://depts.washington.edu/labhist/frontpagespecials/Data%20mapping%20230.jpg"
    }, {
        "title": "Waterfront Workers History Project",
        "url": "http://depts.washington.edu/dock/",
        "img": "http://depts.washington.edu/labhist/frontpagespecials/waterfront%20project.jpg"
    }, {
        "title": "Pacific Northwest Antiwar and Radical History Project",
        "url": "http://depts.washington.edu/antiwar/",
        "img": "http://depts.washington.edu/labhist/frontpagespecials/antiwar%20project.jpg"
    }, {
        "title": "Seattle General Strike of 1919 Project",
        "url": "http://depts.washington.edu/labhist/strike/",
        "img": "http://depts.washington.edu/labhist/frontpagespecials/general%20strike%20project.jpg"
    }, {
        "title": "Mapping American Social Movements through the Twentieth Century",
        "url": "http://depts.washington.edu/moves",
        "img": "http://depts.washington.edu/labhist/frontpagespecials/230/mapping%20230.jpg"
    }, {
        "title": "Communism in Washington State History and Memory Project",
        "url": "http://depts.washington.edu/labhist/cpproject/index.shtml",
        "img": "http://depts.washington.edu/labhist/frontpagespecials/communism%20project2.jpg"
    }, {
        "title": "IWW History Project--The Industrial Workers of the World 1905-1935",
        "url": "http://depts.washington.edu/iww",
        "img": "http://depts.washington.edu/labhist/frontpagespecials/IWWhistory.jpg"
    }, {
        "title": "Upton Sinclair's End Poverty in California Campaign",
        "url": "http://depts.washington.edu/epic34/",
        "img": "http://depts.washington.edu/labhist/frontpagespecials/EPIC400.jpg"
    }, {
        "title": "Strikes! Labor History Encyclopedia for the Pacific Northwest",
        "url": "http://depts.washington.edu/labhist/encyclopedia",
        "img": "http://depts.washington.edu/labhist/frontpagespecials/encyclopedia.jpg"
    }, {
        "title": "Labor Press Project",
        "url": "http://depts.washington.edu/labhist/laborpress/",
        "img": "http://depts.washington.edu/labhist/frontpagespecials/LaborPress%20project.jpg"
    }, {
        "title": "America's Great Migrations",
        "url": "http://depts.washington.edu/moving1",
        "img": "http://depts.washington.edu/labhist/frontpagespecials/migrations.jpg"
    }];

// First, create the projects element
var projectsListContainer = document.getElementById("navigationProjectsList"),
	projectBoxTemplate = function(url, title, image) {
		return (
			'<div class="projectBox">' +
            	'<a href="' + url + '" class="projectBoxImageLink">' +
            		'<img src="' + image + '" alt="' + title + '" class="projectBoxImage" />' +
            	'</a>' +
            	'<div class="projectBoxTitle">' +
            		'<a class="projectBoxTitleLink" href="' + url + '">' +
            			title +
            		'</a>' +
            	'</div>' +
        	'</div>'
       	)
	}

var projectsHTML = '',
    projectsHeader = document.createElement("h3");

projectsHeader.innerHTML = consortiumName;

for(var i = 0; i < projects.length; i++) {
	projectsHTML = projectsHTML +
					projectBoxTemplate(
							projects[i].url,
							projects[i].title,
							projects[i].img
					);
}

projectsListContainer.innerHTML = projectsHTML;
projectsListContainer.parentNode.insertBefore(
    projectsHeader,
    projectsListContainer
);

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