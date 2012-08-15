// -------------------------------------------------------------------
// markItUp! - Markdown Extra Set
// -------------------------------------------------------------------
// Copyright (C) 2008 Jay Salvat
// http://markitup.jaysalvat.com/
// -------------------------------------------------------------------
// MarkDown tags example
// http://en.wikipedia.org/wiki/Markdown
// http://daringfireball.net/projects/markdown/
// MarkDown Extra
// http://michelf.ca/projects/php-markdown/extra/
// -------------------------------------------------------------------
// Feel free to add more tags
// -------------------------------------------------------------------
myMarkdownextraSettings = {
	previewParserPath:	'markitup/sets/markdownextra/parser/preview.php',
	previewAutoRefresh:	true,
	onShiftEnter:		{keepDefault:false, openWith:'\n\n'},
	markupSet: [
		{name:'First Level Heading', key:'1', placeHolder:'Your title here...', closeWith:function(markItUp) { return miu.markdownextraTitle(markItUp, '=') } },
		{name:'Second Level Heading', key:'2', placeHolder:'Your title here...', closeWith:function(markItUp) { return miu.markdownextraTitle(markItUp, '-') } },
		{name:'Heading 3', key:'3', openWith:'### ', placeHolder:'Your title here...' },
		{name:'Heading 4', key:'4', openWith:'#### ', placeHolder:'Your title here...' },
		{name:'Heading 5', key:'5', openWith:'##### ', placeHolder:'Your title here...' },
		{name:'Heading 6', key:'6', openWith:'###### ', placeHolder:'Your title here...' },
		{separator:'---------------' },		
		{name:'Bold', key:'B', openWith:'**', closeWith:'**'},
		{name:'Italic', key:'I', openWith:'_', closeWith:'_'},
		{separator:'---------------' },
		{name:'Bulleted List', openWith:'- ' },
		{name:'Numeric List', openWith:function(markItUp) {
			return markItUp.line+'. ';
		}},
		{separator:'---------------' },
		{name:'Picture', key:'P', replaceWith:'![[![Alternative text]!]]([![Url:!:http://]!] "[![Title]!]")'},
		{name:'Link', key:'L', openWith:'[', closeWith:']([![Url:!:http://]!] "[![Title]!]")', placeHolder:'Your text to link here...' },
		{name:'Definition', className:'definition', key:'D', openWith:'Term\n', placeHolder:':    Your definition here ' },
		{separator:'---------------'},	
		{name:'Quotes', className:'quotes', openWith:'> '},
		{name:'Code Block / Code', className:'code', openWith:'(!(\t|!|`)!)', closeWith:'(!(`)!)'},
		{separator:'---------------'},
		{name:'Table', 
			className:'table', 
			header:" header ",
			seperator:" ------ ",
			placeholder:" data   ",
			replaceWith:function(h) {
				cols = prompt("How many cols?");
				rows = prompt("How many rows?");
				out = "";
				// header row
				for (c = 0; c < cols; c++) {
						out += "|"+(h.header||"");	
				}
				out += "|\n";
				// seperator
				for (c = 0; c < cols; c++) {
						out += "|"+(h.seperator||"");	
				}
				out += "|\n";				
				for (r = 0; r < rows; r++) {
					for (c = 0; c < cols; c++) {
						out += "|"+(h.placeholder||"");	
					}
					out += "|\n";
				}
				return out;
			}
		},		
		{name:'Preview', call:'preview', className:"preview"}
	]
}

// mIu nameSpace to avoid conflict.
miu = {
	markdownextraTitle: function(markItUp, char) {
		heading = '';
		n = $.trim(markItUp.selection||markItUp.placeHolder).length;
		for(i = 0; i < n; i++) {
			heading += char;
		}
		return '\n'+heading;
	}
}
