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

Object.assign(window, {Alpine});

Alpine.data('cookiePolicy', CookiePolicyTool);
Alpine.data('inquiryFormTool', InquiryFormTool);

Alpine.start();
