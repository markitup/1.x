// ----------------------------------------------------------------------------
// markItUp! Indent / Outdent tests
// ----------------------------------------------------------------------------
// Copyright (C) 2011 Jay Salvat
// http://markitup.jaysalvat.com/
// ----------------------------------------------------------------------------

mySettings = {	
	markupSet:  [ 	
	    {name:'Indent selection', openWith:'    ', beforeInsert:function(miu) {
	        var e = jQuery.Event("keydown");
	        e.shiftKey = true;
	        e.ctrlKey = true;
	        $(miu.textarea).trigger(e);
	    }},
	    {name:'Outdent selection', replaceWith:function(miu) {
			return miu.selection.replace(/^    /mg, '');
		}, beforeInsert:function(miu) {
	        var e = jQuery.Event("keydown");
	        e.shiftKey = true;
	        e.ctrlKey = true;
	        $(miu.textarea).trigger(e);
	    }}
	]
}