import { registerBlockType } from "@wordpress/blocks";
import { InnerBlocks } from "@wordpress/block-editor";

export function initBlockissuepageMidline() {
	const BLOCK_TEMPLATE = [["siejmy/issuepage-column", { columnIndex: "1" }]];

	registerBlockType("siejmy/issuepage-row-midline", {
		title: "issuepage Midline",
		description: "Midline container",
		category: "layout",
		icon: "smiley",
		supports: {
			html: false,
		},
		edit: ({ className }) => {
			return (
				<div className={className + " tgrow_prnt"}>
					<div className="tgrow midline">
						<InnerBlocks template={BLOCK_TEMPLATE} templateLock="all" />
					</div>
				</div>
			);
		},
		save: ({ className }) => {
			return (
				<div className={className + "tgrow_prnt"}>
					<div className="tgrow midline">
						<InnerBlocks.Content />
					</div>
				</div>
			);
		},
	});
}
