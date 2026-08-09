<?php

namespace OpenCompany\Integrations\Postmark;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Postmark\Tools\PostmarkGetCurrentUser;
use OpenCompany\Integrations\Postmark\Tools\PostmarkGetDeliveryStats;
use OpenCompany\Integrations\Postmark\Tools\PostmarkGetMessage;
use OpenCompany\Integrations\Postmark\Tools\PostmarkGetTemplate;
use OpenCompany\Integrations\Postmark\Tools\PostmarkListMessages;
use OpenCompany\Integrations\Postmark\Tools\PostmarkListServers;
use OpenCompany\Integrations\Postmark\Tools\PostmarkListTemplates;
use OpenCompany\Integrations\Postmark\Tools\PostmarkSendEmail;
use OpenCompany\Integrations\Postmark\Tools\PostmarkSendTemplate;

/**
 * Registers all Postmark tools and provides integration metadata, configuration schema, and connection testing.
 *
 * Exposes 9 tools covering messages, email sending, templates, delivery stats, and servers
 * via the ToolProvider contract.
 */
class PostmarkToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'credential_mode' => 'required_secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' => [
              0 => 'server_token',
              1 => 'account_token',
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
        return 'postmark';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Postmark',
            'description' => 'Email delivery service',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:postmark',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Postmark',
            'description' => 'Email delivery, messages, templates, and servers',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:postmark',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://postmarkapp.com/developer',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'server_token',
                'type' => 'secret',
                'label' => 'Server Token',
                'placeholder' => 'Your Postmark Server API token',
                'hint' => 'Found in Postmark Dashboard → Server → API Tokens.',
                'required' => true,
            ],
            [
                'key' => 'account_token',
                'type' => 'secret',
                'label' => 'Account Token',
                'placeholder' => 'Optional Postmark Account API token',
                'hint' => 'Required only for account-level endpoints such as listing servers.',
                'required' => false,
            ],
            [
                'key' => 'base_url',
                'type' => 'text',
                'label' => 'Base URL',
                'placeholder' => 'https://api.postmarkapp.com',
                'hint' => 'Postmark API base URL. Change only for custom endpoints.',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the Postmark connection using the provided credentials.
     *
     * Fetches the current server info and returns the server name.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'server_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $serverToken = $config['server_token'] ?? '';
        $baseUrl = $config['base_url'] ?? 'https://api.postmarkapp.com';

        if (empty($serverToken)) {
            return ['success' => false, 'error' => 'Server token is required. Find it in Postmark Dashboard → Server → API Tokens.'];
        }

        try {
            $url = rtrim($baseUrl, '/') . '/server';
            $response = Http::withHeaders([
                'X-Postmark-Server-Token' => $serverToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($url);

            if ($response->successful()) {
                $body = $response->json() ?? [];
                $name = $body['Name'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Postmark server: {$name}.",
                ];
            }

            return [
                'success' => false,
                'error' => 'Postmark API error (' . $response->status() . '): ' . $response->body(),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'server_token' => 'nullable|string',
            'account_token' => 'nullable|string',
            'base_url'     => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Messages
            'postmark_list_messages' => [
                'class' => PostmarkListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List outbound messages from Postmark.',
                'icon' => 'ph:envelope',
            ],
            'postmark_get_message' => [
                'class' => PostmarkGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get details for a specific Postmark message.',
                'icon' => 'ph:envelope-open',
            ],
            // Email
            'postmark_send_email' => [
                'class' => PostmarkSendEmail::class,
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send an email through Postmark.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'postmark_send_template' => [
                'class' => PostmarkSendTemplate::class,
                'type' => 'write',
                'name' => 'Send Template Email',
                'description' => 'Send an email using a Postmark template.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            // Delivery Stats
            'postmark_get_delivery_stats' => [
                'class' => PostmarkGetDeliveryStats::class,
                'type' => 'read',
                'name' => 'Get Delivery Stats',
                'description' => 'Get email delivery statistics for the Postmark server.',
                'icon' => 'ph:chart-bar',
            ],
            // Templates
            'postmark_list_templates' => [
                'class' => PostmarkListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List all email templates in Postmark.',
                'icon' => 'ph:file-text',
            ],
            'postmark_get_template' => [
                'class' => PostmarkGetTemplate::class,
                'type' => 'read',
                'name' => 'Get Template',
                'description' => 'Get details for a Postmark email template.',
                'icon' => 'ph:file',
            ],
            // Servers
            'postmark_list_servers' => [
                'class' => PostmarkListServers::class,
                'type' => 'read',
                'name' => 'List Servers',
                'description' => 'List servers in the Postmark account.',
                'icon' => 'ph:servers',
            ],
            // Account
            'postmark_get_current_user' => [
                'class' => PostmarkGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current Server',
                'description' => 'Get the current Postmark server info.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/postmark.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'server_token', 'type' => 'secret', 'label' => 'Server Token', 'required' => true],
            ['key' => 'account_token', 'type' => 'secret', 'label' => 'Account Token', 'required' => false],
            ['key' => 'base_url', 'type' => 'text', 'label' => 'Base URL', 'required' => false],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the PostmarkService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): PostmarkService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new PostmarkService(
                serverToken: $creds->get('postmark', 'server_token', '', $account),
                accountToken: $creds->get('postmark', 'account_token', '', $account),
                baseUrl: $creds->get('postmark', 'base_url', 'https://api.postmarkapp.com', $account),
            );
        }

        return app(PostmarkService::class);
    }
}
