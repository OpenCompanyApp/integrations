<?php

namespace OpenCompany\Integrations\Tally;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Tally\Tools\TallyListForms;
use OpenCompany\Integrations\Tally\Tools\TallyGetForm;
use OpenCompany\Integrations\Tally\Tools\TallyListSubmissions;
use OpenCompany\Integrations\Tally\Tools\TallyGetSubmission;
use OpenCompany\Integrations\Tally\Tools\TallyListWorkspaces;
use OpenCompany\Integrations\Tally\Tools\TallyGetCurrentUser;

class TallyToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Unique integration name used as the identifier throughout the system.
     */
    public function appName(): string
    {
        return 'tally';
    }

    /**
     * Short metadata for tool selection UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'forms, submissions, workspaces',
            'description' => 'Form builder & submissions',
            'icon' => 'ph:clipboard-text',
            'logo' => 'simple-icons:tally',
        ];
    }

    /**
     * Full integration metadata for the integrations catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Tally',
            'description' => 'Simple, powerful form builder — collect submissions, manage forms and workspaces',
            'icon' => 'ph:clipboard-text',
            'logo' => 'simple-icons:tally',
            'category' => 'forms',
            'badge' => 'verified',
            'docs_url' => 'https://tally.so/help/api',
        ];
    }

    /**
     * Configuration schema for the Tally integration.
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
                'placeholder' => 'Enter your Tally API key',
                'hint' => 'Generate an API key in your Tally workspace settings under "Integrations"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.tally.so',
                'hint' => 'The Tally API base URL. Override only if using a custom endpoint.',
                'default' => 'https://api.tally.so',
            ],
        ];
    }

    /**
     * Test the Tally API connection using the provided configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.tally.so', '/');

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
                    'error' => "Could not reach Tally API at {$baseUrl}. Check the URL.",
                ];
            }

            $userName = ($json['firstName'] ?? '') . ' ' . ($json['lastName'] ?? '');
            $userName = trim($userName) ?: ($json['email'] ?? 'Unknown user');

            return [
                'success' => true,
                'message' => "Connected to Tally API as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the Tally configuration.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all available Tally tools with their metadata.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'tally_list_forms' => [
                'class' => TallyListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List all forms accessible in the Tally workspace.',
                'icon' => 'ph:clipboard-text',
            ],
            'tally_get_form' => [
                'class' => TallyGetForm::class,
                'type' => 'read',
                'name' => 'Get Form',
                'description' => 'Get full details for a specific Tally form.',
                'icon' => 'ph:clipboard-text',
            ],
            'tally_list_submissions' => [
                'class' => TallyListSubmissions::class,
                'type' => 'read',
                'name' => 'List Submissions',
                'description' => 'List submissions for a specific Tally form.',
                'icon' => 'ph:inbox',
            ],
            'tally_get_submission' => [
                'class' => TallyGetSubmission::class,
                'type' => 'read',
                'name' => 'Get Submission',
                'description' => 'Get full details of a single Tally form submission.',
                'icon' => 'ph:inbox',
            ],
            'tally_list_workspaces' => [
                'class' => TallyListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List all workspaces accessible to the authenticated user.',
                'icon' => 'ph:buildings',
            ],
            'tally_get_current_user' => [
                'class' => TallyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get profile information for the authenticated Tally user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/tally.md';
    }

    /**
     * Credential fields required for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Tally API URL', 'required' => false, 'default' => 'https://api.tally.so'],
        ];
    }

    /**
     * Confirm this class represents an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  string  $class  Fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Context containing optional account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new TallyService(
                apiKey: $creds->get('tally', 'api_key', '', $account),
                baseUrl: $creds->get('tally', 'url', 'https://api.tally.so', $account),
            );

            return new $class($service);
        }

        return new $class(app(TallyService::class));
    }
}
