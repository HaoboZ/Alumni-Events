$(document).ready(function() {
	const activeSystemClass = $('.list-group-item.active');

	//something is entered in search form
	$('#system-search').keyup( function() {
		const that = this;
		// affect all table rows on in systems table
		const tableBody = $('.table-list-search tbody');
		const tableRowsClass = $('.table-list-search tbody tr');
		$('.search-sf').remove();
		tableRowsClass.each( function(i, val) {

			//Lower text for case insensitive
			const rowText = $(val).text().toLowerCase();
			const inputText = $(that).val().toLowerCase();
			if(inputText !== '')
			{
				$('.search-query-sf').remove();
				tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Searching for: "'
					+ $(that).val()
					+ '"</strong></td></tr>');
			}
			else
			{
				$('.search-query-sf').remove();
			}

			if( rowText.indexOf( inputText ) === -1 )
			{
				//hide rows
				tableRowsClass.eq(i).hide();

			}
			else
			{
				$('.search-sf').remove();
				tableRowsClass.eq(i).show();
			}
		});
		//all tr elements are hidden
		if(tableRowsClass.children(':visible').length === 0)
		{
			tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">No entries found.</td></tr>');
		}
	});
});