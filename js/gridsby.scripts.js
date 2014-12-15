new grid3D( document.getElementById( 'grid3d' ) );

var container = document.querySelector('#gallery-container');
	var msnry; imagesLoaded( container, function() {
  	msnry = new Masonry( container, {
 	   itemSelector: '.gallery-image',
	   transitionDuration: '0.3s',
       columnWidth: container.querySelector('.gallery-image') })
	});	
	
var share_button_left = new Share(".share-button-left", {
      title: "Share this!",
      ui: {
        flyout: "top left",
        button_text: "Share"
      },
      networks: {
        facebook: {
            
        }
      }
    });
	
	 