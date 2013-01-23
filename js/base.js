/*
 * base.js
 * 
 * Copyright 2012 budi prasetyo a.k.a. metamorph <metamorph@Cyber-Station> bprast1@yahoo.co.id
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 *
/*-----------------------------------
 * jquery watermark
 * @access		public
 *-----------------------------------*/
function watermark()
{
	$.watermarker.setDefaults({ color: '#606060', left: 8 });
	$('input[type=text]').watermark('Mohon diisi');
}
/*-----------------------------------
 * jquery.ui dialog
 * @access		public
 *----------------------------------*/
function dialog()
{
	$("#formdialog").dialog({
		modal: true
	});	
}
/*-----------------------------------
 * jquery.ui datepicker
 * @access		public
 *----------------------------------*/
function datepicker()
{
	$("#tanggal").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy'
	});
}	
/*---------------------------------------
 * jquery prevent Enter button
 * Enter button causes form submission
 * @access		public
 *--------------------------------------*/
function preventEnter()
{
	$("input:text:first").focus();
			
	$("input:text").bind("keydown",function(e){
		var n = $("input:text").length;
		if(e.which == 13) 
		{ 
			e.preventDefault();
			
			var nextIndex = $("input:text").index(this) + 1;
			if(nextIndex < n)
			{
				$("input:text")[nextIndex].focus();
			}
			else
			{
				$("input:text")[nextIndex-1].blur();
				$("#btnSubmit").click();
			}
		}
	});
	
	$("#btnSubmit").click(function(){
	});
}
/*-----------------------------------
 * jquery success confirmation 
 * @access		public
 *----------------------------------*/
function successConfirm()
{
	$(".success").fadeOut(5000,function(){
	});
}
/*-----------------------------------
 * jquery failed confirmation 
 * @access		public
 *----------------------------------*/
function failedConfirm()
{
	$(".failed").fadeOut(5000,function(){
	});
}
/*----------------------------------------------
 * jquery autocomplete
 * dependencies only jquery with no plugin
 * @access		public
 * @param		string(the name of controller)
 * @return 		string
 *---------------------------------------------*/
function autoComplete(controller,category_suggestions,category,category_autoSuggestionsList)
{
		var item1 = '#'+category_suggestions;
		var item2 = '#'+category;
		var item3 = '#'+category_autoSuggestionsList;
		
		$("#"+category_suggestions).css({
			"list-style": "none",
			"padding": "5px 10px",
			"border": "2px solid #9EA1A5",
			"background": "#fdb1c4",
			"width": "365px",
			"-moz-border-radius": "4px",
			"-webkit-border-radius": "4px",
			"-o-border-radius": "4px",
			"border-radius": "4px",
			"cursor": "pointer"
			});
		
		$(item1).hide();
		
		function lookup(fieldSuggestions, fieldSuggestionsList, inputString){
			if(inputString.length == 0){
				$(fieldSuggestions).hide();
			}else{
				$.post(controller,
				{queryString: ""+inputString+""},
				function(data){
					if(data.length > 0){
						$(fieldSuggestions).show();
						$(fieldSuggestionsList).html(data);
					}
				});
			}
		}
		
		function fill(fieldId, fieldSuggestions, thisValue){
			$(fieldId).val(thisValue);
			setTimeout("$('" + fieldSuggestions + "').hide();",200);
		}
		
		$(item2).keyup(function(){
			lookup(item1, item3, $(item2).val());
		});
		// fill text box with li title
		$(item3 + " li").live('click',function(){
			fill(item2, item1, $(this).attr('title'));
		});
	
}
