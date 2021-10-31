<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>MD Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.print.css") }}" media="print">
    <script src="{{ asset("vendor/scribe/js/theme-default-3.14.0.js") }}"></script>

    <link rel="stylesheet"
          href="//unpkg.com/@highlightjs/cdn-assets@10.7.2/styles/obsidian.min.css">
    <script src="//unpkg.com/@highlightjs/cdn-assets@10.7.2/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>

    <script src="//cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>
    <script>
        var baseUrl = "http://localhost:10222";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("vendor/scribe/js/tryitout-3.14.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;,&quot;php&quot;]">
<a href="#" id="nav-button">
      <span>
        MENU
        <img src="{{ asset("vendor/scribe/images/navbar.png") }}" alt="navbar-image" />
      </span>
</a>
<div class="tocify-wrapper">
                <div class="lang-selector">
                            <a href="#" data-language-name="bash">bash</a>
                            <a href="#" data-language-name="javascript">javascript</a>
                            <a href="#" data-language-name="php">php</a>
                    </div>
        <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>
    <ul class="search-results"></ul>

    <ul id="toc">
    </ul>

            <ul class="toc-footer" id="toc-footer">
                            <li><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                            <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
                    </ul>
            <ul class="toc-footer" id="last-updated">
            <li>Last updated: October 31 2021</li>
        </ul>
</div>
<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1>Introduction</h1>
<p>API Resources</p>
<p>This documentation aims to provide all the information you need to work with API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://localhost:10222</code></pre>

        <h1>Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="expenses">Expenses</h1>

    

            <h2 id="expenses-GETapi-expenses">GET Paginated list</h2>

<p>
</p>

<p><br><b>Available fields for sorting:</b></p>
<ul>
<li><code>id</code></li>
<li><code>expenses_type_id</code></li>
<li><code>value</code></li>
</ul>
<p><br><b>Available fields for filtering:</b></p>
<ul>
<li><code>expenses_type_id</code></li>
</ul>

<span id="example-requests-GETapi-expenses">
<blockquote>Example request:</blockquote>


<pre><code class="language-bash">curl --request GET \
    --get "http://localhost:10222/api/expenses?per_page=2&amp;page=1&amp;sort=value&amp;filter[expenses_type_id]=4" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>

<pre><code class="language-javascript">const url = new URL(
    "http://localhost:10222/api/expenses"
);

const params = {
    "per_page": "2",
    "page": "1",
    "sort": "value",
    "filter[expenses_type_id]": "4",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>

<pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:10222/api/expenses',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'per_page'=&gt; '2',
            'page'=&gt; '1',
            'sort'=&gt; 'value',
            'filter[expenses_type_id]'=&gt; '4',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
</span>

<span id="example-responses-GETapi-expenses">
            <blockquote>
            <p>Example response (400, Wrong parameter for filter):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;errors&quot;: [
        {
            &quot;status&quot;: 400,
            &quot;title&quot;: &quot;Bad Request&quot;,
            &quot;detail&quot;: &quot;Requested filter(s) `expenses_type_id3` are not allowed. Allowed filter(s) are `expenses_type_id`.&quot;,
            &quot;source&quot;: {
                &quot;pointer&quot;: &quot;/api/expenses/&quot;,
                &quot;method&quot;: &quot;GET&quot;
            }
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;data&quot;: [
        {
            &quot;expense_id&quot;: 3,
            &quot;expense_value&quot;: 58.91,
            &quot;expense_description&quot;: &quot;Laudantium aut et cum.&quot;,
            &quot;expense_type&quot;: {
                &quot;id&quot;: 4,
                &quot;description&quot;: &quot;Transport&quot;
            }
        },
        {
            &quot;expense_id&quot;: 9,
            &quot;expense_value&quot;: 2344.47,
            &quot;expense_description&quot;: &quot;Reiciendis et autem est.&quot;,
            &quot;expense_type&quot;: {
                &quot;id&quot;: 4,
                &quot;description&quot;: &quot;Transport&quot;
            }
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost:10222/api/expenses?per_page=2&amp;sort=value&amp;filter%5Bexpenses_type_id%5D=4&amp;page=1&quot;,
        &quot;last&quot;: &quot;http://localhost:10222/api/expenses?per_page=2&amp;sort=value&amp;filter%5Bexpenses_type_id%5D=4&amp;page=5&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://localhost:10222/api/expenses?per_page=2&amp;sort=value&amp;filter%5Bexpenses_type_id%5D=4&amp;page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 5,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:10222/api/expenses?per_page=2&amp;sort=value&amp;filter%5Bexpenses_type_id%5D=4&amp;page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://localhost:10222/api/expenses?per_page=2&amp;sort=value&amp;filter%5Bexpenses_type_id%5D=4&amp;page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:10222/api/expenses?per_page=2&amp;sort=value&amp;filter%5Bexpenses_type_id%5D=4&amp;page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:10222/api/expenses?per_page=2&amp;sort=value&amp;filter%5Bexpenses_type_id%5D=4&amp;page=4&quot;,
                &quot;label&quot;: &quot;4&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:10222/api/expenses?per_page=2&amp;sort=value&amp;filter%5Bexpenses_type_id%5D=4&amp;page=5&quot;,
                &quot;label&quot;: &quot;5&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:10222/api/expenses?per_page=2&amp;sort=value&amp;filter%5Bexpenses_type_id%5D=4&amp;page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://localhost:10222/api/expenses&quot;,
        &quot;per_page&quot;: 2,
        &quot;to&quot;: 2,
        &quot;total&quot;: 10
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-expenses" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-expenses"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-expenses"></code></pre>
</span>
<span id="execution-error-GETapi-expenses" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-expenses"></code></pre>
</span>
<form id="form-GETapi-expenses" data-method="GET"
      data-path="api/expenses"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-expenses', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-expenses"
                    onclick="tryItOut('GETapi-expenses');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-expenses"
                    onclick="cancelTryOut('GETapi-expenses');" hidden>Cancel
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-expenses" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/expenses</code></b>
        </p>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                    <p>
                <b><code>per_page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="per_page"
               data-endpoint="GETapi-expenses"
               value="2"
               data-component="query" hidden>
    <br>
<p>Page size: how many items per page.</p>
            </p>
                    <p>
                <b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="page"
               data-endpoint="GETapi-expenses"
               value="1"
               data-component="query" hidden>
    <br>
<p>Page number.</p>
            </p>
                    <p>
                <b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="sort"
               data-endpoint="GETapi-expenses"
               value="value"
               data-component="query" hidden>
    <br>
<p>Sorting parameter [value, -value].</p>
            </p>
                    <p>
                <b><code>filter[expenses_type_id]</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="filter[expenses_type_id]"
               data-endpoint="GETapi-expenses"
               value="4"
               data-component="query" hidden>
    <br>
<p>Filters by e.g. product_name <code>filter[expanses_type_id]=4</code>.</p>
            </p>
                </form>

    

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                    <a href="#" data-language-name="bash">bash</a>
                                    <a href="#" data-language-name="javascript">javascript</a>
                                    <a href="#" data-language-name="php">php</a>
                            </div>
            </div>
</div>
<script>
    $(function () {
        var exampleLanguages = ["bash","javascript","php"];
        setupLanguages(exampleLanguages);
    });
</script>
</body>
</html>