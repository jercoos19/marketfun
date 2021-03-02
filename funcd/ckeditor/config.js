/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	config.uiColor = '#ffffff';
	config.width = '500';
	config.height = '300';
	config.toolbarGroups = [
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'tools', groups: [ 'tools' ] }
	];
	config.removeButtons = 'Paste,PasteText,PasteFromWord,Flash,About,Source,ShowBlocks,Maximize,Smiley,PageBreak,Iframe,SpecialChar,SelectAll,Scayt,Checkbox,Radio,Form,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Anchor,Language,Replace,Find,Print,NewPage,Save,Cut,Templates,Copy,CreateDiv,BulletedList,Subscript,Superscript,Strike,Styles,Format,Font,Unlink,Table,JustifyRight,JustifyBlock';
	config.removePlugins = 'easyimage,cloudservices';
};
