if (typeof RedactorPlugins === 'undefined') var RedactorPlugins = {};

RedactorPlugins.containrMedia = {

	init: function()
	{
		this.removeBtn('image');
		this.removeBtn('alignment');
		this.removeBtnSeparatorAfter('backcolor');

		var callback = $.proxy(function()
		{

			var theObj = this;

			$("#containrMediaFrame").load(function () {
				$("#containrMediaFrame").contents().find("#cmInsert").click(function(){

					var cmMediaId = $("#containrMediaFrame").contents().find("#cmMediaId").val();
					var cmSize = $("#containrMediaFrame").contents().find("#cmSize").val();
					var cmAlt = $("#containrMediaFrame").contents().find("#cmAlt").val();
					var cmPosition = $("#containrMediaFrame").contents().find("#cmPosition").val();

    				var html = '<img src="/containr/media/getmedia?mid='+cmMediaId+'&msize='+cmSize+'" alt="'+cmAlt+'" align="'+cmPosition+'" />';

    				theObj.insertContainrMedia(html);
    				theObj.setBuffer();
					theObj.modalClose();
				});
    		});

		}, this);

		this.addBtn('containrMedia', 'Media', function(obj)
		{
			var modalHtml = '<div id="contrainrMedia" class="modal fade in" style="width: 680px;" aria-hidden="false"><iframe id="containrMediaFrame" frameborder="0" scrolling="auto" width="100%" height="400" src="/containr/media/library"></iframe></div>';

			obj.modalInit('Media', modalHtml, 680, callback);

		});

	},
	insertContainrMedia: function(htmlOut)
    {
    	this.insertHtml(htmlOut);
    }
}
