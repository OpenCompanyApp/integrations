<?php

namespace OpenCompany\Integrations\Litmos;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Litmos\Tools\LitmosListUsers;
use OpenCompany\Integrations\Litmos\Tools\LitmosGetUser;
use OpenCompany\Integrations\Litmos\Tools\LitmosCreateUser;
use OpenCompany\Integrations\Litmos\Tools\LitmosListCourses;
use OpenCompany\Integrations\Litmos\Tools\LitmosGetCourse;
use OpenCompany\Integrations\Litmos\Tools\LitmosListTeams;
use OpenCompany\Integrations\Litmos\Tools\LitmosGetCurrentUser;

/**
 * Tool provider for the Litmos LMS integration.
 *
 * Implements ConfigurableIntegration for multi-account support,
 * configuration schema, connection testing, and credential management.
 */
class LitmosToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * The integration identifier.
     */
    public function appName(): string
    {
        return 'litmos';
    }

    /**
     * Short metadata for display in UI tool listings.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'users, courses, teams',
            'description' => 'Learning management system',
            'icon' => 'ph:graduation-cap',
            'logo' => 'simple-icons:litmos',
        ];
    }

    /**
     * Full integration metadata for the integrations catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Litmos',
            'description' => 'Learning management system for training and education',
            'icon' => 'ph:graduation-cap',
            'logo' => 'simple-icons:litmos',
            'category' => 'education',
            'badge' => 'verified',
            'docs_url' => 'https://support.litmos.com/hc/en-us/articles/227734727-Litmos-API-v1-0-Documentation',
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
                'placeholder' => 'Enter your Litmos API key',
                'hint' => 'Find your API key in Litmos under Settings → API Key',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.litmos.com',
                'hint' => 'Use <code>https://api.litmos.com</code> for the default Litmos endpoint, or your custom URL',
                'default' => 'https://api.litmos.com',
            ],
        ];
    }

    /**
     * Test the connection to the Litmos API using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.litmos.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/1/users/me');

            $json = $response->json();

            if ($json === null && !$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Could not reach Litmos API at {$baseUrl}. Check the URL and API key.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Litmos API at {$baseUrl}.",
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
            'litmos_list_users' => [
                'class' => LitmosListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users in your Litmos organization.',
                'icon' => 'ph:users',
            ],
            'litmos_get_user' => [
                'class' => LitmosGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get details for a specific Litmos user.',
                'icon' => 'ph:user',
            ],
            'litmos_create_user' => [
                'class' => LitmosCreateUser::class,
                'type' => 'write',
                'name' => 'Create User',
                'description' => 'Create a new user in Litmos.',
                'icon' => 'ph:user-plus',
            ],
            'litmos_list_courses' => [
                'class' => LitmosListCourses::class,
                'type' => 'read',
                'name' => 'List Courses',
                'description' => 'List courses in your Litmos organization.',
                'icon' => 'ph:book-open',
            ],
            'litmos_get_course' => [
                'class' => LitmosGetCourse::class,
                'type' => 'read',
                'name' => 'Get Course',
                'description' => 'Get details for a specific Litmos course.',
                'icon' => 'ph:book-open',
            ],
            'litmos_list_teams' => [
                'class' => LitmosListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List teams in your Litmos organization.',
                'icon' => 'ph:users-three',
            ],
            'litmos_get_current_user' => [
                'class' => LitmosGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Litmos user.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    /**
     * Path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/litmos.md';
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
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.litmos.com'],
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

            $service = new LitmosService(
                apiKey: $creds->get('litmos', 'api_key', '', $account),
                baseUrl: $creds->get('litmos', 'url', 'https://api.litmos.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(LitmosService::class));
    }
}
