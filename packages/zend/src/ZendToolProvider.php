<?php

namespace OpenCompany\Integrations\Zend;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Zend\Tools\ZendListCampaigns;
use OpenCompany\Integrations\Zend\Tools\ZendGetCampaign;
use OpenCompany\Integrations\Zend\Tools\ZendCreateCampaign;
use OpenCompany\Integrations\Zend\Tools\ZendListLists;
use OpenCompany\Integrations\Zend\Tools\ZendGetList;
use OpenCompany\Integrations\Zend\Tools\ZendListSubscribers;
use OpenCompany\Integrations\Zend\Tools\ZendGetSubscribers;
use OpenCompany\Integrations\Zend\Tools\ZendGetCurrentUser;

class ZendToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'zend';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'campaigns, lists, subscribers',
            'description' => 'Email marketing automation',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:zendesk',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Zendesk Marketing',
            'description' => 'Zendesk email marketing automation — manage campaigns, subscriber lists, and contacts.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:zendesk',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developer.zendesk.com/api-reference/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Zendesk access token',
                'hint' => 'Find your access token in your Zendesk admin settings under "API" or "OAuth Tokens"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.zendesk.com/v1',
                'hint' => 'The Zendesk API base URL. Change only if using a custom endpoint.',
                'default' => 'https://api.zendesk.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.zendesk.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Zendesk API at {$baseUrl}. Check the URL and access token.",
                ];
            }

            $email = $json['email'] ?? $json['data']['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Zendesk API as {$email}.",
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
            'zend_list_campaigns' => [
                'class' => ZendListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List all email marketing campaigns.',
                'icon' => 'ph:envelope',
            ],
            'zend_get_campaign' => [
                'class' => ZendGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get details for a specific campaign.',
                'icon' => 'ph:envelope',
            ],
            'zend_create_campaign' => [
                'class' => ZendCreateCampaign::class,
                'type' => 'write',
                'name' => 'Create Campaign',
                'description' => 'Create a new email marketing campaign.',
                'icon' => 'ph:plus-circle',
            ],
            'zend_list_lists' => [
                'class' => ZendListLists::class,
                'type' => 'read',
                'name' => 'List Subscriber Lists',
                'description' => 'List all subscriber lists.',
                'icon' => 'ph:list',
            ],
            'zend_get_list' => [
                'class' => ZendGetList::class,
                'type' => 'read',
                'name' => 'Get Subscriber List',
                'description' => 'Get details for a specific subscriber list.',
                'icon' => 'ph:list',
            ],
            'zend_list_subscribers' => [
                'class' => ZendListSubscribers::class,
                'type' => 'read',
                'name' => 'List Subscribers',
                'description' => 'List subscribers on a list.',
                'icon' => 'ph:users',
            ],
            'zend_get_subscribers' => [
                'class' => ZendGetSubscribers::class,
                'type' => 'read',
                'name' => 'Get Subscriber',
                'description' => 'Get details for a specific subscriber.',
                'icon' => 'ph:user',
            ],
            'zend_get_current_user' => [
                'class' => ZendGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s account details.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zend.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.zendesk.com/v1'],
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

            $service = new ZendService(
                accessToken: $creds->get('zend', 'access_token', '', $account),
                baseUrl: $creds->get('zend', 'url', 'https://api.zendesk.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(ZendService::class));
    }
}
