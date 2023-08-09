
<div class="hero bg-base-200">
	<div class="hero-content text-center">
		<div class="max-w-lg">
			<h1 class="text-5xl font-bold">API</h1>
		</div>
	</div>
</div>


<div class="container mx-auto min-h-screen">

<section class="pb-2">

	<h2 class="h1">/api/autocomplete</h2>
	<p>This end-point is designed to be compatible with jQuery Autocomplete</p>

	<pre><code>GET /api/autocomplete?q=TERM</code></pre>
	<pre><code>GET /api/autocomplete?term=TERM</code></pre>
	<pre><code>[
	{
		"code": "",
		"stub": "",
		"label": "Strain A",
		"value": "Strain A",
	},
	{
		"code": "",
		"stub": "",
		"label": "Strain B",
		"value": "Strain B",
	},
]</code></pre>

</section>

<section class="pb-2">
	<h2 class="h1">/api/search</h2>
	<p>This end-point is for getting a response in the OpenTHC JSON schema.</p>

	<pre><code>GET /api/search?q=TERM
[
	{
		"id": "",
		"code": "",
		"stub": "",
		"name": "Strain A",
	},
	{
		"id": "",
		"code": "",
		"stub": "",
		"name": "Strain B",
	}
]</code></pre>

</section>


<h2>Create a Strain</h2>

<pre>
POST /api/create

&gt;&gt;&gt;&gt;
{
        "name": "Strain C",
        "type": "",
}
####
</pre>

<h2>Update a Strain</h2>

<pre>
POST /api/update/S123.D

&gt;&gt;&gt;&gt;
{
        "name": "Strain D",
        "type": "",
}
####
</pre>


</div>
