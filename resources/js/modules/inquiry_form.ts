// SPDX-FileCopyrightText: 2024 Kuropen
//
// SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE

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

export default function (argTypeChoice: string, givenTypeId: string) {
    return {
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
    } satisfies InquiryFormTool;
}
