<?php

namespace OpenCompany\Integrations\Mailtrap;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mailtrap\Tools\MailtrapListInboxes;
use OpenCompany\Integrations\Mailtrap\Tools\MailtrapGetInbox;
use OpenCompany\Integrations\Mailtrap\Tools\MailtrapListMessages;
use OpenCompany\Integrations\Mailtrap\Tools\MailtrapGetMessage;
use OpenCompany\Integrations\Mailtrap\Tools\MailtrapSendTestEmail;
use OpenCompany\Integrations\Mailtrap\Tools\MailtrapListSuppressions;
use OpenCompany\Integrations\Mailtrap\Tools\MailtrapGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class MailtrapToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'mailtrap';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Mailtrap',
            'description' => 'Email testing & delivery',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:mailtrap',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mailtrap',
            'description' => 'Email testing and delivery platform — manage inboxes, messages, and suppressions.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:mailtrap',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://api-docs.mailtrap.io/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Mailtrap API token',
                'hint' => 'Generate an API token in Mailtrap under <strong>Settings → API Tokens</strong>',
                'required' => true,
            ],
        ];
    }

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
            ])->timeout(10)->get('https://mailtrap.io/api/v3/user');

            if ($response->successful()) {
                $user = $response->json();
                $email = $user['email'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Mailtrap as {$email}.",
                ];
            }

            $error = $response->json('error') ?? $response->body();

            return [
                'success' => false,
                'error' => "Mailtrap API returned {$response->status()}: " . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'mailtrap_list_inboxes' => [
                'class' => MailtrapListInboxes::class,
                'type' => 'read',
                'name' => 'List Inboxes',
                'description' => 'List all inboxes in the Mailtrap account.',
                'icon' => 'ph:inbox',
            ],
            'mailtrap_get_inbox' => [
                'class' => MailtrapGetInbox::class,
                'type' => 'read',
                'name' => 'Get Inbox',
                'description' => 'Get details for a specific Mailtrap inbox.',
                'icon' => 'ph:inbox',
            ],
            'mailtrap_list_messages' => [
                'class' => MailtrapListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List messages in a Mailtrap inbox.',
                'icon' => 'ph:envelope',
            ],
            'mailtrap_get_message' => [
                'class' => MailtrapGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get a single message from a Mailtrap inbox.',
                'icon' => 'ph:envelope-open',
            ],
            'mailtrap_send_test_email' => [
                'class' => MailtrapSendTestEmail::class,
                'type' => 'write',
                'name' => 'Send Test Email',
                'description' => 'Send a test email through Mailtrap.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'mailtrap_list_suppressions' => [
                'class' => MailtrapListSuppressions::class,
                'type' => 'read',
                'name' => 'List Suppressions',
                'description' => 'List suppressions (blocked recipients) for a Mailtrap inbox.',
                'icon' => 'ph:prohibit',
            ],
            'mailtrap_get_current_user' => [
                'class' => MailtrapGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current Mailtrap user profile and account info.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mailtrap.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
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

            $service = new MailtrapService(
                apiToken: $creds->get('mailtrap', 'api_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(MailtrapService::class));
    }
}
