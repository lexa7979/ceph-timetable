/***
 * Functions to handle timetable
 ***/
var timetable_prepare = function() {

	var el_button = $('.mod_timetableview .filter .link');
	var el_download = $('#timetable_download');
	if ($(el_download).length > 0 && $(el_button).length > 0) {
		var el_a = $(el_download).find('a');
		var href = $(el_a).attr('href');
		var target = $(el_a).attr('target');
		if (href)
			$(el_button).attr('href', href);
		if (target)
			$(el_button).attr('target', target);
		$(el_download).remove();
	}
};

// var timetable_refreshHours_dayboxes = null;
var timetable_refreshHours = function() {

	// Collect all visible dayboxes and calculate their y-coordinate:
	var dayboxes = {};
	$('.mod_timetableview').find('.daybox').each(function (i, el_daybox) {
		if (! $(el_daybox).hasClass('hidden'))
			dayboxes[i] = {
				'el':		el_daybox,
				'top':		$(el_daybox).offset().top,
				'linesize':	1,
				'linepos':	1,
				'empty1':	$(el_daybox).children('.empty_early').length,
				'empty2':	$(el_daybox).children('.empty_late').length,
			};
	});

	// Determine how many neighbours (objects in the same line) every daybox has:
	for (var i1 in dayboxes) {
		// Ensure that current daybox wasn't already recognised as neighbour of another box:
		if (dayboxes[i1].linesize !== 1)
			continue;
		// Check if there are other dayboxes in the same line:
		var pos = 1;
		for (var i2 in dayboxes) {
			if (i1 !== i2 && Math.abs(dayboxes[i1].top - dayboxes[i2].top) < 20) {
				// Increase the line-size of the involved dayboxes:
				dayboxes[i1].linesize++;
				dayboxes[i2].linesize++;
				// Determine the minimal number of course-placeholders which are empty
				// at the beginning or end of all involved dayboxes, respectively:
				dayboxes[i1].empty1 = (dayboxes[i1].empty1 > dayboxes[i2].empty1) ? dayboxes[i2].empty1 : dayboxes[i1].empty1;
				dayboxes[i1].empty2 = (dayboxes[i1].empty2 > dayboxes[i2].empty2) ? dayboxes[i2].empty2 : dayboxes[i1].empty2;
				// Memorise the line-position of the other daybox (i2):
				dayboxes[i2].linepos = ++pos;
			}
		}
		// Synchronise the number of empty placeholders of all involved dayboxes:
		if (dayboxes[i1].linesize !== 1) for (var i2 in dayboxes) {
			if (i1 !== i2 && Math.abs(dayboxes[i1].top - dayboxes[i2].top) < 20) {
				dayboxes[i2].empty1 = dayboxes[i1].empty1;
				dayboxes[i2].empty2 = dayboxes[i1].empty2;
			}
		}
	}

	// Set CSS-classes for every visible daybox which determine
	// if the daybox has neighbours in the line or not:
	for (var i in dayboxes) {
		if (dayboxes[i].linesize === 1) {
			// (The current daybox has no neighbours, currently.)
			$(dayboxes[i].el).addClass('single_box');
			$(dayboxes[i].el).removeClass('multiple_box');
			$(dayboxes[i].el).removeClass('multiple_box_first');
			$(dayboxes[i].el).removeClass('multiple_box_last');
		}
		else {
			// (The current daybox has neighbours, currently.)
			$(dayboxes[i].el).removeClass('single_box');
			$(dayboxes[i].el).addClass('multiple_box');
			$(dayboxes[i].el).toggleClass('multiple_box_first', dayboxes[i].linepos === 1);
			$(dayboxes[i].el).toggleClass('multiple_box_last', dayboxes[i].linepos === dayboxes[i].linesize);
			// Ensure that the same amount of empty course-placeholders are hidden for every daybox in one line:
			$(dayboxes[i].el).children('.empty_early').each(function (i2, el_empty) {
				$(el_empty).toggleClass('multiple_box_empty', i2 < dayboxes[i].empty1);
			});
			$(dayboxes[i].el).children('.empty_late').each(function (i2, el_empty) {
				$(el_empty).toggleClass('multiple_box_empty', i2 < dayboxes[i].empty2);
			});
		}
	}

	// // Keep a cache of all <div class="daybox">, <div class="hourbox"> and <div class="hour">:
	// if (timetable_refreshHours_dayboxes === null) {
	// 	timetable_refreshHours_dayboxes = [];
	// 	$('.mod_timetableview').find('.daybox').each(function() {
	// 		var hourboxes = [];
	// 		$(this).children('.hourbox').each(function() {
	// 			hourboxes.push({
	// 				'element':	this,
	// 				'hour':		$(this).children('.hour'),
	// 				'left':		null,
	// 			});
	// 		});
	// 		timetable_refreshHours_dayboxes.push({
	// 			'element':		this,
	// 			'hourboxes':	hourboxes,
	// 			'hidden':		$(this).hasClass('hidden')
	// 		});
	// 	});
	// }
	// else {
	// 	timetable_refreshHours_dayboxes.forEach(function(daybox) {
	// 		daybox.hidden = $(daybox.element).hasClass('hidden');
	// 	});
	// }

	// // Check the absolute coordinates of all <div class="hour"> and
	// // determine minimal and maximal distances to document's left border:
	// var min = 20000;
	// var max = -10000;
	// timetable_refreshHours_dayboxes.forEach(function(daybox) {
	// 	if (! daybox.hidden) {
	// 		daybox.hourboxes.forEach(function(hourbox) {
	// 			hourbox.left = $(hourbox.hour).offset().left;
	// 			min = (hourbox.left < min) ? hourbox.left : min;
	// 			max = (hourbox.left > max) ? hourbox.left : max;
	// 		});
	// 	}
	// });

	// if (Math.abs(max - min) < 50) {
	// 	// (All <div class="hour"> have the same distance to document's left border.)
	// 	timetable_refreshHours_dayboxes.forEach(function(daybox) {
	// 		if (! daybox.hidden) {
	// 			daybox.hourboxes.forEach(function(hourbox) {
	// 				$(hourbox.hour).css('visibility', 'visible');
	// 			});
	// 		}
	// 	});
	// }
	// else {
	// 	// Hide all <div class="hour"> with the maximal distance to document's left border:
	// 	max -= 20;
	// 	timetable_refreshHours_dayboxes.forEach(function(daybox) {
	// 		if (! daybox.hidden) {
	// 			daybox.hourboxes.forEach(function(hourbox) {
	// 				$(hourbox.hour).css('visibility', (hourbox.left < max) ? 'visible' : 'hidden');
	// 			});
	// 		}
	// 	});
	// }
};

