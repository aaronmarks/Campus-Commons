$(document).ready(function(){
	//References
	var sections = $("#menu li");
	var loading = $("#loading");
	var content = $("#content");
	
	//Manage click events
	sections.click(function(){
		//show the loading bar
		showLoading();
		//load selected section
		switch(this.id){
			case "music":
				content.load("uploadsections.php #section_music", hideLoading);
				break;
			case "visualart":
				content.load("uploadsections.php #section_visualart", hideLoading);
				break;
			case "film":
				content.load("uploadsections.php #section_film", hideLoading);
				break;
			case "writing":
				content.load("uploadsections.php #section_writing", hideLoading);
				break;
			case "photography":
				content.load("uploadsections.php #section_photography", hideLoading);
				break;
			default:
				//hide loading bar if there is no selected section
				hideLoading();
				break;
		}
	});

	//show loading bar
	function showLoading(){
		loading
			.css({visibility:"visible"})
			.css({opacity:"1"})
			.css({display:"block"})
		;
	}
	//hide loading bar
	function hideLoading(){
		loading.fadeTo(1000, 0);
	};
});
