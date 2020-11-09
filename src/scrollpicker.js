import { registerBlockType } from "@wordpress/blocks"

export function initBlockIssuepageScrollpicker() {
	registerBlockType("siejmy/issuepage-scrollpicker", {
		title: "Scroller okładek siejmy",
		description: "Scroller okładek siejmy",
		category: "widgets",
		icon: "smiley",
		supports: {
			html: false,
		},
		edit: ({ className }) => {
			return (
				<div className={className + " scrollpicker_preview"}>
					<div>Tu będą się przewijały okładki Siejmy na stronie</div>
				</div>
			)
		},
	})
}
