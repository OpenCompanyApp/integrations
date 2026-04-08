<?php

namespace OpenCompany\Integrations\Recurly;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Recurly\Tools\RecurlyCreateAccount;
use OpenCompany\Integrations\Recurly\Tools\RecurlyGetCurrentUser;
use OpenCompany\Integrations\Recurly\Tools\RecurlyGetAccount;
use OpenCompany\Integrations\Recurly\Tools\RecurlyGetSubscription;
use OpenCompany\Integrations\Recurly\Tools\RecurlyListAccounts;
use OpenCompany\Integrations\Recurly\Tools\RecurlyListPlans;
use OpenCompany\Integrations\Recurly\Tools\RecurlyListSubscriptions;

class RecurlyToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the app name identifier.
     *
     * @return string The integration name.
     */
    public function appName(): string
    {
        return 'recurly';
    }

    /**
     * Get the app metadata for display and categorization.
     *
     * @return array The app metadata (label, description, icon, logo).
     */
    public function appMeta(): array
    {
        return [
            'label' => 'accounts, subscriptions, plans',
            'description' => 'Subscription billing',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:recurly',
        ];
    }

    /**
     * Get the integration metadata for the UI.
     *
     * @return array The integration metadata (name, description, icon, logo, category, badge, docs_url).
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Recurly',
            'description' => 'Subscription billing and recurring revenue management',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:recurly',
            'category' => 'finance',
            'badge' => 'verified',
            'docs_url' => 'https://docs.recurly.com/docs/api',
        ];
    }

    /**
     * Get the configuration schema for the Recurly integration.
     *
     * @return array The config schema fields.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Recurly API key',
                'hint' => 'Find your API key in Recurly under <strong>Settings → API Credentials</strong>. Use a private API key for full access.',
                'required' => true,
            ],
            [
                'key' => 'subdomain',
                'type' => 'text',
                'label' => 'Subdomain',
                'placeholder' => 'your-subdomain',
                'hint' => 'Your Recurly subdomain (e.g., <code>mycompany</code> for <code>mycompany.recurly.com</code>).',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the connection to the Recurly API.
     *
     * @param array $config The configuration values to test.
     * @return array The test result (success, message/error).
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $service = new RecurlyService(
                apiKey: $apiKey,
                subdomain: $config['subdomain'] ?? '',
            );

            $result = $service->listAccounts(1);

            return [
                'success' => true,
                'message' => 'Connected to Recurly API successfully.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get the validation rules for the configuration.
     *
     * @return array The Laravel validation rules.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'subdomain' => 'nullable|string',
        ];
    }

    /**
     * Get the available tools for the Recurly integration.
     *
     * @return array The tool definitions keyed by tool name.
     */
    public function tools(): array
    {
        return [
            'recurly_list_accounts' => [
                'class' => RecurlyListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List billing accounts from Recurly.',
                'icon' => 'ph:users',
            ],
            'recurly_get_account' => [
                'class' => RecurlyGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Get details of a specific Recurly account.',
                'icon' => 'ph:user',
            ],
            'recurly_create_account' => [
                'class' => RecurlyCreateAccount::class,
                'type' => 'write',
                'name' => 'Create Account',
                'description' => 'Create a new billing account in Recurly.',
                'icon' => 'ph:user-plus',
            ],
            'recurly_list_subscriptions' => [
                'class' => RecurlyListSubscriptions::class,
                'type' => 'read',
                'name' => 'List Subscriptions',
                'description' => 'List subscriptions from Recurly.',
                'icon' => 'ph:repeat',
            ],
            'recurly_get_subscription' => [
                'class' => RecurlyGetSubscription::class,
                'type' => 'read',
                'name' => 'Get Subscription',
                'description' => 'Get details of a specific Recurly subscription.',
                'icon' => 'ph:receipt',
            ],
            'recurly_list_plans' => [
                'class' => RecurlyListPlans::class,
                'type' => 'read',
                'name' => 'List Plans',
                'description' => 'List billing plans from Recurly.',
                'icon' => 'ph:list-bullets',
            ],
            'recurly_get_current_user' => [
                'class' => RecurlyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Health Check',
                'description' => 'Verify the Recurly API connection by fetching the first account.',
                'icon' => 'ph:heartbeat',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     *
     * @return string|null The absolute path to the Lua docs markdown file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/recurly.md';
    }

    /**
     * Get the credential fields for the integration.
     *
     * @return array The credential field definitions.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'subdomain', 'type' => 'text', 'label' => 'Subdomain', 'required' => false],
        ];
    }

    /**
     * Indicate that this is an integration.
     *
     * @return bool Always true.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the given class and context.
     *
     * Resolves credentials for the given account and injects them into
     * a new RecurlyService, then constructs the tool class.
     *
     * @param string $class   The tool class FQCN.
     * @param array  $context The context array, may contain an 'account' key.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new RecurlyService(
                apiKey: $creds->get('recurly', 'api_key', '', $account),
                subdomain: $creds->get('recurly', 'subdomain', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(RecurlyService::class));
    }
}
