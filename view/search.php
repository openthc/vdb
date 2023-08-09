<?php

?>

<div class="hero bg-base-200">
	<div class="hero-content flex-col text-center" style="min-width: 40rem;">
		<div class="grow min-w-full">
			<h1 class="text-5xl font-bold">Search</h1>
		</div>
		<div class="grow min-w-full">
			<form>
				<div class="join min-w-full py-8">
					<input class="input input-bordered join-item grow" name="q" placeholder="Search.." value="<?= __h($_GET['q']) ?>">
					<button class="btn btn-primary join-item"><i class="fa fa-search"></i> Search</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="container mx-auto min-h-screen">


<section class="flex items-center justify-center py-4">
	<div class="join">
		<?php
		$char_want = preg_match('/^\^(.)/', $_GET['q'], $m) ? $m[1] : '';
		$char_list = array_merge(['#'], range('A', 'Z'));
		foreach ($char_list as $k) {
			printf('<a class="btn btn-outline %s join-item" href="/search?q=^%s" title="Strains starting with %s (%s)">%s</a>'
				, (($char_want == $k) ? 'btn-active' : '')
				, rawurlencode($k)
				, __h($k)
				, __h($v)
				, __h($k)
			);
		}
		?>
	</div>
</section>

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
<table class="table table-sm">
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
<?php
_search_page_list($search_info);
?>

</div>


<?php

function _search_page_list($search_info)
{
	$page_list_max_button = 10;

	$q_html = rawurlencode($search_info['q']);

	$max = $search_info['max'];

	echo '<div class="flex items-center justify-center py-4">';
	echo '<div class="join">';
	// <a class="btn btn-outline-secondary disabled" style="width:6em;">Pages:</a>
	// {% if search_info.max > 18 %}

	printf('<a class="btn btn-outline btn-primary join-item" href="/search?q=%s&amp;p=%d"><i class="fa fa-arrow-left"></i></a>'
		, $q_html
		, max(1, $search_info['cur'] - 1)
	);

	if ($search_info['max'] > 10) {

		for ($idx=1; $idx<=3; $idx++) {
			printf('<a class="btn btn-outline join-item" href="/search?q=%s&amp;p=%d">%d</a>', $q_html, $idx, $idx);
		}

		echo '<button class="btn btn-outline btn-disabled join-item">...</button>';

		if ($search_info['cur'] > 3) {
			// Draw the Middle 10?
			// $mid = ceil($max / 2);
			$idx = $search_info['cur'] - 1; // $mid - 1;
			$mid_hi = $search_info['cur'] + 6;
			for ($idx; $idx<=$mid_hi; $idx++) {
				printf('<a class="btn btn-outline join-item" href="/search?q=%s&amp;p=%d">%d</a>', $q_html, $idx, $idx);
			}

		} else {

			$mid = ceil($max / 2);
			$idx = $mid - 1;
			$mid_hi = $mid + 1;
			for ($idx; $idx<=$mid_hi; $idx++) {
				printf('<a class="btn btn-outline join-item" href="/search?q=%s&amp;p=%d">%d</a>', $q_html, $idx, $idx);
			}
		}

		echo '<button class="btn btn-outline btn-disabled join-item">...</button>';

		// $min1 = max(4, $search_info['cur'] - 6);
		// $max1 = min($min1 + 12, $max);
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

	// } else {
	// 	{% for i in 1..search_info.max %}
	// 		<a class="btn btn-outline-secondary" href="/search?q={{ search_info.q }}&amp;p={{ i }}">{{ i }}</a>
	// 	{% endfor %}
	// }

		$idx = $max - 2;
		for ($idx; $idx<=$max; $idx++) {
			printf('<a class="btn btn-outline join-item" href="/search?q=%s&amp;p=%d">%d</a>', $q_html, $idx, $idx);
		}

	} else {
		for ($idx=1; $idx<=$max; $idx++) {
			printf('<a class="btn btn-outline join-item" href="/search?q=%s&amp;p=%d">%d</a>', $q_html, $idx, $idx);
		}
	}

	printf('<a class="btn btn-outline btn-primary join-item" href="/search?q=%s&amp;p=%d"><i class="fa fa-arrow-right"></i></a>'
		, $q_html
		, min($max, $search_info['cur'] + 1)
	);

	echo '</div>';
	echo '</div>';

}
