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

/**
 * Tool provider for the Tally forms integration.
 *
 * Declares 6 tools for managing Tally forms, submissions, workspaces,
 * and user profile. Supports multi-account credential resolution and
 * configurable integration settings.
 */
class TallyToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'tally';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'forms, submissions, surveys',
            'description' => 'Online forms and surveys',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:tally',
        ];
    }

    // ── ConfigurableIntegration ───────────────────────────

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
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Tally access token',
                'hint' => 'Generate an access token in your Tally account settings under "Integrations"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.tally.so',
                'hint' => 'Use <code>https://api.tally.so</code> unless using a custom endpoint',
                'default' => 'https://api.tally.so',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.tally.so', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            if ($response->successful()) {
                $data = $response->json();
                $name = $data['name'] ?? 'Unknown user';

                return [
                    'success' => true,
                    'message' => "Connected to Tally as {$name}.",
                ];
            }

            $error = $response->json('error') ?? $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Tally API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    // ── Tools ─────────────────────────────────────────────

    public function tools(): array
    {
        return [
            'tally_list_forms' => [
                'class' => TallyListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List all Tally forms with pagination.',
                'icon' => 'ph:list',
            ],
            'tally_get_form' => [
                'class' => TallyGetForm::class,
                'type' => 'read',
                'name' => 'Get Form',
                'description' => 'Get details of a specific Tally form by ID.',
                'icon' => 'ph:notebook',
            ],
            'tally_list_submissions' => [
                'class' => TallyListSubmissions::class,
                'type' => 'read',
                'name' => 'List Submissions',
                'description' => 'List submissions for a specific Tally form with pagination.',
                'icon' => 'ph:inbox',
            ],
            'tally_get_submission' => [
                'class' => TallyGetSubmission::class,
                'type' => 'read',
                'name' => 'Get Submission',
                'description' => 'Get details of a specific form submission by ID.',
                'icon' => 'ph:file-text',
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
                'description' => 'Get the authenticated user\'s profile information.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    // ── Shared ────────────────────────────────────────────

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/tally.md';
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
    {
        return new $class($this->resolveService($context));
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
