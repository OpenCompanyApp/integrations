<?php

namespace OpenCompany\Integrations\TikTok;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\TikTok\Tools\TiktokListVideos;
use OpenCompany\Integrations\TikTok\Tools\TiktokGetVideo;
use OpenCompany\Integrations\TikTok\Tools\TiktokUploadVideo;
use OpenCompany\Integrations\TikTok\Tools\TiktokListCampaigns;
use OpenCompany\Integrations\TikTok\Tools\TiktokGetCampaign;
use OpenCompany\Integrations\TikTok\Tools\TiktokListAdvertisers;
use OpenCompany\Integrations\TikTok\Tools\TiktokGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class TiktokToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'bearer_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
          'compatibility' => [
            'web_setup_supported' => true,
            'web_runtime_supported' => true,
            'cli_setup_supported' => true,
            'cli_runtime_supported' => true,
          ],
        ];
    }

    public function appName(): string
    {
        return 'tiktok';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'TikTok',
            'description' => 'TikTok Business advertising & content management',
            'icon' => 'ph:tiktok-logo',
            'logo' => 'simple-icons:tiktok',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'TikTok',
            'description' => 'Manage TikTok Business videos, ad campaigns, and advertisers via the Business API.',
            'icon' => 'ph:tiktok-logo',
            'logo' => 'simple-icons:tiktok',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://ads.tiktok.com/marketing_api/docs/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your TikTok Business API access token',
                'hint' => 'A long-lived access token with permissions for the Marketing API (advertiser management, campaign management, video upload).',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://business-api.tiktok.com/v1',
                'hint' => 'The TikTok Business API base URL including the API version.',
                'default' => 'https://business-api.tiktok.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://business-api.tiktok.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Access-Token' => $accessToken,
            ])->timeout(10)->get($baseUrl . '/user/info/');

            $json = $response->json();

            if (isset($json['code']) && $json['code'] !== 0) {
                return [
                    'success' => false,
                    'error' => $json['message'] ?? 'Unknown TikTok API error.',
                ];
            }

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach TikTok Business API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = $json['data']['display_name'] ?? $json['data']['email'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to TikTok Business API as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'tiktok_list_videos' => [
                'class' => TiktokListVideos::class,
                'type' => 'read',
                'name' => 'List Videos',
                'description' => 'List videos available for an advertiser in TikTok Business.',
                'icon' => 'ph:video',
            ],
            'tiktok_get_video' => [
                'class' => TiktokGetVideo::class,
                'type' => 'read',
                'name' => 'Get Video',
                'description' => 'Get details for a specific TikTok video.',
                'icon' => 'ph:video-camera',
            ],
            'tiktok_upload_video' => [
                'class' => TiktokUploadVideo::class,
                'type' => 'write',
                'name' => 'Upload Video',
                'description' => 'Upload a video to TikTok via URL for use in ads.',
                'icon' => 'ph:upload-simple',
            ],
            'tiktok_list_campaigns' => [
                'class' => TiktokListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List advertising campaigns for a TikTok advertiser.',
                'icon' => 'ph:megaphone',
            ],
            'tiktok_get_campaign' => [
                'class' => TiktokGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get details for a specific TikTok advertising campaign.',
                'icon' => 'ph:megaphone-simple',
            ],
            'tiktok_list_advertisers' => [
                'class' => TiktokListAdvertisers::class,
                'type' => 'read',
                'name' => 'List Advertisers',
                'description' => 'List advertisers accessible to the authenticated TikTok user.',
                'icon' => 'ph:buildings',
            ],
            'tiktok_get_current_user' => [
                'class' => TiktokGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s TikTok Business account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/tiktok.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://business-api.tiktok.com/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new TiktokService(
                accessToken: $creds->get('tiktok', 'access_token', '', $account),
                baseUrl: $creds->get('tiktok', 'base_url', 'https://business-api.tiktok.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(TiktokService::class));
    }
}
