$(document).ready(function(){
	//References
	var sections = $("#menu li");
	var loading = $("#loading");
	var content = $("#content");
	
	//Manage click events
	sections.click(function(){
		makeSelected(this.id);
		//show the loading bar
		showLoading();
		//load selected section
		switch(this.id){
			case "All":
				content.load("profilesections.php #section_all", hideLoading);
				break;
			case "Music":
				content.load("profilesections.php #section_music", hideLoading);
				break;
			case "Visual Art":
				content.load("profilesections.php #section_visualart", hideLoading);
				break;
			case "Film":
				content.load("profilesections.php #section_film", hideLoading);
				break;
			case "Writing":
				content.load("profilesections.php #section_writing", hideLoading);
				break;
			case "Photography":
				content.load("profilesections.php #section_photography", hideLoading);
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
	}
	
	function makeSelected(id)
	{
		var theTypes = new Array("All", "Music", "Visual Art", "Film", "Writing", "Photography");
		for (var i=0;i<6;i++)
		{
			document.getElementById(theTypes[i]).setAttribute("class", "");
		}
		document.getElementById(id).setAttribute("class", "selected");
	};
	

});
