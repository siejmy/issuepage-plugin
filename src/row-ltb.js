import { registerBlockType } from "@wordpress/blocks";
import { InnerBlocks } from "@wordpress/block-editor";

export function initBlockissuepageLTB() {
	const BLOCK_TEMPLATE = [
		["siejmy/issuepage-column", { columnIndex: "1" }],
		["siejmy/issuepage-column", { columnIndex: "2" }],
		["siejmy/issuepage-column", { columnIndex: "3" }],
	];

	registerBlockType("siejmy/issuepage-row-ltb", {
		title: "issuepage LTB",
		description: "Left-top-bottom container",
		category: "widgets",
		icon: "smiley",
		supports: {
			html: false,
		},
		edit: ({ className }) => {
			return (
				<div className={className + " tgrow_prnt"}>
					<div className="tgrow ltb">
						<InnerBlocks template={BLOCK_TEMPLATE} templateLock="all" />
					</div>
				</div>
			);
		},
		save: ({ className }) => {
			return (
				<div className={className + " tgrow_prnt"}>
					<div className="tgrow ltb">
						<InnerBlocks.Content />
					</div>
				</div>
			);
		},
	});
}
