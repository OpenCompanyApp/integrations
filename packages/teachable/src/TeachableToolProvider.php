<?php

namespace OpenCompany\Integrations\Teachable;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Teachable\Tools\TeachableListCourses;
use OpenCompany\Integrations\Teachable\Tools\TeachableGetCourse;
use OpenCompany\Integrations\Teachable\Tools\TeachableListUsers;
use OpenCompany\Integrations\Teachable\Tools\TeachableGetUser;
use OpenCompany\Integrations\Teachable\Tools\TeachableListEnrollments;
use OpenCompany\Integrations\Teachable\Tools\TeachableGetEnrollment;
use OpenCompany\Integrations\Teachable\Tools\TeachableGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class TeachableToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
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




/**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'teachable';
    }

/**
     * Get metadata for display in the application UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Teachable',
            'description' => 'Online courses platform',
            'icon' => 'ph:graduation-cap',
            'logo' => 'simple-icons:teachable',
        ];
    }

/**
     * Get integration metadata for the marketplace / integration catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Teachable',
            'description' => 'Online courses platform — manage courses, users, and enrollments.',
            'icon' => 'ph:graduation-cap',
            'logo' => 'simple-icons:teachable',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.teachable.com/api',
        ];
    }/**
     * Get the configuration schema for this integration.
     *
     * Defines the fields required: API key.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Teachable API key',
                'hint' => 'Generate an API key in your Teachable school admin under "Settings → API"',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Teachable API using the provided config.
     *
     * @param  array<string, mixed>  $config  The configuration to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = 'https://api.teachable.com/v1';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => 'Could not reach Teachable API. Check your API key.',
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to Teachable API successfully.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    /**
     * Get all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'teachable_list_courses' => [
                'class' => TeachableListCourses::class,
                'type' => 'read',
                'name' => 'List Courses',
                'description' => 'List courses from your Teachable school.',
                'icon' => 'ph:list',
            ],
            'teachable_get_course' => [
                'class' => TeachableGetCourse::class,
                'type' => 'read',
                'name' => 'Get Course',
                'description' => 'Get a single course by ID.',
                'icon' => 'ph:book-open',
            ],
            'teachable_list_users' => [
                'class' => TeachableListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users from your Teachable school.',
                'icon' => 'ph:users',
            ],
            'teachable_get_user' => [
                'class' => TeachableGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get a single user by ID.',
                'icon' => 'ph:user',
            ],
            'teachable_list_enrollments' => [
                'class' => TeachableListEnrollments::class,
                'type' => 'read',
                'name' => 'List Enrollments',
                'description' => 'List enrollments from your Teachable school.',
                'icon' => 'ph:clipboard-text',
            ],
            'teachable_get_enrollment' => [
                'class' => TeachableGetEnrollment::class,
                'type' => 'read',
                'name' => 'Get Enrollment',
                'description' => 'Get a single enrollment by ID.',
                'icon' => 'ph:clipboard',
            ],
            'teachable_get_current_user' => [
                'class' => TeachableGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Verify authentication and get the current user profile.',
                'icon' => 'ph:key',
            ],
        ];
    }

    /**
     * Get the path to the JavaScript documentation file.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/teachable.md';
    }

    /**
     * Get the credential fields for this integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * Supports multi-account by resolving credentials for a specific account
     * when provided via the context.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new TeachableService(
                apiKey: $creds->get('teachable', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(TeachableService::class));
    }
}
