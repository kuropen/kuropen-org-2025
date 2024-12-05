// SPDX-FileCopyrightText: 2024 Kuropen
//
// SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE

const { addIconSelectors } = require('@iconify/tailwind');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/**/*.{js,jsx,ts,tsx}",
        "./app/View/Components/**/*.php",
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('@digital-go-jp/tailwind-theme-plugin'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        addIconSelectors(['heroicons', 'simple-icons', 'skill-icons']),
    ],
}

