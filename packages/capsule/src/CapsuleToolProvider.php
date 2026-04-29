<?php

namespace OpenCompany\Integrations\Capsule;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Capsule\Tools\CapsuleListContacts;
use OpenCompany\Integrations\Capsule\Tools\CapsuleGetContact;
use OpenCompany\Integrations\Capsule\Tools\CapsuleCreateContact;
use OpenCompany\Integrations\Capsule\Tools\CapsuleListOpportunities;
use OpenCompany\Integrations\Capsule\Tools\CapsuleGetOpportunity;
use OpenCompany\Integrations\Capsule\Tools\CapsuleListTasks;
use OpenCompany\Integrations\Capsule\Tools\CapsuleGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * CapsuleToolProvider — registers Capsule CRM tools with the integration registry.
 *
 * Implements ConfigurableIntegration for multi-account support, connection testing,
 * and configuration schema for the OpenCompany Integrations UI.
 */
class CapsuleToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'capsule';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Capsule CRM',
            'description' => 'CRM & sales',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:capsulecrm',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Capsule CRM',
            'description' => 'Simple, effective CRM for small businesses — manage contacts, sales pipelines, and tasks.',
            'icon' => 'ph:address-book',
            'logo' => 'simple-icons:capsulecrm',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://developer.capsulecrm.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Capsule CRM API access token',
                'hint' => 'Generate a personal access token in Capsule under <strong>My Preferences → API Authentication Tokens</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.capsulecrm.com/api/v2',
                'hint' => 'Use the default Capsule CRM API URL, or override for a custom endpoint',
                'default' => 'https://api.capsulecrm.com/api/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.capsulecrm.com/api/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Capsule CRM API at {$baseUrl}. Check the URL.",
                ];
            }

            $userName = ($json['user']['firstName'] ?? '') . ' ' . ($json['user']['lastName'] ?? '');
            $userName = trim($userName) ?: 'Unknown user';

            return [
                'success' => true,
                'message' => "Connected to Capsule CRM as {$userName}.",
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
            'capsule_list_contacts' => [
                'class' => CapsuleListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts (people and organisations) from Capsule CRM.',
                'icon' => 'ph:users',
            ],
            'capsule_get_contact' => [
                'class' => CapsuleGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Retrieve a single contact (party) by ID.',
                'icon' => 'ph:user',
            ],
            'capsule_create_contact' => [
                'class' => CapsuleCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new person or organisation contact.',
                'icon' => 'ph:user-plus',
            ],
            'capsule_list_opportunities' => [
                'class' => CapsuleListOpportunities::class,
                'type' => 'read',
                'name' => 'List Opportunities',
                'description' => 'List sales opportunities from Capsule CRM.',
                'icon' => 'ph:currency-dollar',
            ],
            'capsule_get_opportunity' => [
                'class' => CapsuleGetOpportunity::class,
                'type' => 'read',
                'name' => 'Get Opportunity',
                'description' => 'Retrieve a single sales opportunity by ID.',
                'icon' => 'ph:currency-dollar',
            ],
            'capsule_list_tasks' => [
                'class' => CapsuleListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks from Capsule CRM.',
                'icon' => 'ph:check-square',
            ],
            'capsule_get_current_user' => [
                'class' => CapsuleGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Capsule CRM user.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/capsule.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.capsulecrm.com/api/v2'],
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

            $service = new CapsuleService(
                accessToken: $creds->get('capsule', 'access_token', '', $account),
                baseUrl: $creds->get('capsule', 'url', 'https://api.capsulecrm.com/api/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(CapsuleService::class));
    }
}
