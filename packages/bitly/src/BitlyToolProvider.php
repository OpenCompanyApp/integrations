<?php

namespace OpenCompany\Integrations\Bitly;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Bitly\Tools\BitlyAddCustomBitlink;
use OpenCompany\Integrations\Bitly\Tools\BitlyApiDelete;
use OpenCompany\Integrations\Bitly\Tools\BitlyApiGet;
use OpenCompany\Integrations\Bitly\Tools\BitlyApiPatch;
use OpenCompany\Integrations\Bitly\Tools\BitlyApiPost;
use OpenCompany\Integrations\Bitly\Tools\BitlyCreateOrganizationWebhook;
use OpenCompany\Integrations\Bitly\Tools\BitlyCreateQrCode;
use OpenCompany\Integrations\Bitly\Tools\BitlyExpandBitlink;
use OpenCompany\Integrations\Bitly\Tools\BitlyGetClickCountries;
use OpenCompany\Integrations\Bitly\Tools\BitlyGetClickReferrers;
use OpenCompany\Integrations\Bitly\Tools\BitlyGetClickSummary;
use OpenCompany\Integrations\Bitly\Tools\BitlyShortenLink;
use OpenCompany\Integrations\Bitly\Tools\BitlyGetLink;
use OpenCompany\Integrations\Bitly\Tools\BitlyUpdateLink;
use OpenCompany\Integrations\Bitly\Tools\BitlyGetClicks;
use OpenCompany\Integrations\Bitly\Tools\BitlyListGroups;
use OpenCompany\Integrations\Bitly\Tools\BitlyGetGroup;
use OpenCompany\Integrations\Bitly\Tools\BitlyCreateBitlink;
use OpenCompany\Integrations\Bitly\Tools\BitlyGetCurrentUser;
use OpenCompany\Integrations\Bitly\Tools\BitlyGetQrCode;
use OpenCompany\Integrations\Bitly\Tools\BitlyListGroupBitlinks;
use OpenCompany\Integrations\Bitly\Tools\BitlyListOrganizationWebhooks;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class BitlyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'bearer_token',
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
     * Get the application identifier for this integration.
     *
     * @return string The integration app name
     */
    public function appName(): string
    {
        return 'bitly';
    }

