// SPDX-FileCopyrightText: 2024 Kuropen
//
// SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE

import Alpine from "alpinejs";
Object.assign(window, {Alpine});

// Cookieポリシー関連のアクション
Alpine.data('cookiePolicy', () => ({
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
    },
    init() {
        this.show = true;
    }
}));

/**
 * PHP側のInquiryTypeモデルに対応する型
 */
type InquiryType = {
    id: number,
    description: string,
    valid: boolean | 1 | 0,
    invitation: boolean | 1 | 0,
};
/**
 * 問い合わせフォームのx-data
 */
type InquiryFormTool = {
    typeChoices: InquiryType[],
    selectedType: number | string,
    selectedTypeDescription: string,
    selectedTypeIsInvitation: boolean,
    isSendButtonDisabled: boolean,
    typeCheck: () => void,
    init: () => void
};

Alpine.data<InquiryFormTool, string[]>('inquiryFormTool', (argTypeChoice: string, givenTypeId: string) => ({
    typeChoices: [],
    selectedType: 0,
    selectedTypeDescription: '',
    isSendButtonDisabled: true,
    selectedTypeIsInvitation: false,
    typeCheck() {
        const selectedTypeObject =
            this.typeChoices.find(
                type =>
                    type.id === (typeof this.selectedType === 'string' ? parseInt(this.selectedType) : this.selectedType)
            );
        console.log(selectedTypeObject);
        this.selectedTypeDescription = selectedTypeObject?.description || '';
        this.isSendButtonDisabled = !selectedTypeObject?.valid;
        this.selectedTypeIsInvitation = !!selectedTypeObject?.invitation;
    },
    init() {
        this.typeChoices = JSON.parse(atob(argTypeChoice));
        this.selectedType = parseInt(givenTypeId) || this.typeChoices[0].id || 0;
        this.typeCheck();
    }
}));

Alpine.start();
