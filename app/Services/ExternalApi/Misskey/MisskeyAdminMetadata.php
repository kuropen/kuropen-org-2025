<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <webmaster@kuropen.org>
 * SPDX-License-Identifier: BSL-1.0
 */

namespace App\Services\ExternalApi\Misskey;

/**
 * Misskeyのメタデータを取得する処理を提供します。
 * @property bool $cacheRemoteFiles
 * @property bool $cacheRemoteSensitiveFiles
 * @property bool $emailRequiredForSignup
 * @property bool $enableHcaptcha
 * @property string|null $hcaptchaSiteKey
 * @property bool $enableMcaptcha
 * @property string|null $mcaptchaSiteKey
 * @property string|null $mcaptchaInstanceUrl
 * @property bool $enableRecaptcha
 * @property string|null $recaptchaSiteKey
 * @property bool $enableTurnstile
 * @property string|null $turnstileSiteKey
 * @property string|null $swPublickey
 * @property string|null $mascotImageUrl
 * @property string|null $bannerUrl
 * @property string|null $serverErrorImageUrl
 * @property string|null $infoImageUrl
 * @property string|null $notFoundImageUrl
 * @property string|null $iconUrl
 * @property string|null $app192IconUrl
 * @property string|null $app512IconUrl
 * @property bool $enableEmail
 * @property bool $enableServiceWorker
 * @property bool $translatorAvailable
 * @property string[] $silencedHosts
 * @property string[] $mediaSilencedHosts
 * @property string[] $pinnedUsers
 * @property string[] $hiddenTags
 * @property string[] $blockedHosts
 * @property string[] $sensitiveWords
 * @property string[] $prohibitedWords
 * @property string[] $bannedEmailDomains
 * @property string[] $preservedUsernames
 * @property string|null $hcaptchaSecretKey
 * @property string|null $mcaptchaSecretKey
 * @property string|null $recaptchaSecretKey
 * @property string|null $turnstileSecretKey
 * @property string $sensitiveMediaDetection
 * @property string $sensitiveMediaDetectionSensitivity
 * @property bool $setSensitiveFlagAutomatically
 * @property bool $enableSensitiveMediaDetectionForVideos
 * @property string|null $proxyAccountId
 * @property string|null $email
 * @property bool $smtpSecure
 * @property string|null $smtpHost
 * @property float|null $smtpPort
 * @property string|null $smtpUser
 * @property string|null $smtpPass
 * @property string|null $swPrivateKey
 * @property bool $useObjectStorage
 * @property string|null $objectStorageBaseUrl
 * @property string|null $objectStorageBucket
 * @property string|null $objectStoragePrefix
 * @property string|null $objectStorageEndpoint
 * @property string|null $objectStorageRegion
 * @property float|null $objectStoragePort
 * @property string|null $objectStorageAccessKey
 * @property string|null $objectStorageSecretKey
 * @property bool $objectStorageUseSSL
 * @property bool $objectStorageUseProxy
 * @property bool $objectStorageSetPublicRead
 * @property bool $enableIpLogging
 * @property bool $enableActiveEmailValidation
 * @property bool $enableVerifymailApi
 * @property string|null $verifymailAuthKey
 * @property bool $enableTruemailApi
 * @property string|null $truemailInstance
 * @property string|null $truemailAuthKey
 * @property bool $enableChartsForRemoteUser
 * @property bool $enableChartsForFederatedInstances
 * @property bool $enableServerMachineStats
 * @property bool $enableIdenticonGeneration
 * @property string $manifestJsonOverride
 * @property object $policies
 * @property bool $enableFanoutTimeline
 * @property bool $enableFanoutTimelineDbFallback
 * @property float $perLocalUserUserTimelineCacheMax
 * @property float $perRemoteUserUserTimelineCacheMax
 * @property float $perUserHomeTimelineCacheMax
 * @property float $perUserListTimelineCacheMax
 * @property float $notesPerOneAd
 * @property string|null $backgroundImageUrl
 * @property string|null $deeplAuthKey
 * @property bool $deeplIsPro
 * @property string|null $defaultDarkTheme
 * @property string|null $defaultLightTheme
 * @property string|null $description
 * @property bool $disableRegistration
 * @property string|null $impressumUrl
 * @property string|null $maintainerEmail
 * @property string|null $maintainerName
 * @property string|null $name
 * @property string|null $shortName
 * @property bool $objectStorageS3ForcePathStyle
 * @property string|null $privacyPolicyUrl
 * @property string|null $inquiryUrl
 * @property string|null $repositoryUrl
 * @property string|null $summalyProxy
 * @property string|null $themeColor
 * @property string|null $tosUrl
 * @property string $uri
 * @property string $version
 * @property bool $urlPreviewEnabled
 * @property float $urlPreviewTimeout
 * @property float $urlPreviewMaximumContentLength
 * @property bool $urlPreviewRequireContentLength
 * @property string|null $urlPreviewUserAgent
 * @property string|null $urlPreviewSummaryProxyUrl
 */
class MisskeyAdminMetadata extends MisskeyApiCommunicator
{
    private array $metadata = [];

    /**
     * メタデータの初期化を行います。
     * @param string $accessToken アクセストークン（管理者権限）
     */
    public function __construct(string $accessToken) {
        $this->metadata = $this->request('/api/admin/meta', $accessToken);
    }

    public function __get($name) {
        return $this->metadata[$name];
    }
}
