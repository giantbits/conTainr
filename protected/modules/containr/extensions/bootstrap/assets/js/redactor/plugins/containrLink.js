if (typeof RedactorPlugins === 'undefined') var RedactorPlugins = {};

RedactorPlugins.containrLink = {

	init: function()
	{

		this.removeBtn('link');
		this.removeBtn('alignment');
		this.removeBtnSeparatorAfter('backcolor');

		var theObj = this;

		var callback = $.proxy(function()
		{

			var html = this.getSelectedHtml();
			var theObj = this;

			$("#containrLinkFrame").load(function () {

				$("#containrLinkFrame").contents().find("#clText").val(html);

				$("#containrLinkFrame").contents().find("#clInsert").click(function(){

					var clHref 		= $("#containrLinkFrame").contents().find("#clHref").val();
					var clInternal 	= $("#containrLinkFrame").contents().find("#clInternal").val();
					var clText		= $("#containrLinkFrame").contents().find("#clText").val();
					var clTarget 	= $("#containrLinkFrame").contents().find("#clTarget").val();
					var clMail 		= $("#containrLinkFrame").contents().find("#clMail").val();

					var css = "external";

					if(clInternal != "") css = "internal";
					if(clMail != "") css = "mail";

					if(clInternal != "") clHref = "/" + clInternal;
					if(clMail != "") clHref = "mailto:" + clMail;

					html = '<a href="'+clHref+'" target="'+clTarget+'" class="'+css+'">'+clText+'</a>';

					theObj.insertContainrLink(html);
    				theObj.setBuffer();
    				theObj.modalClose();
				});
    		});

		}, this);

		this.addBtnSeparator();
		this.addBtn('containrLink', 'Link', function(obj)
		{
			var modalHtml = '<iframe id="containrLinkFrame" frameborder="0" scrolling="auto" width="100%" height="500" src="/containr/media/linker"></iframe>';
			obj.modalInit('Link', modalHtml, 680, callback);
		});

		this.addBtn('containrUnlink', 'Unlink', function(obj)
		{
			theObj.removeContainrLink();
		});
		this.addBtnSeparator();

	},
	insertContainrLink: function(htmlOut)
    {
    	this.insertHtml(htmlOut);
    },
    removeContainrLink: function()
    {
    	this.execCommand('unlink');
    }
}
