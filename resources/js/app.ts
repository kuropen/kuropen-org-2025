// SPDX-FileCopyrightText: 2024 Kuropen
//
// SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE

import.meta.glob([
    '../images/**/*.png',
    '../images/**/*.jpg',
]);

import Alpine from "alpinejs";
import CookiePolicyTool from "./modules/cookie_policy";
import InquiryFormTool from "./modules/inquiry_form";
import proseExtLink from "./modules/prose_ext_link";

Object.assign(window, {Alpine});

Alpine.data('cookiePolicy', CookiePolicyTool);
Alpine.data('inquiryFormTool', InquiryFormTool);

Alpine.start();

// class=prose が存在すれば、中の外部リンクに対して処理を行う
if (document.getElementsByClassName('prose').length > 0) {
    proseExtLink();
}
