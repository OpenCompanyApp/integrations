<?php

namespace OpenCompany\Integrations\Tally;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Tally\Tools\TallyGetCurrentUser;
use OpenCompany\Integrations\Tally\Tools\TallyGetForm;
use OpenCompany\Integrations\Tally\Tools\TallyGetSubmission;
use OpenCompany\Integrations\Tally\Tools\TallyListForms;
use OpenCompany\Integrations\Tally\Tools\TallyListSubmissions;
use OpenCompany\Integrations\Tally\Tools\TallyListWorkspaces;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class TallyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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



public function appName(): string
    {
        return 'tally';
    }

public function appMeta(): array
    {
        return [
            'label' => 'Tally',
            'description' => 'Online forms and surveys',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:tally',
        ];
    }

public function integrationMeta(): array
    {
        return [
            'name' => 'Tally',
            'description' => 'Online forms, surveys, and data collection',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:tally',
            'category' => 'forms',
            'badge' => 'verified',
            'docs_url' => 'https://tally.so/help/api',
        ];
    }
        public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Validate that required credentials were supplied for this integration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        foreach ($this->credentialFields() as $field) {
            if (($field['required'] ?? true) && empty($config[$field['key']])) {
                return [
                    'success' => false,
                    'error' => ($field['label'] ?? $field['key']) . ' is required.',
                ];
            }
        }

        return [
            'success' => true,
            'message' => 'Required credentials are configured. API access will be verified when tools run.',
        ];
    }
public function validationRules(): array
    {
        return [
            'access_token' => 'required|string',
            'url' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'tally_get_current_user' => [
                'class' => TallyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Tally Get Current User',
                'description' => 'Get the authenticated user\'s profile information, including name, email, and account details.',
                'icon' => 'ph:wrench',
            ],
            'tally_get_form' => [
                'class' => TallyGetForm::class,
                'type' => 'read',
                'name' => 'Tally Get Form',
                'description' => 'Get full details of a specific Tally form by its ID, including form structure, fields, and settings.',
                'icon' => 'ph:wrench',
            ],
            'tally_get_submission' => [
                'class' => TallyGetSubmission::class,
                'type' => 'read',
                'name' => 'Tally Get Submission',
                'description' => 'Get full details of a specific form submission by its ID, including all field responses and metadata.',
                'icon' => 'ph:wrench',
            ],
            'tally_list_forms' => [
                'class' => TallyListForms::class,
                'type' => 'read',
                'name' => 'Tally List Forms',
                'description' => 'List all Tally forms accessible to the authenticated user. Returns form IDs, titles, status, and submission counts. Supports pagination.',
                'icon' => 'ph:wrench',
            ],
            'tally_list_submissions' => [
                'class' => TallyListSubmissions::class,
                'type' => 'read',
                'name' => 'Tally List Submissions',
                'description' => 'List all submissions for a specific Tally form. Returns respondent answers, submission dates, and metadata. Supports pagination.',
                'icon' => 'ph:wrench',
            ],
            'tally_list_workspaces' => [
                'class' => TallyListWorkspaces::class,
                'type' => 'read',
                'name' => 'Tally List Workspaces',
                'description' => 'List all workspaces accessible to the authenticated Tally user. Returns workspace names, IDs, and member info.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/tally.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.tally.so'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional multi-account credential resolution.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Runtime context, may include 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the TallyService, with optional account-specific credentials.
     *
     * When $context['account'] is set, creates a fresh service with that
     * account's credentials. Otherwise falls back to the container singleton.
     *
     * @param  array<string, mixed>  $context  Runtime context with optional 'account' key.
     */
    private function resolveService(array $context = []): TallyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new TallyService(
                accessToken: $creds->get('tally', 'access_token', '', $account),
                baseUrl: $creds->get('tally', 'url', 'https://api.tally.so', $account),
            );
        }

        return app(TallyService::class);
    }
}
