<?php

namespace OpenCompany\Integrations\Gong;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Gong\Tools\GongListCalls;
use OpenCompany\Integrations\Gong\Tools\GongGetCall;
use OpenCompany\Integrations\Gong\Tools\GongListTranscripts;
use OpenCompany\Integrations\Gong\Tools\GongGetTranscript;
use OpenCompany\Integrations\Gong\Tools\GongListUsers;
use OpenCompany\Integrations\Gong\Tools\GongListDeals;
use OpenCompany\Integrations\Gong\Tools\GongListInteractions;
use OpenCompany\Integrations\Gong\Tools\GongGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class GongToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
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




/**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'gong';
    }

/**
     * Get metadata for display in the OpenCompany UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Gong',
            'description' => 'Revenue intelligence',
            'icon' => 'ph:phone-call',
            'logo' => 'simple-icons:gong',
        ];
    }

/**
     * Get integration metadata for the marketplace / integration catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Gong',
            'description' => 'Revenue intelligence platform — calls, deals, and customer interactions',
            'icon' => 'ph:phone-call',
            'logo' => 'simple-icons:gong',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://app.gong.io/settings/api',
        ];
    }/**
     * Get the configuration schema for Gong credentials.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_key',
                'type' => 'secret',
                'label' => 'Access Key',
                'placeholder' => 'Enter your Gong API access key',
                'hint' => 'Find your access key in Gong Settings → API → Company API Keys',
                'required' => true,
            ],
            [
                'key' => 'access_key_secret',
                'type' => 'secret',
                'label' => 'Access Key Secret',
                'placeholder' => 'Enter your Gong API access key secret',
                'hint' => 'The secret paired with your access key',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.gong.io',
                'hint' => 'Override only if using a Gong API proxy or alternative endpoint',
                'default' => 'https://api.gong.io',
            ],
        ];
    }

    /**
     * Test the Gong API connection using the provided credentials.
     *
     * @param  array  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessKey = $config['access_key'] ?? '';
        $accessKeySecret = $config['access_key_secret'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.gong.io', '/');

        if (empty($accessKey) || empty($accessKeySecret)) {
            return ['success' => false, 'error' => 'Access key and secret are both required'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($accessKey, $accessKeySecret)
              ->timeout(10)
              ->get($baseUrl . '/v2/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Gong API at {$baseUrl}. Check the URL and credentials.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['errors'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => is_string($error) ? $error : json_encode($error),
                ];
            }

            $userName = $json['firstName'] ?? $json['email'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Gong API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'access_key' => 'nullable|string',
            'access_key_secret' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of available Gong tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'gong_list_calls' => [
                'class' => GongListCalls::class,
                'type' => 'read',
                'name' => 'List Calls',
                'description' => 'List call recordings from Gong.',
                'icon' => 'ph:phone-call',
            ],
            'gong_get_call' => [
                'class' => GongGetCall::class,
                'type' => 'read',
                'name' => 'Get Call',
                'description' => 'Get detailed information about a specific call.',
                'icon' => 'ph:phone-call',
            ],
            'gong_list_transcripts' => [
                'class' => GongListTranscripts::class,
                'type' => 'read',
                'name' => 'List Transcripts',
                'description' => 'List call transcripts from Gong.',
                'icon' => 'ph:document-text',
            ],
            'gong_get_transcript' => [
                'class' => GongGetTranscript::class,
                'type' => 'read',
                'name' => 'Get Transcript',
                'description' => 'Get the full transcript of a specific call.',
                'icon' => 'ph:document-text',
            ],
            'gong_list_users' => [
                'class' => GongListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List Gong users in the workspace.',
                'icon' => 'ph:users',
            ],
            'gong_list_deals' => [
                'class' => GongListDeals::class,
                'type' => 'read',
                'name' => 'List Deals',
                'description' => 'List deals tracked in Gong.',
                'icon' => 'ph:handshake',
            ],
            'gong_list_interactions' => [
                'class' => GongListInteractions::class,
                'type' => 'read',
                'name' => 'List Interactions',
                'description' => 'List customer interactions tracked in Gong.',
                'icon' => 'ph:chat-circle-text',
            ],
            'gong_get_current_user' => [
                'class' => GongGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Gong user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/gong.md';
    }

    /**
     * Get the credential fields required by this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_key', 'type' => 'secret', 'label' => 'Access Key', 'required' => true],
            ['key' => 'access_key_secret', 'type' => 'secret', 'label' => 'Access Key Secret', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Gong API URL', 'required' => false, 'default' => 'https://api.gong.io'],
        ];
    }

    /**
     * Confirm this is a full integration (not just a set of tools).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  string  $class  The tool class to instantiate.
     * @param  array  $context  Context containing an optional 'account' key for multi-account support.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new GongService(
                accessKey: $creds->get('gong', 'access_key', '', $account),
                accessKeySecret: $creds->get('gong', 'access_key_secret', '', $account),
                baseUrl: $creds->get('gong', 'url', 'https://api.gong.io', $account),
            );

            return new $class($service);
        }

        return new $class(app(GongService::class));
    }
}
