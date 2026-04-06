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

class MailerSendToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * The application slug for this integration.
     */
    public function appName(): string
    {
        return 'mailer-send';
    }

    /**
     * Metadata shown in the app catalogue.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'send, messages, templates, domains, recipients',
            'description' => 'Email delivery & marketing',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:mailersend',
        ];
    }

    /**
     * Integration metadata including category and documentation URL.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'MailerSend',
            'description' => 'Transactional and marketing email delivery API',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:mailersend',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developers.mailersend.com/',
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
