
function countdown(){
	const new_year = new Date(2023, 0, 1, 0, 0, 0, 0);
	const current_time = new Date();



	var remaining_time = new_year.getTime() - current_time.getTime();
	var one_day = (1000*60*60*24)
	var rem_days = remaining_time/one_day
	var remainder_ms = remaining_time % one_day
	var rem_hours = remainder_ms / (1000*60*60)


	//var remainder_mss = rem_hours % (1000*60*60)
	var rem_ms = remainder_ms % (1000*60*60)
	var rem_mins = rem_ms / (1000*60)

	var rem_ms = rem_ms % (1000*60)
	var rem_secs = rem_ms / (1000)

	var days_to_display = Math.floor(rem_days);
	var hours_to_display = Math.floor(rem_hours);
	var mins_to_display = Math.floor(rem_mins);
	var secs_to_display = Math.floor(rem_secs);

	//console.log(Math.floor(rem_days)+" Days")
	//console.log(Math.floor(rem_hours)+" Hours")
	//console.log(Math.floor(rem_mins)+" Minutes")
	//console.log(Math.floor(rem_secs)+" Seconds")


	document.getElementById('countdown').innerHTML =days_to_display+":"+hours_to_display+":"+mins_to_display+":"+secs_to_display;


}

window.setInterval(countdown, 1000);
