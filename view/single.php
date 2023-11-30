<?php
/**
 * Variety View
 */

?>

<div class="hero bg-base-200">
	<div class="hero-content flex-col text-center" style="min-width: 40rem;">
		<div class="grow min-w-full">
			<h1 class="text-5xl font-bold"><?= __h($data['Variety']['name']) ?></h1>
		</div>
		<div class="grow min-w-full">
			<h2 class="text-5xl font-bold"><?= __h($data['Variety']['type']) ?></h2>
		</div>
	</div>
</div>

<section class="flex justify-around py-4">
	<div>
		<a class="btn btn-neutral">Back</a>
	</div>
	<div>
		<a class="btn btn-neutral">Next</a>
	</div>
</section>

<section class="container mx-auto">

	<h3>Links:</h3>

	<div class="btn-group">

	<?php
	// {% if Variety.link_leafly %}
	// 	<a class="btn btn-outline-secondary" href="{{ Variety.link_leafly }}" target="_blank">Leafly</a>
	// {% else %}
	// 	<a class="btn btn-outline-secondary" href="https://duckduckgo.com/?q=leafly%3A{{ Variety.name }}" target="_blank">Search Leafly</a>
	// {% endif %}

	// {% if Variety.link_allbud %}
	// 	<a class="btn btn-outline-secondary" href="{{ Variety.link_allbud }}" target="_blank">AllBud</a>
	// {% else %}
	// 	<a class="btn btn-outline-secondary" href="https://duckduckgo.com/?q=allbud%3A{{ Variety.name }}" target="_blank">Search AllBud</a>
	// {% endif %}

	// {% if Variety.link_wikileaf %}
	// 	<a class="btn btn-outline-secondary" href="{{ Variety.link_wikileaf }}" target="_blank">WikiLeaf</a>
	// {% else %}
	// 	<a class="btn btn-outline-secondary" href="https://duckduckgo.com/?q=wikileaf%3A{{ Variety.name }}" target="_blank">Search Wikileaf</a>
	// {% endif %}

	// {% if Variety.link_kannapedia %}
	// 	<a class="btn btn-outline-secondary" href="{{ Variety.link_kannapedia }}" target="_blank">Kannapedia</a>
	// {% else %}
	// 	<a class="btn btn-outline-secondary" href="https://duckduckgo.com/?q=Kannapedia%3A{{ Variety.name }}" target="_blank">Search Kannapedia</a>
	// {% endif %}
	?>
	</div>

</section>

<section class="container mx-auto">

	<h3>Images</h3>

	<p>No Images found, if you have some you can upload them, it would be nice.</p>
	<p>All images become part and property of our Open Cannabis Varietey Dataset which is distributed under a CCA license.</p>

</section>

<section class="container mx-auto">

	<h3>Add Linked Page</h3>
	<p>Varieties with more, and accurate, linked pages rank higher.</p>

	<form action="" method="post">
		<div class="input-group">
			<input class="form-control">
			<div class="input-group-append">
				<button class="btn btn-outline-success"><i class="fa fa-save"></i></button>
			</div>
		</div>
	</form>

</section>
