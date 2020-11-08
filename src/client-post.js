import { registerBlockType } from "@wordpress/blocks"
import { withSelect } from "@wordpress/data"
import { withState } from "@wordpress/compose"

export function initBlockissuepageClientPost() {
	registerBlockType("siejmy/issuepage-client-post", {
		title: "issuepage Post",
		description: "Single post by ID",
		category: "layout",
		icon: "smiley",
		supports: {
			html: false,
		},
		attributes: {
			postId: {
				type: "string",
			},
		},
		edit: withState({
			featuredImgId: 0,
		})(
			withSelect((select, { attributes, featuredImgId }) => {
				console.log("Loading post", attributes.postId)
				return {
					post: attributes.postId
						? select("core").getEntityRecord(
								"postType",
								"post",
								attributes.postId,
						  )
						: undefined,
					media: featuredImgId
						? select("core").getMedia(featuredImgId)
						: undefined,
				}
			})(({ post, media, className, attributes, setAttributes, setState }) => {
				console.log({ post, media })
				const featuredMediaImg = post ? post.featured_media : 0
				setTimeout(
					() => setState((state) => (state.featuredImgId = featuredMediaImg)),
					2,
				)

				const title = post ? post.title.raw : "Wybierz ID wpisu"
				const placeholderImgSrc =
					"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 300 200'%3E%3Crect width='300' height='200' fill='%23cccccc'%3E%3C/rect%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' font-family='monospace' font-size='26px' fill='%23333333'%3Ex%3C/text%3E%3C/svg%3E"

				const imgSrc = media ? media.source_url : placeholderImgSrc

				return (
					<a className={className + " tablopost"}>
						<img src={imgSrc} alt="Post image" />
						<div className="caption">
							<div className="tag">Kategoria</div>
							<h3>{title}</h3>
							<div className="subline">
								ID wpisu:{" "}
								<input
									type="text"
									value={attributes.postId || ""}
									onChange={(event) =>
										setAttributes({ postId: event.target.value })
									}
								/>
							</div>
						</div>
					</a>
				)
			}),
		),
	})
}
