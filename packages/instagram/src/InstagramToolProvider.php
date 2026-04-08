<?php

namespace OpenCompany\Integrations\Instagram;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Instagram\Tools\InstagramListMedia;
use OpenCompany\Integrations\Instagram\Tools\InstagramGetMedia;
use OpenCompany\Integrations\Instagram\Tools\InstagramCreateMedia;
use OpenCompany\Integrations\Instagram\Tools\InstagramListComments;
use OpenCompany\Integrations\Instagram\Tools\InstagramGetComment;
use OpenCompany\Integrations\Instagram\Tools\InstagramListInsights;
use OpenCompany\Integrations\Instagram\Tools\InstagramGetCurrentUser;

class InstagramToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'instagram';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'media, comments, insights',
            'description' => 'Social media publishing & analytics',
            'icon' => 'ph:instagram-logo',
            'logo' => 'simple-icons:instagram',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Instagram',
            'description' => 'Instagram Graph API — publish media, manage comments, track insights, and view account metrics for Instagram Business and Creator accounts.',
            'icon' => 'ph:instagram-logo',
            'logo' => 'simple-icons:instagram',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developers.facebook.com/docs/instagram-api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Instagram Graph API access token',
                'hint' => 'Generate a long-lived access token via the Facebook developer portal or OAuth 2.0',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://graph.instagram.com/v1',
                'hint' => 'Use <code>https://graph.instagram.com/v1</code> for the standard Graph API, or a custom URL if applicable',
                'default' => 'https://graph.instagram.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://graph.instagram.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me', [
                'fields' => 'id,username',
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Instagram API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error']['message'] ?? $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Instagram API returned an error: " . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $username = $json['username'] ?? '';

            return [
                'success' => true,
                'message' => "Connected to Instagram API" . ($username ? " as @{$username}" : '') . ".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'instagram_list_media' => [
                'class' => InstagramListMedia::class,
                'type' => 'read',
                'name' => 'List Media',
                'description' => 'List media published by the authenticated Instagram user.',
                'icon' => 'ph:images',
            ],
            'instagram_get_media' => [
                'class' => InstagramGetMedia::class,
                'type' => 'read',
                'name' => 'Get Media',
                'description' => 'Get details of a specific media item by ID.',
                'icon' => 'ph:image',
            ],
            'instagram_create_media' => [
                'class' => InstagramCreateMedia::class,
                'type' => 'write',
                'name' => 'Create Media',
                'description' => 'Publish a new media item (photo or video) to Instagram.',
                'icon' => 'ph:plus-circle',
            ],
            'instagram_list_comments' => [
                'class' => InstagramListComments::class,
                'type' => 'read',
                'name' => 'List Comments',
                'description' => 'List comments on a specific media item.',
                'icon' => 'ph:chat-circle-text',
            ],
            'instagram_get_comment' => [
                'class' => InstagramGetComment::class,
                'type' => 'read',
                'name' => 'Get Comment',
                'description' => 'Get details of a specific comment by ID.',
                'icon' => 'ph:chat-circle',
            ],
            'instagram_list_insights' => [
                'class' => InstagramListInsights::class,
                'type' => 'read',
                'name' => 'List Insights',
                'description' => 'Get account-level insights and performance metrics.',
                'icon' => 'ph:chart-line-up',
            ],
            'instagram_get_current_user' => [
                'class' => InstagramGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Instagram user profile.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/instagram.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://graph.instagram.com/v1'],
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

            $service = new InstagramService(
                accessToken: $creds->get('instagram', 'access_token', '', $account),
                baseUrl: $creds->get('instagram', 'url', 'https://graph.instagram.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(InstagramService::class));
    }
}
