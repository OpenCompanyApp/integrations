<?php

namespace OpenCompany\Integrations\Vault;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vault\Tools\VaultListSecrets;
use OpenCompany\Integrations\Vault\Tools\VaultGetSecret;
use OpenCompany\Integrations\Vault\Tools\VaultCreateSecret;
use OpenCompany\Integrations\Vault\Tools\VaultDeleteSecret;
use OpenCompany\Integrations\Vault\Tools\VaultListPolicies;
use OpenCompany\Integrations\Vault\Tools\VaultGetPolicy;
use OpenCompany\Integrations\Vault\Tools\VaultGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers the HashiCorp Vault integration and its tools with the integration platform.
 *
 * Provides secrets management (KV v2), policy management, and token
 * introspection tools via the Vault REST API.
 */
class VaultToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'vault';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'HashiCorp Vault',
            'description' => 'HashiCorp Vault integration for secrets management',
            'icon' => 'mdi:shield-lock-outline',
            'logo' => 'mdi:shield-lock-outline',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'HashiCorp Vault',
            'description' => 'Manage secrets, policies, and authentication tokens in HashiCorp Vault.',
            'icon' => 'mdi:shield-lock-outline',
            'logo' => 'mdi:shield-lock-outline',
            'category' => 'productivity',
            'docs_url' => 'https://developer.hashicorp.com/vault/api-docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'token',
                'type' => 'secret',
                'label' => 'Vault Token',
                'placeholder' => 's.abc123...',
                'hint' => 'Provide a Vault token with appropriate capabilities. Tokens can be generated via <code>vault token create</code> or obtained from your Vault administrator.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'text',
                'label' => 'Vault Server URL',
                'placeholder' => 'https://api.vaultproject.io/v1',
                'hint' => 'The base URL of your Vault server. Defaults to <code>https://api.vaultproject.io/v1</code> if left empty.',
                'required' => false,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $token = $config['token'] ?? '';
        $baseUrl = $config['base_url'] ?? 'https://api.vaultproject.io/v1';

        if (empty($token)) {
            return ['success' => false, 'error' => 'No Vault token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
                'Accept' => 'application/json',
            ])->timeout(10)->get(rtrim($baseUrl, '/') . '/auth/token/lookup-self');

            if ($response->successful()) {
                $data = $response->json();
                $displayName = $data['data']['display_name'] ?? 'unknown';
                $policies = implode(', ', $data['data']['policies'] ?? ['none']);

                return [
                    'success' => true,
                    'message' => "Connected to Vault as '{$displayName}' with policies: {$policies}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['errors'][0] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Vault API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'token' => 'nullable|string',
            'base_url' => 'nullable|string|url',
        ];
    }

    public function tools(): array
    {
        return [
            'vault_list_secrets' => [
                'class' => VaultListSecrets::class,
                'type' => 'read',
                'name' => 'List Secrets',
                'description' => 'List secrets at a given path in a KV v2 secrets engine.',
                'icon' => 'mdi:folder-outline',
            ],
            'vault_get_secret' => [
                'class' => VaultGetSecret::class,
                'type' => 'read',
                'name' => 'Get Secret',
                'description' => 'Get the latest version of a secret from a KV v2 secrets engine.',
                'icon' => 'mdi:key-outline',
            ],
            'vault_create_secret' => [
                'class' => VaultCreateSecret::class,
                'type' => 'write',
                'name' => 'Create Secret',
                'description' => 'Create or update a secret in a KV v2 secrets engine.',
                'icon' => 'mdi:key-plus-outline',
            ],
            'vault_delete_secret' => [
                'class' => VaultDeleteSecret::class,
                'type' => 'write',
                'name' => 'Delete Secret',
                'description' => 'Delete all versions and metadata of a secret from a KV v2 secrets engine.',
                'icon' => 'mdi:key-remove-outline',
            ],
            'vault_list_policies' => [
                'class' => VaultListPolicies::class,
                'type' => 'read',
                'name' => 'List Policies',
                'description' => 'List all ACL policies in Vault.',
                'icon' => 'mdi:shield-outline',
            ],
            'vault_get_policy' => [
                'class' => VaultGetPolicy::class,
                'type' => 'read',
                'name' => 'Get Policy',
                'description' => 'Get details of a specific ACL policy.',
                'icon' => 'mdi:shield-outline',
            ],
            'vault_get_current_user' => [
                'class' => VaultGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Look up the current Vault token\'s information.',
                'icon' => 'mdi:account-outline',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__) . '/script-docs/vault.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'token', 'type' => 'secret', 'label' => 'Vault Token', 'required' => true],
        ];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new VaultService(
                token: $creds->get('vault', 'token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(VaultService::class));
    }
}
