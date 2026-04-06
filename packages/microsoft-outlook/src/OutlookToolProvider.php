<?php

namespace OpenCompany\Integrations\MicrosoftOutlook;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\MicrosoftOutlook\Tools\OutlookListMessages;
use OpenCompany\Integrations\MicrosoftOutlook\Tools\OutlookGetMessage;
use OpenCompany\Integrations\MicrosoftOutlook\Tools\OutlookSendMessage;
use OpenCompany\Integrations\MicrosoftOutlook\Tools\OutlookListCalendars;
use OpenCompany\Integrations\MicrosoftOutlook\Tools\OutlookListEvents;
use OpenCompany\Integrations\MicrosoftOutlook\Tools\OutlookCreateEvent;
use OpenCompany\Integrations\MicrosoftOutlook\Tools\OutlookGetCurrentUser;

/**
 * Tool provider for the Microsoft Outlook integration.
 *
 * Implements ConfigurableIntegration for multi-account support, configuration
 * schema, connection testing, and validation rules.
 */
class OutlookToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Machine-name identifier for this integration.
     */
    public function appName(): string
    {
        return 'microsoft-outlook';
    }

    /**
     * Short metadata shown in tool listings and UI.
     */
    public function appMeta(): array
    {
        return [
            'label'       => 'email, calendar, contacts',
            'description' => 'Microsoft Outlook',
            'icon'        => 'ph:envelope',
            'logo'        => 'simple-icons:microsoftoutlook',
        ];
    }

    /**
     * Integration metadata for the Integrations UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name'        => 'Microsoft Outlook',
            'description' => 'Read and send email, manage calendars and events via Microsoft Graph',
            'icon'        => 'ph:envelope',
            'logo'        => 'simple-icons:microsoftoutlook',
            'category'    => 'email',
            'badge'       => 'verified',
            'docs_url'    => 'https://learn.microsoft.com/en-us/graph/api/overview',
        ];
    }

    /**
     * Configuration schema for the Integrations UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key'         => 'access_token',
                'type'        => 'secret',
                'label'       => 'Access Token',
                'placeholder' => 'Enter your Microsoft Graph OAuth2 access token',
                'hint'        => 'Provide a valid OAuth2 access token with Mail.Read, Mail.Send, Calendars.Read, Calendars.ReadWrite, and User.Read scopes',
                'required'    => true,
            ],
            [
                'key'         => 'base_url',
                'type'        => 'url',
                'label'       => 'Graph API Base URL',
                'placeholder' => 'https://graph.microsoft.com/v1.0',
                'hint'        => 'Use <code>https://graph.microsoft.com/v1.0</code> for global, or a sovereign-cloud endpoint',
                'default'     => 'https://graph.microsoft.com/v1.0',
            ],
        ];
    }

    /**
     * Test the connection by calling the /me endpoint.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://graph.microsoft.com/v1.0', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type'  => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            if (!$response->successful()) {
                $json = $response->json();
                $error = $json['error']['message'] ?? "HTTP {$response->status()}";

                return [
                    'success' => false,
                    'error'   => "Microsoft Graph API error: {$error}",
                ];
            }

            $user = $response->json();
            $displayName = $user['displayName'] ?? 'Unknown';
            $mail = $user['mail'] ?? $user['userPrincipalName'] ?? '';

            return [
                'success' => true,
                'message' => "Connected as {$displayName}" . ($mail ? " ({$mail})" : ''),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url'     => 'nullable|url',
        ];
    }

    /**
     * Return all tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'outlook_list_messages' => [
                'class'       => OutlookListMessages::class,
                'type'        => 'read',
                'name'        => 'List Messages',
                'description' => 'List email messages in the mailbox.',
                'icon'        => 'ph:envelope',
            ],
            'outlook_get_message' => [
                'class'       => OutlookGetMessage::class,
                'type'        => 'read',
                'name'        => 'Get Message',
                'description' => 'Retrieve a single email message by id.',
                'icon'        => 'ph:envelope-open',
            ],
            'outlook_send_message' => [
                'class'       => OutlookSendMessage::class,
                'type'        => 'write',
                'name'        => 'Send Message',
                'description' => 'Send an email message.',
                'icon'        => 'ph:paper-plane-tilt',
            ],
            'outlook_list_calendars' => [
                'class'       => OutlookListCalendars::class,
                'type'        => 'read',
                'name'        => 'List Calendars',
                'description' => 'List the user\'s calendars.',
                'icon'        => 'ph:calendar',
            ],
            'outlook_list_events' => [
                'class'       => OutlookListEvents::class,
                'type'        => 'read',
                'name'        => 'List Events',
                'description' => 'List events on the default calendar.',
                'icon'        => 'ph:calendar-dots',
            ],
            'outlook_create_event' => [
                'class'       => OutlookCreateEvent::class,
                'type'        => 'write',
                'name'        => 'Create Event',
                'description' => 'Create a new calendar event.',
                'icon'        => 'ph:calendar-plus',
            ],
            'outlook_get_current_user' => [
                'class'       => OutlookGetCurrentUser::class,
                'type'        => 'read',
                'name'        => 'Get Current User',
                'description' => 'Get the signed-in user\'s profile.',
                'icon'        => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/microsoft-outlook.md';
    }

    /**
     * Credential fields for multi-account setup.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Graph API URL', 'required' => false, 'default' => 'https://graph.microsoft.com/v1.0'],
        ];
    }

    /**
     * Whether this class represents an integration (always true).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool class, optionally with account-specific credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new OutlookService(
                accessToken: $creds->get('microsoft-outlook', 'access_token', '', $account),
                baseUrl: $creds->get('microsoft-outlook', 'base_url', 'https://graph.microsoft.com/v1.0', $account),
            );

            return new $class($service);
        }

        return new $class(app(OutlookService::class));
    }
}
