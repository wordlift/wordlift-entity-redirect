jQuery(function($) {
	"use strict";
	$(".edit-wl-entity-redirect-status").on("click", function(e) {
		e.preventDefault();

		$("#wl-entity-redirect-status-select").toggle();
	});

	$(".cancel-wl-entity-redirect-status").on("click", function(e) {
		e.preventDefault();

		$("#wl-entity-redirect-status-select").hide();
	});

	$(".save-wl-entity-redirect-status").on("click", function(e) {
		e.preventDefault();

		const value = $(
			"input[name='wl_entity_redirect_status']:checked"
		).val();

		wp.ajax
			.post("wl_entity_redirect_status", {
				nonce: $("input[name='wl_entity_redirect_status_nonce']").val(),
				post_id: $("input[name=post_ID]").val(),
				value: value
			})
			.done(function(data) {
				$(".wl-entity-redirect-status-text").html(
					"no" === value ? "Disabled" : "Enabled"
				);
			});

		$("#wl-entity-redirect-status-select").hide();
	});
});
