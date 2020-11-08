import { registerBlockType } from "@wordpress/blocks"
import { InnerBlocks } from "@wordpress/block-editor"

export function initBlockissuepageTBR() {
	const BLOCK_TEMPLATE = [
		["siejmy/issuepage-column", { columnIndex: "1" }],
		["siejmy/issuepage-column", { columnIndex: "2" }],
		["siejmy/issuepage-column", { columnIndex: "3" }],
	]

	registerBlockType("siejmy/issuepage-row-tbr", {
		title: "issuepage TBR",
		description: "Top-bottom-right container",
		category: "layout",
		icon: "smiley",
		supports: {
			html: false,
		},
		edit: ({ className }) => {
			return (
				<div className={className + " tgrow_prnt"}>
					<div className="tgrow tbr">
						<InnerBlocks template={BLOCK_TEMPLATE} templateLock="all" />
					</div>
				</div>
			)
		},
		save: ({ className }) => {
			return (
				<div className={className + " tgrow_prnt"}>
					<div className="tgrow tbr">
						<InnerBlocks.Content />
					</div>
				</div>
			)
		},
	})
}
