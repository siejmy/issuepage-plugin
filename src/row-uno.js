import { registerBlockType } from "@wordpress/blocks"
import { InnerBlocks } from "@wordpress/block-editor"

export function initBlockissuepageUno() {
	const BLOCK_TEMPLATE = [["siejmy/issuepage-column", { columnIndex: "1" }]]

	registerBlockType("siejmy/issuepage-row-uno", {
		title: "issuepage UNO",
		description: "Uno container",
		category: "layout",
		icon: "smiley",
		supports: {
			html: false,
		},
		edit: ({ className }) => {
			return (
				<div className={className + " tgrow_prnt"}>
					<div className="tgrow uno">
						<InnerBlocks template={BLOCK_TEMPLATE} templateLock="all" />
					</div>
				</div>
			)
		},
		save: ({ className }) => {
			return (
				<div className={className + " tgrow_prnt"}>
					<div className="tgrow uno">
						<InnerBlocks.Content />
					</div>
				</div>
			)
		},
	})
}
