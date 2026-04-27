<?php

namespace OpenCompany\Integrations\Memberstack;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Memberstack\Tools\MemberstackListMembers;
use OpenCompany\Integrations\Memberstack\Tools\MemberstackGetMember;
use OpenCompany\Integrations\Memberstack\Tools\MemberstackCreateMember;
use OpenCompany\Integrations\Memberstack\Tools\MemberstackUpdateMember;
use OpenCompany\Integrations\Memberstack\Tools\MemberstackDeleteMember;
use OpenCompany\Integrations\Memberstack\Tools\MemberstackListPlans;
use OpenCompany\Integrations\Memberstack\Tools\MemberstackGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class MemberstackToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'memberstack';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'members, plans, auth',
            'description' => 'Membership & authentication',
            'icon' => 'ph:shield-check',
            'logo' => 'simple-icons:memberstack',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Memberstack',
            'description' => 'Membership and authentication platform — manage members, plans, and access',
            'icon' => 'ph:shield-check',
            'logo' => 'simple-icons:memberstack',
            'category' => 'authentication',
            'badge' => 'verified',
            'docs_url' => 'https://docs.memberstack.com/hc/en-us/articles/13392339792307-API',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Memberstack access token',
                'hint' => 'Find your access token in Memberstack Dashboard under Settings > API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.memberstack.com',
                'hint' => 'Defaults to <code>https://api.memberstack.com</code>. Change only if using a custom endpoint.',
                'default' => 'https://api.memberstack.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.memberstack.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/plans');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Memberstack API at {$baseUrl}.",
                ];
            }

            return [
                'success' => false,
                'error' => "API returned HTTP {$response->status()}: " . ($response->json('message') ?? $response->body()),
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
            'memberstack_list_members' => [
                'class' => MemberstackListMembers::class,
                'type' => 'read',
                'name' => 'List Members',
                'description' => 'List members with pagination.',
                'icon' => 'ph:users',
            ],
            'memberstack_get_member' => [
                'class' => MemberstackGetMember::class,
                'type' => 'read',
                'name' => 'Get Member',
                'description' => 'Get a single member by ID.',
                'icon' => 'ph:user',
            ],
            'memberstack_create_member' => [
                'class' => MemberstackCreateMember::class,
                'type' => 'write',
                'name' => 'Create Member',
                'description' => 'Create a new member with email, optional password, plan, and metadata.',
                'icon' => 'ph:user-plus',
            ],
            'memberstack_update_member' => [
                'class' => MemberstackUpdateMember::class,
                'type' => 'write',
                'name' => 'Update Member',
                'description' => 'Update an existing member\'s email, plan, or metadata.',
                'icon' => 'ph:pencil',
            ],
            'memberstack_delete_member' => [
                'class' => MemberstackDeleteMember::class,
                'type' => 'write',
                'name' => 'Delete Member',
                'description' => 'Delete a member by ID.',
                'icon' => 'ph:trash',
            ],
            'memberstack_list_plans' => [
                'class' => MemberstackListPlans::class,
                'type' => 'read',
                'name' => 'List Plans',
                'description' => 'List all available membership plans.',
                'icon' => 'ph:list-bullets',
            ],
            'memberstack_get_current_user' => [
                'class' => MemberstackGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/memberstack.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.memberstack.com'],
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

            $service = new MemberstackService(
                accessToken: $creds->get('memberstack', 'access_token', '', $account),
                baseUrl: $creds->get('memberstack', 'url', 'https://api.memberstack.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(MemberstackService::class));
    }
}
