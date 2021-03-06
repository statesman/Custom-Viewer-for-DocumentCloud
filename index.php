<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd"> 
<html> 
<head>
  <title id="maintitle">Austin American-Statesman Document Viewer</title> 
  <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8"> 
	<link href="css/document-cloud.css" media="all" rel="stylesheet" type="text/css"> 
	 
   
   <!--   
     Customized document viewer for use with DocumentCloud, at http://documentcloud.org.
     Built on a version from the Chicago Tribune team, http://blog.apps.chicagotribune.com/
     Made for use at WNYC, http://wnyc.org
     A base version, without our tracking code, is at: http://s3.amazonaws.com/datadesk/dc.html
     Use at your own risk, improve as you see fit, and let me know if you do!
     
     To use, see: http://johnkeefe.net/a-customized-viewer-for-documentcloud 
     
     John Keefe
     john at johnkeefe.net
     http://johnkeefe.net
     
   -->
	 
	 <style type="text/css">

     body { font-family:Arial,Helvetica,sans-serif; margin:0; padding:0; overflow: hidden;}
     #header {padding:5px 12px 12px;}
     #banner-logo {float:right; border:0; margin-top:3px; margin-bottom:3px;}
     #document { clear: both; width: 100%; }
     #title {margin:0; font-size:1.4em;}
     #back {margin:0; font-size:.9em; font-weight:bold;}
     #document-source {margin:1px 0 3px; font-size:.8em;}

   </style>
   
	<script type="text/javascript" src="http://s3.documentcloud.org/viewer/loader.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>  
	<script type="text/javascript" src="js/jquery.url.min.js"></script>  
  <script type="text/javascript" charset="utf-8"> 

  // function called on load
	function init () {
	
	// get the document id from the url, using jquery.url.min.js
	// so from http://s3.amazonaws.com/datadesk/dc.html?doc=29933-rahm-ruling
	// we get '29933-rahm-ruling'
	var documentcloud_id = $.url.param("doc");
	
	// build the documentcloud url
	var documentcloud_url = "http://www.documentcloud.org/documents/" + documentcloud_id + ".js";
	  
  // NOTE! The page doesn't make sure the document id is valid or that the document is
  // public. It probably should. If you have code to do that, let me know! 
	  
	// assign the document loader to varible 'viewer'
	var viewer = DV.load(documentcloud_url, {
        container : 'div#document',
        embedded : true,
      
        // after the document loads ...
        afterLoad : function(viewer) {
        
              // ... get its title, and put it on the page and in the title bar
              var document_title = viewer.api.getTitle();
       				$('#titletext').text(document_title);
       				$('#maintitle').text(document_title);
     				
       				// ... get its source, and put it in if it exists
       				var document_source = viewer.api.getSource();
       				var document_source_html = "Source: " + document_source

       				if(document_source != null)
       				  {
       				  $('#document-source').html(document_source_html);
       				  }
     				
       				// ... show the link to the related article, if it exists
       				var related_article_url = viewer.api.getRelatedArticle();
       				var related_html = "<a id='back-link' rel='external' href='" + related_article_url + "'>&laquo; Go to the related story.</a>";
     				
       				if(related_article_url != null)
       				  {
       				  $('#article-link').html(related_html);
       				  }
     				  
     				}
      });
	
	}
		
</script>	
<?php include "js/metrics-head.js"; ?>	
</head> 
<body onload="init();"> 

<div id="header">  
  <!-- Next up is the logo info. 
  Change the href to point to your site's url
  and the src field to point to your logo image
  It's set up to use a logo 60 pixels tall -->  
  <a rel="external" href="http://www.statesman.com"><img id="banner-logo" src="logo-black.png" alt="Logo"></a> 
    
	<h1 id='title'><div id='titletext'>&nbsp;</div></h1> 
	<p id="document-source">&nbsp;</p> 
	<p id='back'><div id='article-link'></div></p> 
</div>

<!-- The document is loaded into the next line -->
<div id="document"> 
</div> 
 
  <?php include "js/metrics.js"; ?>
</body> 
</html>