/**
     * Get metadata for display in the OpenCompany UI.
     *
     * @return array UI metadata (label, description, icons)
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Bitly',
            'description' => 'Link management',
            'icon' => 'ph:link',
            'logo' => 'simple-icons:bitly',
        ];
    }

/**
     * Get integration metadata for the OpenCompany integrations directory.
     *
     * @return array Integration metadata (name, description, category, etc.)
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Bitly',
            'description' => 'URL shortening and link management platform',
            'icon' => 'ph:link',
            'logo' => 'simple-icons:bitly',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://dev.bitly.com/api-reference',
        ];
    }/**
     * Get the configuration schema for the Bitly integration.
     *
     * Defines the access_token field required to authenticate with the Bitly API.
     *
     * @return array Array of configuration field definitions
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Bitly access token',
                'hint' => 'Generate an access token in your Bitly account under Profile Settings → Generic Access Token',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Bitly API using the provided configuration.
     *
     * Calls GET /user to verify the access token is valid and the API is reachable.
     *
     * @param array $config Configuration containing the access_token
     *
     * @return array Result with 'success' bool and 'message' or 'error' string
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api-ssl.bitly.com/v4/user');

            if ($response->status() === 401) {
                return [
                    'success' => false,
                    'error' => 'Invalid access token. Please check your Bitly access token.',
                ];
            }

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('description') ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Bitly API error ({$response->status()}): {$error}",
                ];
            }

            $user = $response->json();
            $name = trim(($user['name'] ?? '') . ' ' . ($user['login'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to Bitly as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the Bitly configuration fields.
     *
     * @return array Laravel validation rules
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array Tool definitions keyed by tool name
     */
    public function tools(): array
    {
        return [
            'bitly_shorten_link' => [
                'class' => BitlyShortenLink::class,
                'type' => 'write',
                'name' => 'Shorten Link',
                'description' => 'Shorten a long URL into a Bitlink.',
                'icon' => 'ph:link',
            ],
            'bitly_get_link' => [
                'class' => BitlyGetLink::class,
                'type' => 'read',
                'name' => 'Get Link',
                'description' => 'Retrieve details for a Bitlink.',
                'icon' => 'ph:link',
            ],
            'bitly_update_link' => [
                'class' => BitlyUpdateLink::class,
                'type' => 'write',
                'name' => 'Update Link',
                'description' => 'Update a Bitlink\'s title, tags, or archived status.',
                'icon' => 'ph:pencil-simple',
            ],
            'bitly_get_clicks' => [
                'class' => BitlyGetClicks::class,
                'type' => 'read',
                'name' => 'Get Clicks',
                'description' => 'Get click metrics for a Bitlink.',
                'icon' => 'ph:cursor-click',
            ],
            'bitly_get_click_summary' => [
                'class' => BitlyGetClickSummary::class,
                'type' => 'read',
                'name' => 'Get Click Summary',
                'description' => 'Get total click summary data for a Bitlink.',
                'icon' => 'ph:chart-bar',
            ],
            'bitly_get_click_countries' => [
                'class' => BitlyGetClickCountries::class,
                'type' => 'read',
                'name' => 'Get Click Countries',
                'description' => 'Get click metrics grouped by country.',
                'icon' => 'ph:globe',
            ],
            'bitly_get_click_referrers' => [
                'class' => BitlyGetClickReferrers::class,
                'type' => 'read',
                'name' => 'Get Click Referrers',
                'description' => 'Get click metrics grouped by referrer.',
                'icon' => 'ph:arrow-square-out',
            ],
            'bitly_list_groups' => [
                'class' => BitlyListGroups::class,
                'type' => 'read',
                'name' => 'List Groups',
                'description' => 'List all groups in the Bitly account.',
                'icon' => 'ph:users-three',
            ],
            'bitly_get_group' => [
                'class' => BitlyGetGroup::class,
                'type' => 'read',
                'name' => 'Get Group',
                'description' => 'Retrieve details for a specific group.',
                'icon' => 'ph:users-three',
            ],
            'bitly_list_group_bitlinks' => [
                'class' => BitlyListGroupBitlinks::class,
                'type' => 'read',
                'name' => 'List Group Bitlinks',
                'description' => 'List Bitlinks in a group.',
                'icon' => 'ph:list-bullets',
            ],
            'bitly_create_bitlink' => [
                'class' => BitlyCreateBitlink::class,
                'type' => 'write',
                'name' => 'Create Bitlink',
                'description' => 'Create a new Bitlink with title and tags.',
                'icon' => 'ph:plus-circle',
            ],
            'bitly_expand_bitlink' => [
                'class' => BitlyExpandBitlink::class,
                'type' => 'read',
                'name' => 'Expand Bitlink',
                'description' => 'Expand a Bitlink to its long URL.',
                'icon' => 'ph:arrows-out',
            ],
            'bitly_add_custom_bitlink' => [
                'class' => BitlyAddCustomBitlink::class,
                'type' => 'write',
                'name' => 'Add Custom Bitlink',
                'description' => 'Add a custom back-half to a Bitlink.',
                'icon' => 'ph:textbox',
            ],
            'bitly_create_qr_code' => [
                'class' => BitlyCreateQrCode::class,
                'type' => 'write',
                'name' => 'Create QR Code',
                'description' => 'Create a Bitly QR Code.',
                'icon' => 'ph:qr-code',
            ],
            'bitly_get_qr_code' => [
                'class' => BitlyGetQrCode::class,
                'type' => 'read',
                'name' => 'Get QR Code',
                'description' => 'Get a Bitly QR Code by ID.',
                'icon' => 'ph:qr-code',
            ],
            'bitly_list_organization_webhooks' => [
                'class' => BitlyListOrganizationWebhooks::class,
                'type' => 'read',
                'name' => 'List Organization Webhooks',
                'description' => 'List webhooks for a Bitly organization.',
                'icon' => 'ph:webhooks-logo',
            ],
            'bitly_create_organization_webhook' => [
                'class' => BitlyCreateOrganizationWebhook::class,
                'type' => 'write',
                'name' => 'Create Organization Webhook',
                'description' => 'Create a webhook for a Bitly organization.',
                'icon' => 'ph:webhooks-logo',
            ],
            'bitly_get_current_user' => [
                'class' => BitlyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user',
            ],
            'bitly_api_get' => [
                'class' => BitlyApiGet::class,
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call any Bitly API v4 GET endpoint.',
                'icon' => 'ph:terminal-window',
            ],
            'bitly_api_post' => [
                'class' => BitlyApiPost::class,
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call any Bitly API v4 POST endpoint.',
                'icon' => 'ph:terminal-window',
            ],
            'bitly_api_patch' => [
                'class' => BitlyApiPatch::class,
                'type' => 'write',
                'name' => 'API PATCH',
                'description' => 'Call any Bitly API v4 PATCH endpoint.',
                'icon' => 'ph:terminal-window',
            ],
            'bitly_api_delete' => [
                'class' => BitlyApiDelete::class,
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call any Bitly API v4 DELETE endpoint.',
                'icon' => 'ph:terminal-window',
            ],
        ];
    }

    /**
     * Get the path to the JavaScript API documentation file.
     *
     * @return string|null Absolute path to the markdown docs file
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/bitly.md';
    }

    /**
     * Get the credential fields required by this integration.
     *
     * @return array Simplified credential field definitions
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
        ];
    }

    /**
     * Indicate that this class represents an integration.
     *
     * @return bool Always true
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance with optional multi-account support.
     *
     * When an account context is provided, resolves credentials for that
     * specific account. Otherwise falls back to the default service binding.
     *
     * @param string $class   The tool class to instantiate
     * @param array  $context Optional context including 'account' for multi-account
     *
     * @return Tool The instantiated tool
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new BitlyService(
                accessToken: $creds->get('bitly', 'access_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(BitlyService::class));
    }
}
