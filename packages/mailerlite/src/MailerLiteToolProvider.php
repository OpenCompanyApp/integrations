<?php

namespace OpenCompany\Integrations\MailerLite;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\MailerLite\Tools\MailerLiteAddSubscriberToGroup;
use OpenCompany\Integrations\MailerLite\Tools\MailerLiteCreateSubscriber;
use OpenCompany\Integrations\MailerLite\Tools\MailerLiteDeleteSubscriber;
use OpenCompany\Integrations\MailerLite\Tools\MailerLiteGetCurrentUser;
use OpenCompany\Integrations\MailerLite\Tools\MailerLiteGetSubscriber;
use OpenCompany\Integrations\MailerLite\Tools\MailerLiteListGroups;
use OpenCompany\Integrations\MailerLite\Tools\MailerLiteListSubscribers;
use OpenCompany\Integrations\MailerLite\Tools\MailerLiteUpdateSubscriber;

/**
 * Tool provider for the MailerLite email marketing integration.
 *
 * Registers subscriber and group management tools, provides the configuration
 * schema for API key auth, and supports multi-account credential resolution.
 */
class MailerLiteToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the integration app name identifier.
     */
    public function appName(): string
    {
        return 'mailerlite';
    }

    /**
     * Get short metadata for display in tool listings.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'subscribers, groups',
            'description' => 'Email marketing',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:mailerlite',
        ];
    }

    /**
     * Get full integration metadata for the marketplace / settings UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'MailerLite',
            'description' => 'Email marketing and subscriber management',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:mailerlite',
            'category' => 'email',
            'badge' => 'verified',
            'docs_url' => 'https://developers.mailerlite.com/',
        ];
    }

    /**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your MailerLite API key',
                'hint' => 'Generate an API key in your MailerLite account under Integrations → API',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection by fetching the current authenticated user.
     *
     * @param  array<string, mixed>  $config  Integration configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.mailerlite.com/api/v2/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => 'Could not reach MailerLite API. Check your connection.',
                ];
            }

            $accountName = $json['account']['name'] ?? $json['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to MailerLite as \"{$accountName}\".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the integration configuration.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'mailerlite_list_subscribers' => [
                'class' => MailerLiteListSubscribers::class,
                'type' => 'read',
                'name' => 'List Subscribers',
                'description' => 'List subscribers with optional pagination and status filtering.',
                'icon' => 'ph:users',
            ],
            'mailerlite_get_subscriber' => [
                'class' => MailerLiteGetSubscriber::class,
                'type' => 'read',
                'name' => 'Get Subscriber',
                'description' => 'Get details for a single subscriber by ID.',
                'icon' => 'ph:user',
            ],
            'mailerlite_create_subscriber' => [
                'class' => MailerLiteCreateSubscriber::class,
                'type' => 'write',
                'name' => 'Create Subscriber',
                'description' => 'Add a new subscriber to the audience.',
                'icon' => 'ph:user-plus',
            ],
            'mailerlite_update_subscriber' => [
                'class' => MailerLiteUpdateSubscriber::class,
                'type' => 'write',
                'name' => 'Update Subscriber',
                'description' => 'Update an existing subscriber’s name or custom fields.',
                'icon' => 'ph:pencil',
            ],
            'mailerlite_delete_subscriber' => [
                'class' => MailerLiteDeleteSubscriber::class,
                'type' => 'write',
                'name' => 'Delete Subscriber',
                'description' => 'Remove a subscriber from the audience.',
                'icon' => 'ph:trash',
            ],
            'mailerlite_list_groups' => [
                'class' => MailerLiteListGroups::class,
                'type' => 'read',
                'name' => 'List Groups',
                'description' => 'List subscriber groups (segments).',
                'icon' => 'ph:folders',
            ],
            'mailerlite_add_subscriber_to_group' => [
                'class' => MailerLiteAddSubscriberToGroup::class,
                'type' => 'write',
                'name' => 'Add Subscriber to Group',
                'description' => 'Add a subscriber to a group by email.',
                'icon' => 'ph:user-plus',
            ],
            'mailerlite_get_current_user' => [
                'class' => MailerLiteGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated MailerLite account info.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    /**
     * Get the path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mailerlite.md';
    }

    /**
     * Get the credential fields required for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    /**
     * Confirm this class represents an integration (not just standalone tools).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally resolved for a specific account.
     *
     * Supports multi-account by resolving credentials per-account when
     * an account context is provided, falling back to the app container
     * singleton for the default account.
     *
     * @param  string  $class  Fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Context with optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new MailerLiteService(
                apiKey: $creds->get('mailerlite', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(MailerLiteService::class));
    }
}
