<ul class="socialLinks">
	<% control SiteConfig %>
	    <% if FacebookProfileURL %><li><a href="$FacebookProfileURL.URL" target="_blank">$FacebookImage</a></li><% end_if %>
	    <% if TwitterProfileURL %><li><a href="$TwitterProfileURL.URL" target="_blank">$TwitterImage</a></li><% end_if %>
	    <% if LinkedInProfileURL %><li><a href="$LinkedInProfileURL.URL" target="_blank">$LinkedInImage</a></li><% end_if %>
	<% end_control %>
</ul>