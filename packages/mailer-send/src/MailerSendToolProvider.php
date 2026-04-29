<?php

namespace OpenCompany\Integrations\MailerSend;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListMessages;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetMessage;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendSendEmail;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListTemplates;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListDomains;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListRecipients;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class MailerSendToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    /**
     * The application slug for this integration.
     */
    public function appName(): string
    {
        return 'mailer-send';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Mailer Send',
            'description' => 'MailerSend integration for Laravel — send emails, list messages, templates, domains…',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Mailer Send',
            'description' => 'MailerSend integration for Laravel — send emails, list messages, templates, domains, and recipients.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Configuration schema for the MailerSend integration.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your MailerSend API token',
                'hint' => 'Generate an API token in your MailerSend dashboard under "API Tokens"',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the MailerSend API.
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.mailersend.com/v1/domains', [
                'limit' => 1,
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to MailerSend API successfully.',
                ];
            }

            return [
                'success' => false,
                'error' => "MailerSend API returned HTTP {$response->status()}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration.
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
        ];
    }

    /**
     * List all tools provided by this integration.
     */
    public function tools(): array
    {
        return [
            'mailer_send_list_messages' => [
                'class' => MailerSendListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List email messages from MailerSend.',
                'icon' => 'ph:envelope',
            ],
            'mailer_send_get_message' => [
                'class' => MailerSendGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get details of a specific email message.',
                'icon' => 'ph:envelope-open',
            ],
            'mailer_send_send_email' => [
                'class' => MailerSendSendEmail::class,
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send an email through MailerSend.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'mailer_send_list_templates' => [
                'class' => MailerSendListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List email templates from MailerSend.',
                'icon' => 'ph:file',
            ],
            'mailer_send_list_domains' => [
                'class' => MailerSendListDomains::class,
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List configured sending domains.',
                'icon' => 'ph:globe',
            ],
            'mailer_send_list_recipients' => [
                'class' => MailerSendListRecipients::class,
                'type' => 'read',
                'name' => 'List Recipients',
                'description' => 'List email recipients from MailerSend.',
                'icon' => 'ph:users',
            ],
            'mailer_send_get_current_user' => [
                'class' => MailerSendGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Health Check',
                'description' => 'Verify MailerSend API connectivity.',
                'icon' => 'ph:heartbeat',
            ],
        ];
    }

    /**
     * Path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mailer-send.md';
    }

    /**
     * Credential fields required by this integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
        ];
    }

    /**
     * Whether this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the appropriate service.
     *
     * @param  string  $class   The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional account info.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new MailerSendService(
                apiToken: $creds->get('mailer-send', 'api_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(MailerSendService::class));
    }
}
