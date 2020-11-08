import { registerBlockType } from "@wordpress/blocks"

export function initBlockIssuepageDownloadbtn() {
	registerBlockType("siejmy/issuepage-downloadbtn", {
		title: "Pobierz wydanie PDF",
		description: "Przycisk pobierania pliku PDF do strony wydania",
		category: "layout",
		icon: "smiley",
		supports: {
			html: false,
		},
		attributes: {},
		edit: ({ className }) => {
			return (
				<div className={className + " downloadbtn"}>
					<a href="/">(Pobierz tekst)</a>
				</div>
			)
		},
	})
}
