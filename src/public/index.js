/**
 * WordPress dependencies
 */
import { addFilter } from "@wordpress/hooks";

const settings = global["_wlEntityRedirectSettings"];

addFilter("wl_context_cards_load_fn_supplier", "wordlift", (defaultFn) => {
	return (url, el) => {
		const enabled = el.getAttribute("data-entity-redirect-enabled");

		// If entity redirect isn't enabled for this target, then return the defaultFn.
		if ("true" !== enabled) return defaultFn(url, el);

		const join = -1 === url.indexOf("?") ? "?" : "&";
		// should load things
		const ids = el
			.getAttribute("data-id")
			.split(";")
			.map((s) => encodeURIComponent(s));

		const params =
			`${join}website=1&entity-redirect=true&id[]=` + ids.join("&id[]=");

		return fetch(`${settings.url}${params}`)
			.then((response) => response.json())
			.then((json) => {
				// Return the JSON if it contains at least 2 elements (i.e. an entity and the web site).
				if (1 < json.length) return json;

				// Otherwise return the default function.
				return defaultFn(url, el);
			});
	};
});