var timetable_courseClicked = null;
var timetable_courseHover = null;
var timetable_toggleDetails = function(id, action = 'toggle') {

	switch (action) {

		default:
		case 'toggle':
			var already_active = $('#course_data' + id).hasClass('show_details');
			document_hideDynamicElements();
			if (! already_active && ! $('#course_data' + id).hasClass('hidden'))
				$('#course_data' + id).addClass('show_details');
			break;

		case 'show':
			timetable_courseHover = id;
			if (timetable_courseClicked === null && ! $('#course_data' + id).hasClass('hidden'))
				$('#course_data' + id).addClass('show_details');
			break;

		case 'hide':
			timetable_courseHover = null;
			if (timetable_courseClicked === null)
				$('#course_data' + id).removeClass('show_details');
			break;

		case 'click':
			if (timetable_courseClicked === null) {
				$('#course_data' + id).addClass('show_details');
				timetable_courseClicked = id;
			}
			else if (timetable_courseClicked === id) {
				$('#course_data' + id).removeClass('show_details');
				timetable_courseClicked = null;
			}
			else {
				$('#course_data' + timetable_courseClicked).removeClass('show_details');
				$('#course_data' + id).addClass('show_details');
				timetable_courseClicked = id;
			}
			break;
	}
};

var timetable_applyFilter = function() {

	var current_filters = {};
	$('#timetable_filter').find('input').each(function(i, el_input) {
		if ($(el_input).attr('type') !== 'checkbox' || ! $(el_input).prop('checked'))
			return;
		var name = $(el_input).attr('name');
		if (typeof current_filters[name] === 'undefined')
			current_filters[name] = [];
		current_filters[name].push($(el_input).attr('value'));
	});

	if (! ('styles' in current_filters) && ! ('audiences' in current_filters)) {
		$('.mod_timetableview .course').removeClass('hidden');
	}
	else {
		$('.mod_timetableview .course').each(function (i, el_course) {
			// Determine the filter-groups that the current course belongs to:
			var filter_array = $(el_course).attr('data-filter').split(';');
													// e.g. ['style:1', 'audience:2,3']
			var styles = filter_array.reduce(function (result, value) {
				var option = value.split(':');		// e.g. ['style', '1']
				if (result === null && option.length === 2 && option[0] === 'style')
					return option[1].split(',');	// e.g. ['1']
				return result;
			}, null);
			var audiences = filter_array.reduce(function (result, value) {
				var option = value.split(':');		// e.g. ['audience', '2,3']
				if (result === null && option.length === 2 && option[0] === 'audience')
					return option[1].split(',');	// e.g. ['2', '3']
				return result;
			}, null);
			// Determine if the current course fits to the current filters:
			var style_fits = (! ('styles' in current_filters) || current_filters['styles'].filter(value => styles.indexOf(value) !== -1).length > 0);
			var audience_fits = (! ('audiences' in current_filters) || current_filters['audiences'].filter(value => audiences.indexOf(value) !== -1).length > 0);
			$(el_course).toggleClass('hidden', ! style_fits || ! audience_fits);
		});
	}

	if (! ('weekdays' in current_filters)) {
		$('.mod_timetableview .daybox').removeClass('hidden');
	}
	else {
		$('.mod_timetableview .daybox').each(function (i, el_daybox) {
			var weekday = $(el_daybox).attr('data-filter').split(':')[1];
			var weekday_fits = (current_filters.weekdays.indexOf(weekday) !== -1);
			$(el_daybox).toggleClass('hidden', ! weekday_fits);
		});
	}

	timetable_refreshHours();
};
/***/



var document_prepare = function() {

	if ($('.mod_timetableview').length > 0)
		timetable_refreshHours();
}

var document_refresh = function() {

	if ($('.mod_timetableview').length > 0)
		timetable_refreshHours();
};

$(document).ready(document_prepare);
$(window).resize(document_refresh);
