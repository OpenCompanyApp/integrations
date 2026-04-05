<?php

namespace OpenCompany\Integrations\ConvertKit;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitCreateSubscriber;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitCreateTag;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitGetSubscriber;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitListForms;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitListSequences;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitListSubscribers;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitListTags;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitSubscribeToForm;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitTagSubscriber;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitUntagSubscriber;

/**
 * ConvertKit tool provider and configurable integration.
 *
 * Registers all ConvertKit tools, defines the configuration schema for
 * API key authentication, provides connection testing, and supports
 * multi-account resolution via the CredentialResolver.
 */
class ConvertKitToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Return the application name used for namespace routing.
     */
    public function appName(): string
    {
        return 'convertkit';
    }

    /**
     * Return short metadata for display in tool listings.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'subscribers, tags, forms, sequences',
            'description' => 'Email marketing & newsletters',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:convertkit',
        ];
    }

    /**
     * Return integration metadata for the marketplace / settings UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'ConvertKit',
            'description' => 'Email marketing platform for creators — manage subscribers, tags, forms, and sequences.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:convertkit',
            'category' => 'email_marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developers.convertkit.com/',
        ];
    }

    /**
     * Define the configuration fields required to set up the integration.
     *
     * @return array<int, array<string, mixed>> Configuration field definitions
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your ConvertKit API key',
                'hint' => 'Find your API key in ConvertKit Settings → Advanced.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to ConvertKit using the provided configuration.
     *
     * Makes a GET request to the /account endpoint to verify credentials.
     *
     * @param  array<string, mixed>  $config  Configuration values (must include api_key)
     * @return array{success: bool, message?: string, error?: string} Connection test result
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.convertkit.com/v3/account', [
                'api_key' => $apiKey,
            ]);

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "ConvertKit API error: " . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => 'Could not reach ConvertKit API. Check your API key and try again.',
                ];
            }

            $name = $json['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to ConvertKit as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Return Laravel validation rules for the configuration fields.
     *
     * @return array<string, string> Validation rules
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
        ];
    }

    /**
     * Return the list of tools provided by this integration.
     *
     * Each entry maps a tool key to its class, type, display name, description, and icon.
     *
     * @return array<string, array<string, mixed>> Tool definitions
     */
    public function tools(): array
    {
        return [
            'convertkit_list_subscribers' => [
                'class' => ConvertKitListSubscribers::class,
                'type' => 'read',
                'name' => 'List Subscribers',
                'description' => 'List subscribers with pagination and sorting.',
                'icon' => 'ph:users',
            ],
            'convertkit_get_subscriber' => [
                'class' => ConvertKitGetSubscriber::class,
                'type' => 'read',
                'name' => 'Get Subscriber',
                'description' => 'Get details for a single subscriber.',
                'icon' => 'ph:user',
            ],
            'convertkit_create_subscriber' => [
                'class' => ConvertKitCreateSubscriber::class,
                'type' => 'write',
                'name' => 'Create Subscriber',
                'description' => 'Create or update a subscriber by email.',
                'icon' => 'ph:user-plus',
            ],
            'convertkit_list_tags' => [
                'class' => ConvertKitListTags::class,
                'type' => 'read',
                'name' => 'List Tags',
                'description' => 'List all tags in the account.',
                'icon' => 'ph:tag',
            ],
            'convertkit_create_tag' => [
                'class' => ConvertKitCreateTag::class,
                'type' => 'write',
                'name' => 'Create Tag',
                'description' => 'Create a new tag.',
                'icon' => 'ph:tag',
            ],
            'convertkit_tag_subscriber' => [
                'class' => ConvertKitTagSubscriber::class,
                'type' => 'write',
                'name' => 'Tag Subscriber',
                'description' => 'Add a tag to a subscriber.',
                'icon' => 'ph:tag',
            ],
            'convertkit_untag_subscriber' => [
                'class' => ConvertKitUntagSubscriber::class,
                'type' => 'write',
                'name' => 'Untag Subscriber',
                'description' => 'Remove a tag from a subscriber.',
                'icon' => 'ph:tag',
            ],
            'convertkit_list_forms' => [
                'class' => ConvertKitListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List all forms in the account.',
                'icon' => 'ph:form',
            ],
            'convertkit_subscribe_to_form' => [
                'class' => ConvertKitSubscribeToForm::class,
                'type' => 'write',
                'name' => 'Subscribe to Form',
                'description' => 'Subscribe an email to a form.',
                'icon' => 'ph:envelope',
            ],
            'convertkit_list_sequences' => [
                'class' => ConvertKitListSequences::class,
                'type' => 'read',
                'name' => 'List Sequences',
                'description' => 'List all sequences (courses) in the account.',
                'icon' => 'ph:list-bullets',
            ],
        ];
    }

    /**
     * Return the path to the Lua API docs file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/convertkit.md';
    }

    /**
     * Return the credential fields needed for authentication.
     *
     * @return array<int, array<string, mixed>> Credential field definitions
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    /**
     * Indicate this is an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally resolving credentials for a specific account.
     *
     * When an account context is provided, credentials are resolved from the
     * CredentialResolver for that account. Otherwise the default service is used.
     *
     * @param  string  $class  The tool class to instantiate
     * @param  array<string, mixed>  $context  Context containing optional 'account' key
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ConvertKitService(
                apiKey: $creds->get('convertkit', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(ConvertKitService::class));
    }
}
