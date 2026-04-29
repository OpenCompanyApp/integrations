<?php

namespace OpenCompany\Integrations\Formstack;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Formstack\Tools\FormstackCreateSubmission;
use OpenCompany\Integrations\Formstack\Tools\FormstackDeleteSubmission;
use OpenCompany\Integrations\Formstack\Tools\FormstackGetCurrentUser;
use OpenCompany\Integrations\Formstack\Tools\FormstackGetForm;
use OpenCompany\Integrations\Formstack\Tools\FormstackGetSubmission;
use OpenCompany\Integrations\Formstack\Tools\FormstackListFolders;
use OpenCompany\Integrations\Formstack\Tools\FormstackListForms;
use OpenCompany\Integrations\Formstack\Tools\FormstackListSubmissions;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class FormstackToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
     * Machine name of the integration.
     */
    public function appName(): string
    {
        return 'formstack';
    }

/**
     * Short metadata for the app listing.
     *
     * @return array<string, string> Label, description, icon, and logo keys.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Formstack',
            'description' => 'Online form builder',
            'icon' => 'ph:clipboard-text',
            'logo' => 'simple-icons:formstack',
        ];
    }

/**
     * Extended integration metadata for the UI.
     *
     * @return array<string, string> Name, description, icon, logo, category, badge, and docs URL.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Formstack',
            'description' => 'Online form builder and submission management',
            'icon' => 'ph:clipboard-text',
            'logo' => 'simple-icons:formstack',
            'category' => 'forms',
            'badge' => 'verified',
            'docs_url' => 'https://www.formstack.com/docs/api/v2',
        ];
    }/**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>> List of config field definitions.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Formstack OAuth access token',
                'hint' => 'Generate an OAuth access token in your Formstack account settings under "Applications"',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Formstack API using the given config.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string} Test result.
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
            ])->timeout(10)->get('https://www.formstack.com/api/v2/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => 'Could not reach Formstack API. Check your access token.',
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to Formstack API.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration values.
     *
     * @return array<string, string> Laravel validation rules.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    /**
     * Tool definitions provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'formstack_list_forms' => [
                'class' => FormstackListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List all forms in your Formstack account.',
                'icon' => 'ph:clipboard-text',
            ],
            'formstack_get_form' => [
                'class' => FormstackGetForm::class,
                'type' => 'read',
                'name' => 'Get Form',
                'description' => 'Get details and field structure of a specific form.',
                'icon' => 'ph:clipboard-text',
            ],
            'formstack_list_submissions' => [
                'class' => FormstackListSubmissions::class,
                'type' => 'read',
                'name' => 'List Submissions',
                'description' => 'List submissions for a specific form.',
                'icon' => 'ph:list-dashes',
            ],
            'formstack_get_submission' => [
                'class' => FormstackGetSubmission::class,
                'type' => 'read',
                'name' => 'Get Submission',
                'description' => 'Get details of a specific submission.',
                'icon' => 'ph:file-text',
            ],
            'formstack_create_submission' => [
                'class' => FormstackCreateSubmission::class,
                'type' => 'write',
                'name' => 'Create Submission',
                'description' => 'Create a new submission for a form.',
                'icon' => 'ph:plus',
            ],
            'formstack_delete_submission' => [
                'class' => FormstackDeleteSubmission::class,
                'type' => 'write',
                'name' => 'Delete Submission',
                'description' => 'Delete a submission.',
                'icon' => 'ph:trash',
            ],
            'formstack_list_folders' => [
                'class' => FormstackListFolders::class,
                'type' => 'read',
                'name' => 'List Folders',
                'description' => 'List all folders in your Formstack account.',
                'icon' => 'ph:folder',
            ],
            'formstack_get_current_user' => [
                'class' => FormstackGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/formstack.md';
    }

    /**
     * Credential fields for the integration.
     *
     * @return array<int, array<string, mixed>> List of credential field definitions.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
        ];
    }

    /**
     * Confirm this is an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally for a specific account.
     *
     * Supports multi-account by resolving account-specific credentials
     * when an account identifier is provided in the context.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array{account?: string|null}  $context  Optional context with account identifier.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new FormstackService(
                accessToken: $creds->get('formstack', 'access_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(FormstackService::class));
    }
}
