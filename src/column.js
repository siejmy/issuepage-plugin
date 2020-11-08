import { registerBlockType } from "@wordpress/blocks"
import { InnerBlocks } from "@wordpress/block-editor"

export function initBlockissuepageColumn() {
	registerBlockType("siejmy/issuepage-column", {
		title: "issuepage column",
		description: "Column (internally used)",
		category: "layout",
		icon: "smiley",
		attributes: {
			columnIndex: {
				type: "string",
			},
		},
		supports: {
			html: false,
		},
		edit: ({ className, attributes }) => {
			return (
				<div
					className={
						className + " tgcol c" + attributes.columnIndex + " column"
					}
				>
					<InnerBlocks templateLock={false} />
				</div>
			)
		},
		save: ({ className, attributes }) => {
			return (
				<div
					className={
						className + " tgcol c" + attributes.columnIndex + " column"
					}
				>
					<InnerBlocks.Content />
				</div>
			)
		},
	})
}
