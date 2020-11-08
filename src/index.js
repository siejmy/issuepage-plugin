import "./style.scss";
import "./editor.scss";

import { initBlockissuepageLTB } from "./row-ltb.js";
import { initBlockissuepageTBR } from "./row-tbr.js";
import { initBlockissuepageDuo } from "./row-duo.js";
import { initBlockissuepageMidline } from "./row-midline.js";
import { initBlockissuepageUno } from "./row-uno.js";
import { initBlockissuepageColumn } from "./column.js";
import { initBlockissuepageClientPost } from "./client-post.js";

initBlockissuepageColumn();
initBlockissuepageLTB();
initBlockissuepageTBR();
initBlockissuepageUno();
initBlockissuepageMidline();
initBlockissuepageDuo();
initBlockissuepageClientPost();
