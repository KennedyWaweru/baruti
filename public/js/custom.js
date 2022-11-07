
function countdown(){
	const current_time = new Date();
	const current_year = new Date().getFullYear();
	console.log(`Current year ${current_year+1}`);
	const new_year = new Date( 2023, 0, 1, 0, 0, 0, 0);


	const remaining_time = new_year.getTime() - current_time.getTime();
	const one_day = (1000*60*60*24)
	const rem_days = remaining_time/one_day
	const remainder_ms = remaining_time % one_day
	const rem_hours = remainder_ms / (1000*60*60)


	//const remainder_mss = rem_hours % (1000*60*60)
	const rem_mss = remainder_ms % (1000*60*60)
	const rem_mins = rem_mss / (1000*60)

	const rem_ms = rem_mss % (1000*60)
	const rem_secs = rem_ms / (1000)

	const days_to_display = Math.floor(rem_days);
	const hours_to_display = Math.floor(rem_hours);
	const mins_to_display = Math.floor(rem_mins);
	const secs_to_display = Math.floor(rem_secs);

	document.getElementById('countdown').innerHTML =days_to_display+":"+hours_to_display+":"+mins_to_display+":"+secs_to_display;


}

window.setInterval(countdown, 1000);
window.addEventListener('loadMoreProducts', (event)=>{
	console.log('something clear');
	alert('Something cooler');
	var moreProductsRow = document.getElementById('moreProducts').innerHTML;
	moreProductsRow.append('<h1>Hello new world</h1>');
});