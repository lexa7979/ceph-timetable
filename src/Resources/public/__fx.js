/***
 * Functions to handle timetable
 ***/
var timetable_refreshHours = function() {
	$('.hour').show();
	var min = 10000;
	$('.hour').each(function() {
		var left = $(this).offset().left;
		min = (left < min) ? left : min;
	});
	$('.hour').each(function () {
		$(this).toggle($(this).offset().left < min + 20);
	});
};

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
			if (! $('#course_data' + id).hasClass('hidden'))
				$('#course_data' + id).addClass('show_details');
			break;

		case 'hide':
			if (! $('#course_data' + id).hasClass('hidden'))
				$('#course_data' + id).removeClass('show_details');
			break;
	}

	// if (! $('#course_data' + id).hasClass('hidden')) {
	// 	if (! $('#course_data' + id).hasClass('show_details'))
	// 		$('.course').removeClass('show_details');
	// 	$('#course_data' + id).toggleClass('show_details');
	// }
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
