<?php

namespace OpenCompany\Integrations\Immigrant;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Immigrant\Tools\ImmigrantListApplications;
use OpenCompany\Integrations\Immigrant\Tools\ImmigrantGetApplication;
use OpenCompany\Integrations\Immigrant\Tools\ImmigrantCreateApplication;
use OpenCompany\Integrations\Immigrant\Tools\ImmigrantListDocuments;
use OpenCompany\Integrations\Immigrant\Tools\ImmigrantGetDocument;
use OpenCompany\Integrations\Immigrant\Tools\ImmigrantListStatuses;
use OpenCompany\Integrations\Immigrant\Tools\ImmigrantGetCurrentUser;

/**
 * Tool provider for the Immigrant integration.
 *
 * Registers 7 tools for managing immigration applications, documents,
 * statuses, and the current user. Implements ConfigurableIntegration for
 * multi-account support with configurable access token.
 */
class ImmigrantToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * The application name used as the integration identifier.
     */
    public function appName(): string
    {
        return 'immigrant';
    }

    /**
     * Short metadata displayed in tool listings.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'applications, documents, statuses',
            'description' => 'Immigration application management',
            'icon' => 'ph:identification-card',
            'logo' => 'simple-icons:immigrant',
        ];
    }

    /**
     * Integration metadata for the UI configuration screen.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Immigrant',
            'description' => 'Immigration application management — track applications, documents, and statuses',
            'icon' => 'ph:identification-card',
            'logo' => 'simple-icons:immigrant',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://api.immigration.com/v1/docs',
        ];
    }

    /**
     * Configuration schema for the Immigrant integration.
     *
     * Defines the fields shown in the integration settings UI:
     * - access_token: Bearer token for API authentication.
     * - url: Optional override for the API base URL.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Immigrant access token',
                'hint' => 'Generate an access token in your Immigrant account under "API Settings"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Custom Base URL',
                'placeholder' => 'https://api.immigration.com/v1',
                'hint' => 'Optional. Override the base URL if your Immigrant instance uses a different endpoint.',
                'default' => 'https://api.immigration.com/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Immigrant API.
     *
     * Calls the /users/me endpoint to verify credentials.
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.immigration.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No base URL provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Immigrant API at {$baseUrl}. Check your base URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['message'] ?? $json['error'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Authentication failed: {$error}",
                ];
            }

            $name = trim(($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to Immigrant as {$name} ({$baseUrl}).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the integration configuration.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all available Immigrant tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'immigrant_list_applications' => [
                'class' => ImmigrantListApplications::class,
                'type' => 'read',
                'name' => 'List Applications',
                'description' => 'List immigration applications.',
                'icon' => 'ph:list-bullets',
            ],
            'immigrant_get_application' => [
                'class' => ImmigrantGetApplication::class,
                'type' => 'read',
                'name' => 'Get Application',
                'description' => 'Get details of a specific immigration application.',
                'icon' => 'ph:file-text',
            ],
            'immigrant_create_application' => [
                'class' => ImmigrantCreateApplication::class,
                'type' => 'write',
                'name' => 'Create Application',
                'description' => 'Create a new immigration application.',
                'icon' => 'ph:plus-circle',
            ],
            'immigrant_list_documents' => [
                'class' => ImmigrantListDocuments::class,
                'type' => 'read',
                'name' => 'List Documents',
                'description' => 'List documents for an immigration application.',
                'icon' => 'ph:files',
            ],
            'immigrant_get_document' => [
                'class' => ImmigrantGetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Get details of a specific document.',
                'icon' => 'ph:file',
            ],
            'immigrant_list_statuses' => [
                'class' => ImmigrantListStatuses::class,
                'type' => 'read',
                'name' => 'List Statuses',
                'description' => 'List available application statuses.',
                'icon' => 'ph:status',
            ],
            'immigrant_get_current_user' => [
                'class' => ImmigrantGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Immigrant user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/immigrant.md';
    }

    /**
     * Credential fields for the integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Custom Base URL', 'required' => false, 'default' => 'https://api.immigration.com/v1'],
        ];
    }

    /**
     * Confirm this is an integration (not just a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * When an account context is provided, creates a new ImmigrantService with
     * that account's credentials. Otherwise, uses the app-container service.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ImmigrantService(
                accessToken: $creds->get('immigrant', 'access_token', '', $account),
                baseUrl: $creds->get('immigrant', 'url', 'https://api.immigration.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(ImmigrantService::class));
    }
}
