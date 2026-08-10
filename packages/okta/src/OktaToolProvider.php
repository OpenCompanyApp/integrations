<?php

namespace OpenCompany\Integrations\Okta;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Okta\Tools\OktaListUsers;
use OpenCompany\Integrations\Okta\Tools\OktaGetUser;
use OpenCompany\Integrations\Okta\Tools\OktaCreateUser;
use OpenCompany\Integrations\Okta\Tools\OktaUpdateUser;
use OpenCompany\Integrations\Okta\Tools\OktaDeactivateUser;
use OpenCompany\Integrations\Okta\Tools\OktaListGroups;
use OpenCompany\Integrations\Okta\Tools\OktaGetGroup;
use OpenCompany\Integrations\Okta\Tools\OktaAddUserToGroup;
use OpenCompany\Integrations\Okta\Tools\OktaListApplications;
use OpenCompany\Integrations\Okta\Tools\OktaGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class OktaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
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
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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
        return 'okta';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Okta',
            'description' => 'Identity & access management',
            'icon' => 'ph:shield-check',
            'logo' => 'simple-icons:okta',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Okta',
            'description' => 'Identity and access management — manage users, groups, and applications.',
            'icon' => 'ph:shield-check',
            'logo' => 'simple-icons:okta',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developer.okta.com/docs/reference/api/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Okta SSWS API token',
                'hint' => 'Generate an API token in Okta Admin under Security → API → Tokens → Create Token',
                'required' => true,
            ],
            [
                'key' => 'domain',
                'type' => 'string',
                'label' => 'Okta Domain',
                'placeholder' => 'example.okta.com',
                'hint' => 'Your Okta org domain (e.g., <code>example.okta.com</code> or <code>example.us.auth0.com</code>)',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $domain = rtrim($config['domain'] ?? '', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        if (empty($domain)) {
            return ['success' => false, 'error' => 'No Okta domain provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'SSWS ' . $apiToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get('https://' . $domain . '/api/v1/users/me');

            if ($response->successful()) {
                $user = $response->json();

                return [
                    'success' => true,
                    'message' => "Connected to Okta ({$domain}) as " . ($user['profile']['login'] ?? 'API token user') . '.',
                ];
            }

            $errorData = $response->json();
            $errorMsg = is_array($errorData) && isset($errorData['errorSummary'])
                ? $errorData['errorSummary']
                : "HTTP {$response->status()}";

            return ['success' => false, 'error' => "Okta API error: {$errorMsg}"];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_token' => 'required|string',
            'domain' => 'required|string',
        ];
    }

    public function tools(): array
    {
        return [
            'okta_list_users' => [
                'class' => OktaListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users in the Okta organization.',
                'icon' => 'ph:users',
            ],
            'okta_get_user' => [
                'class' => OktaGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get details for a specific Okta user.',
                'icon' => 'ph:user',
            ],
            'okta_get_current_user' => [
                'class' => OktaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Okta user.',
                'icon' => 'ph:user-circle',
            ],
            'okta_create_user' => [
                'class' => OktaCreateUser::class,
                'type' => 'write',
                'name' => 'Create User',
                'description' => 'Create a new user in Okta.',
                'icon' => 'ph:user-plus',
            ],
            'okta_update_user' => [
                'class' => OktaUpdateUser::class,
                'type' => 'write',
                'name' => 'Update User',
                'description' => 'Update an existing Okta user profile.',
                'icon' => 'ph:pencil-simple',
            ],
            'okta_deactivate_user' => [
                'class' => OktaDeactivateUser::class,
                'type' => 'write',
                'name' => 'Deactivate User',
                'description' => 'Deactivate an Okta user.',
                'icon' => 'ph:user-minus',
            ],
            'okta_list_groups' => [
                'class' => OktaListGroups::class,
                'type' => 'read',
                'name' => 'List Groups',
                'description' => 'List groups in the Okta organization.',
                'icon' => 'ph:users-three',
            ],
            'okta_get_group' => [
                'class' => OktaGetGroup::class,
                'type' => 'read',
                'name' => 'Get Group',
                'description' => 'Get details for a specific Okta group.',
                'icon' => 'ph:users-three',
            ],
            'okta_add_user_to_group' => [
                'class' => OktaAddUserToGroup::class,
                'type' => 'write',
                'name' => 'Add User to Group',
                'description' => 'Add a user to an Okta group.',
                'icon' => 'ph:user-plus',
            ],
            'okta_list_applications' => [
                'class' => OktaListApplications::class,
                'type' => 'read',
                'name' => 'List Applications',
                'description' => 'List applications in the Okta organization.',
                'icon' => 'ph:app-window',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/okta.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'domain', 'type' => 'string', 'label' => 'Okta Domain', 'required' => true],
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

            $service = new OktaService(
                apiToken: $creds->get('okta', 'api_token', '', $account),
                domain: $creds->get('okta', 'domain', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(OktaService::class));
    }
}
