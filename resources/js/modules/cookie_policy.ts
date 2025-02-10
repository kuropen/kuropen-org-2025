// SPDX-FileCopyrightText: 2024 Kuropen
//
// SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE

type CookiePolicyTool = {
    show: boolean,
    confirmPolicy: () => Promise<void>,
    init: () => void,
    setPageMargin: (height: number) => void,
}

export default function() {
    return {
        show: false,
        async confirmPolicy() {
            // /api/cookie-policy/confirm にアクセスして、Cookieポリシーの確認を行う
            // パラメーター time には、現在のタイムスタンプを送信する
            await fetch('/api/cookie-policy/confirm', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                credentials: 'same-origin',
                body: JSON.stringify({time: Date.now()})
            })
            this.show = false;
            this.setPageMargin(0);
        },
        init() {
            this.show = true;
        },
        setPageMargin(height: number) {
            console.debug('CookiePolicyTool.setPageMargin', height);

            // ドキュメント全体の margin-bottom に、Cookie Policy の高さを追加する
            document.body.style.marginBottom = `${height}px`;
        }
    } satisfies CookiePolicyTool;
}
