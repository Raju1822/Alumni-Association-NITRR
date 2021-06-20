module.exports = function (grunt) {

	grunt.initConfig({

		less: {
		  production: {
		  	options: {
				paths: [""]
			},
		    files: {
		      "assets/css/about-us.css": "assets/css/about-us.less",
		      "assets/css/homepage.css": "assets/css/homepage.less",
		      "assets/css/login.css": "assets/css/login.less",
		      "assets/css/register.css": "assets/css/register.less",
		      "assets/css/events.css": "assets/css/events.less",
		      "assets/css/discussion.css": "assets/css/discussion.less",
		      "assets/css/latest-news.css": "assets/css/latest-news.less",
		      "assets/css/search.css": "assets/css/search.less",
		      "assets/css/advanced-search.css": "assets/css/advanced-search.less",
		      "assets/css/user-profile-main.css": "assets/css/user-profile-main.less",
		      "assets/css/edit-user-profile.css": "assets/css/edit-user-profile.less",
		      "assets/css/admin-welcome.css": "assets/css/admin-welcome.less",
		      "assets/css/minutesofmeeting.css": "assets/css/minutesofmeeting.less",
		      "assets/css/view-discussions.css": "assets/css/view-discussions.less",
		      "assets/css/view-events.css": "assets/css/view-events.less",
		      "assets/css/giving-back.css": "assets/css/giving-back.less",
		    }
		  }
		},

		cssmin: {
		  target: {
		    files: {
		      "assets/css/bootstrap.css": "assets/css/bootstrap.css",
		      "assets/css/owl.carousel.css": "assets/css/owl.carousel.css",
		      "assets/css/animate.min.css": "assets/css/animate.min.css",
		      "assets/css/header.css": "assets/css/header.css",
		      "assets/css/footer.css": "assets/css/footer.css",
		      "assets/css/carousel.css": "assets/css/carousel.css",
		      "assets/css/homepage.css": "assets/css/homepage.css",
		      "assets/css/about-us.css": "assets/css/about-us.css",
		      "assets/css/products.css": "assets/css/products.css",
		      "assets/css/default-style.css": "assets/css/default-style.css",
		      "assets/css/contact-us.css": "assets/css/contact-us.css",
		      "assets/css/gallery.css": "assets/css/gallery.css",
		    }
		  }
		},

		watch: {
		  scripts: {
		    files: ['assets/css/*.less'],
		    tasks: ['less'],
		    options: {
		      spawn: false,
		    },
		  }
		}


	});

	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-newer');
	grunt.registerTask('default',['less']);
};