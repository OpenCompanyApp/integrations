<?php

namespace OpenCompany\Integrations\ZohoMail;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ZohoMail\Tools\ZohoMailListMessages;
use OpenCompany\Integrations\ZohoMail\Tools\ZohoMailGetMessage;
use OpenCompany\Integrations\ZohoMail\Tools\ZohoMailSendMessage;
use OpenCompany\Integrations\ZohoMail\Tools\ZohoMailListFolders;
use OpenCompany\Integrations\ZohoMail\Tools\ZohoMailListTasks;
use OpenCompany\Integrations\ZohoMail\Tools\ZohoMailGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class ZohoMailToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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




/**
     * Get the internal app name identifier.
     */
    public function appName(): string
    {
        return 'zoho-mail';
    }

/**
     * Get metadata for the app tile display.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Zoho Mail',
            'description' => 'Email communication',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:zoho',
        ];
    }

/**
     * Get metadata for the integration catalog.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Zoho Mail',
            'description' => 'Email communication, folders, and task management',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:zoho',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://www.zoho.com/mail/help/api/getmails.html',
        ];
    }/**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Zoho Mail OAuth access token',
                'hint' => 'Generate an OAuth access token in your Zoho developer console with Mail scope',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://mail.zoho.com/api/v1',
                'hint' => 'Use <code>https://mail.zoho.com/api/v1</code> for global, or your regional endpoint (e.g. <code>https://mail.zoho.eu/api/v1</code>)',
                'default' => 'https://mail.zoho.com/api/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Zoho Mail API.
     *
     * @param array<string, mixed> $config Configuration values to test
     *
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://mail.zoho.com/api/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/accounts');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Zoho Mail API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Zoho Mail API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the integration configuration.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'zohomail_list_messages' => [
                'class' => ZohoMailListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List email messages in a folder.',
                'icon' => 'ph:envelope',
            ],
            'zohomail_get_message' => [
                'class' => ZohoMailGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get a single email message by ID.',
                'icon' => 'ph:envelope-open',
            ],
            'zohomail_send_message' => [
                'class' => ZohoMailSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a new email message.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'zohomail_list_folders' => [
                'class' => ZohoMailListFolders::class,
                'type' => 'read',
                'name' => 'List Folders',
                'description' => 'List all email folders.',
                'icon' => 'ph:folder',
            ],
            'zohomail_list_tasks' => [
                'class' => ZohoMailListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks from Zoho Mail.',
                'icon' => 'ph:list-checks',
            ],
            'zohomail_get_current_user' => [
                'class' => ZohoMailGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get current user account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zoho-mail.md';
    }

    /**
     * Get the credential fields required by this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://mail.zoho.com/api/v1'],
        ];
    }

    /**
     * Confirm this class is an integration provider.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance with optional account-specific context.
     *
     * @param string               $class   Fully-qualified tool class name
     * @param array<string, mixed> $context Optional context with 'account' for multi-account support
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ZohoMailService, with optional account-specific credentials.
     *
     * @param array<string, mixed> $context Context containing optional 'account' key
     */
    private function resolveService(array $context = []): ZohoMailService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new ZohoMailService(
                accessToken: $creds->get('zoho-mail', 'access_token', '', $account),
                baseUrl: $creds->get('zoho-mail', 'url', 'https://mail.zoho.com/api/v1', $account),
            );
        }

        return app(ZohoMailService::class);
    }
}
