<?php

namespace OpenCompany\Integrations\Thinkific;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Thinkific\Tools\ThinkificListCourses;
use OpenCompany\Integrations\Thinkific\Tools\ThinkificGetCourse;
use OpenCompany\Integrations\Thinkific\Tools\ThinkificCreateCourse;
use OpenCompany\Integrations\Thinkific\Tools\ThinkificListEnrollments;
use OpenCompany\Integrations\Thinkific\Tools\ThinkificGetEnrollment;
use OpenCompany\Integrations\Thinkific\Tools\ThinkificListUsers;
use OpenCompany\Integrations\Thinkific\Tools\ThinkificGetCurrentUser;

/**
 * Tool provider for the Thinkific online courses integration.
 *
 * Implements ConfigurableIntegration for multi-account support,
 * configuration schema, connection testing, and credential management.
 */
class ThinkificToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * The integration identifier.
     */
    public function appName(): string
    {
        return 'thinkific';
    }

    /**
     * Short metadata for display in UI tool listings.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'courses, enrollments, users',
            'description' => 'Online course platform',
            'icon' => 'ph:graduation-cap',
            'logo' => 'simple-icons:thinkific',
        ];
    }

    /**
     * Full integration metadata for the integrations catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Thinkific',
            'description' => 'Online course platform for creating and selling courses',
            'icon' => 'ph:graduation-cap',
            'logo' => 'simple-icons:thinkific',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.thinkific.com/api/api-documentation/',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
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
                'placeholder' => 'Enter your Thinkific API key',
                'hint' => 'Find your API key in Thinkific under Settings → API → API Key',
                'required' => true,
            ],
            [
                'key' => 'subdomain',
                'type' => 'text',
                'label' => 'Subdomain',
                'placeholder' => 'your-site',
                'hint' => 'Your Thinkific site subdomain (e.g., <code>your-site</code> from your-site.thinkific.com)',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.thinkific.com/api/public/v1',
                'hint' => 'Use <code>https://api.thinkific.com/api/public/v1</code> for the default Thinkific endpoint',
                'default' => 'https://api.thinkific.com/api/public/v1',
            ],
        ];
    }

    /**
     * Test the connection to the Thinkific API using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $subdomain = $config['subdomain'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.thinkific.com/api/public/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $headers = [
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];

            if (!empty($subdomain)) {
                $headers['X-Auth-Subdomain'] = $subdomain;
            }

            $response = Http::withHeaders($headers)->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null && !$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Could not reach Thinkific API at {$baseUrl}. Check the URL and API key.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Thinkific API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the integration configuration.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'subdomain' => 'nullable|string',
            'url' => 'nullable|url',
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
            'thinkific_list_courses' => [
                'class' => ThinkificListCourses::class,
                'type' => 'read',
                'name' => 'List Courses',
                'description' => 'List courses in your Thinkific site.',
                'icon' => 'ph:book-open',
            ],
            'thinkific_get_course' => [
                'class' => ThinkificGetCourse::class,
                'type' => 'read',
                'name' => 'Get Course',
                'description' => 'Get details for a specific Thinkific course.',
                'icon' => 'ph:book-open',
            ],
            'thinkific_create_course' => [
                'class' => ThinkificCreateCourse::class,
                'type' => 'write',
                'name' => 'Create Course',
                'description' => 'Create a new course in Thinkific.',
                'icon' => 'ph:plus-circle',
            ],
            'thinkific_list_enrollments' => [
                'class' => ThinkificListEnrollments::class,
                'type' => 'read',
                'name' => 'List Enrollments',
                'description' => 'List enrollments in your Thinkific site.',
                'icon' => 'ph:clipboard-text',
            ],
            'thinkific_get_enrollment' => [
                'class' => ThinkificGetEnrollment::class,
                'type' => 'read',
                'name' => 'Get Enrollment',
                'description' => 'Get details for a specific Thinkific enrollment.',
                'icon' => 'ph:clipboard-text',
            ],
            'thinkific_list_users' => [
                'class' => ThinkificListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users in your Thinkific site.',
                'icon' => 'ph:users',
            ],
            'thinkific_get_current_user' => [
                'class' => ThinkificGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Thinkific user.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    /**
     * Path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/thinkific.md';
    }

    /**
     * Credential fields for multi-account authentication.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'subdomain', 'type' => 'text', 'label' => 'Subdomain', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.thinkific.com/api/public/v1'],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ThinkificService(
                apiKey: $creds->get('thinkific', 'api_key', '', $account),
                subdomain: $creds->get('thinkific', 'subdomain', '', $account),
                baseUrl: $creds->get('thinkific', 'url', 'https://api.thinkific.com/api/public/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(ThinkificService::class));
    }
}
