// $Id: fancy_login.js,v 1.7 2009/08/25 08:47:35 hakulicious Exp $
// JavaScript Document

var fancyLogin = {};

fancyLogin.popupVisible = false;
fancyLogin.ctrlPressed = false;

fancyLogin.showLogin = function()
{
	if(!fancyLogin.popupVisible)
	{
		fancyLogin.popupVisible = true;
		$("#fancy_login_dim_screen").css({"position" : "fixed", "top" : "0", "left" : "0", "height" : "100%", "width" : "100%", "display" : "block", "background-color" : Drupal.settings.fancyLogin.screenFadeColor, "z-index" : Drupal.settings.fancyLogin.screenFadeZIndex, "opacity" : "0"}).fadeTo(500, 0.8, function()
		{
			$("#fancy_login_login_box").css({"position" : "fixed", "width" : Drupal.settings.fancyLogin.loginBoxWidth, "height" : Drupal.settings.fancyLogin.loginBoxHeight});
			$("#fancy_login_login_box #edit-name").focus();
			var wHeight = window.innerHeight ? window.innerHeight : $(window).height();
			var wWidth = $(window).width();
			var eHeight = $("#fancy_login_login_box").height();
			var eWidth = $("#fancy_login_login_box").width();
			var eTop = (wHeight - eHeight) / 2;
			var eLeft = (wWidth - eWidth) / 2;
			if($("#fancy_login_close_button").css("display") == "none")
			{
				$("#fancy_login_close_button").css("display", "inline");
			}
			$("#fancy_login_login_box").css({"top" : eTop, "left" : eLeft, "background-color" : Drupal.settings.fancyLogin.loginBoxBackgroundColor, "border-style" : Drupal.settings.fancyLogin.loginBoxBorderStyle, "border-color" : Drupal.settings.fancyLogin.loginBoxBorderColor, "border-width" : Drupal.settings.fancyLogin.loginBoxBorderWidth, "z-index" : (Drupal.settings.fancyLogin.screenFadeZIndex + 1), "display" : "none", "padding-left" : "15px", "padding-right" : "15px"})
			.fadeIn(1000);
			$("#fancy_login_login_box input:first").focus().select();
			fancyLogin.setCloseListener();
		});
	}
}

fancyLogin.setCloseListener = function()
{
	$("#fancy_login_dim_screen, #fancy_login_close_button").click(function()
	{
		fancyLogin.hideLogin();
		return false;
	});
	$("#fancy_login_login_box form").submit(function()
	{
		fancyLogin.submitted();
	});
	$("#fancy_login_login_box a:not('#fancy_login_close_button')").click(function()
	{
		fancyLogin.submitted();
	});
	$(document).keyup(function(event)
	{
	    if(event.keyCode == 27)
		{
	        fancyLogin.hideLogin();
	    }
	});
}

fancyLogin.hideLogin = function(fadeDivSpeed, loginBoxSpeed)
{
	if(fancyLogin.popupVisible)
	{
		fancyLogin.popupVisible = false;
		loginBoxSpeed = (loginBoxSpeed) ? loginBoxSpeed : 800;
		fadeDivSpeed = (fadeDivSpeed) ? fadeDivSpeed : 800;
		$("#fancy_login_login_box").fadeOut(loginBoxSpeed, function()
		{
			$(this).css({"position" : "static", "height" : "auto", "width" : "auto",  "background-color" : "transparent", "border" : "none" });
			$("#fancy_login_dim_screen").fadeOut(fadeDivSpeed);
				$(window).focus();
		});
	}
}

fancyLogin.submitted = function()
{
	var wHeight = $("#fancy_login_form_contents").height();
	var wWidth = $("#fancy_login_form_contents").width();
	$("#fancy_login_ajax_loader").css({"height" : wHeight, "width" : wWidth});
	$("#fancy_login_form_contents").fadeOut(300, function()
	{
		$("#fancy_login_ajax_loader").fadeIn(300);
		var imgHeight = $("#fancy_login_ajax_loader > img").height();
		var imgWidth = $("#fancy_login_ajax_loader > img").width();
		var eMarginTop = (wHeight - imgHeight) / 2;
		var eMarginLeft = (wWidth - imgWidth) / 2;
		$("#fancy_login_ajax_loader img").css({"margin-left" : eMarginLeft, "margin-top" : eMarginTop});
	});
}

Drupal.behaviors.fancyLogin = function()
{
	if(jQuery.browser.version > 6 || !jQuery.browser.msie)
	{
		$("a[href^='" + Drupal.settings.basePath + "user/login']").each(function()
		{
			$(this).click(function()
			{
				$("#fancy_login_login_box form").attr("action", $(this).attr("href"));
				fancyLogin.showLogin();
				return false;
			});
		});
		$(document).keyup(function(e)
		{
			if(e.keyCode == 17)
			{
				fancyLogin.ctrlPressed = false;
			}
		});
		$(document).keydown(function(e)
		{
			if(e.keyCode == 17)
			{
				fancyLogin.ctrlPressed = true;
			}
			if(fancyLogin.ctrlPressed == true && e.keyCode == 190)
			{
				fancyLogin.ctrlPressed = false;
				if(fancyLogin.popupVisible)
				{
					fancyLogin.hideLogin();
				}
				else
				{
					fancyLogin.showLogin();
				}
			}
		});
	}
}