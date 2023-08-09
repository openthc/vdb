<?php

?>

<div class="hero min-h-[20rem] bg-base-200">
	<div class="hero-content text-center">
		<div class="max-w-lg">

			<h1 class="text-5xl font-bold">Search</h1>

			<form>
				<div class="join py-8">
					<input class="input input-bordered join-item" name="q" placeholder="Search.." value="<?= __h($_GET['q']) ?>">
					<button class="btn btn-primary join-item"><i class="fa fa-search"></i> Search</button>
				</div>
			</form>

		</div>
	</div>
</div>

<div class="container mx-auto min-h-screen">
<?php

if (empty($_GET['q'])) {
?>
	<div class="flex items-center justify-center py-4">
		<div class="join">
			<!-- <a class="btn join-item">Strains:</a> -->
			<?php
			foreach ($data['search_pick'] as $k => $v) {
				printf('<a class="btn btn-outline join-item" href="/search?q=^%s" title="Strains starting with %s (%s)">%s</a>'
					, rawurlencode($k)
					, __h($k)
					, __h($v)
					, __h($k)
				);
			}
			?>
		</div>
	</div>
<?php
}
?>

<?php
// Search Pager
$search_info = $data['search_page'];
$search_info['q'] = $_GET['q'];
_search_page_list($search_info);
?>

<?php
// Search Results
?>
<div class="overflow-x-auto mt-4">
<table class="table table-sm table-hover">
<thead>
<tr>
	<th>Strain</th>
	<th>Type</th>
	<th>Validity</th>
	<th>Stub</th>
</tr>
</thead>
<tbody>
<?php
foreach ($data['search_data'] as $v) {
?>
	<tr class="hover:bg-gray-100">
	<td><a href="/v/<?= rawurlencode($v['stub']) ?>"><?= __h($v['name']) ?></a></td>
	<td><?= $v['type'] ?></td>
	<td><?= $v['vote'] ?></td>
	<td><?= $v['stub'] ?></td>
	</tr>
<?php
}
?>
</tbody>
</table>
</div>

</div>


<?php

function _search_page_list($search_info)
{
	echo '<div class="flex items-center justify-center py-4">';
	echo '<div class="join">';
	// <a class="btn btn-outline-secondary disabled" style="width:6em;">Pages:</a>
	// {% if search_info.max > 18 %}
	if ($search_info['max'] > 18) {

		printf('<a class="btn btn-outline-secondary" href="/search?q=%s&amp;p={{ max(1, search_info.cur - 1) }}"><i class="fa fa-arrow-left"></i></a>'
			, rawurlencode($search_info['q'])
		);

	// 	{% for i in 1..3 %}
	// 		<a class="btn btn-outline-secondary" href="/search?q={{ search_info.q }}&amp;p={{ i }}">{{ i }}</a>
	// 	{% endfor %}

	// 	<!--
	// 	{% for i in 1..search_info.max %}
	// 		<a class="btn btn-outline-secondary" href="/search?q={{ search_info.q }}&amp;p={{ loop.index }}">p{{ loop.index }}</a>
	// 	{% endfor %}
	// 	-->

	// 	{% set min = max(4, search_info.cur - 6) %}
	// 	{% set max = min(min + 12, search_info.max) %}
	// 	{% for i in min..max %}
	// 		<a class="btn btn-outline-secondary" href="/search?q={{ search_info.q }}&amp;p={{ i }}">{{ i }}</a>
	// 	{% endfor %}

	// 	{% set min = max %}
	// 	{% set max = search_info.max %}
	// 	{% for i in min..max %}
	// 		<a class="btn btn-outline-secondary" href="/search?q={{ search_info.q }}&amp;p={{ i }}">{{ i }}</a>
	// 	{% endfor %}

		printf('<a class="btn btn-outline-secondary" href="/search?q=%s&amp;p={{ search_age.cur + 1 }}"><i class="fa fa-arrow-right"></i></a>'
			, rawurlencode($search_info['q'])
		);

	} else {
	// 	{% for i in 1..search_info.max %}
	// 		<a class="btn btn-outline-secondary" href="/search?q={{ search_info.q }}&amp;p={{ i }}">{{ i }}</a>
	// 	{% endfor %}
	}
	echo '</div>';
	echo '</div>';

}
