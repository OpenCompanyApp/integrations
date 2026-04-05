<?php

namespace OpenCompany\Integrations\Workable;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Workable\Tools\WorkableListJobs;
use OpenCompany\Integrations\Workable\Tools\WorkableGetJob;
use OpenCompany\Integrations\Workable\Tools\WorkableCreateJob;
use OpenCompany\Integrations\Workable\Tools\WorkableListCandidates;
use OpenCompany\Integrations\Workable\Tools\WorkableGetCandidate;
use OpenCompany\Integrations\Workable\Tools\WorkableListMembers;
use OpenCompany\Integrations\Workable\Tools\WorkableGetCurrentUser;

/**
 * Tool provider for the Workable ATS integration.
 *
 * Implements ConfigurableIntegration for multi-account support and
 * registers all 7 Workable tools (jobs, candidates, members, users).
 */
class WorkableToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'workable';
    }

    /**
     * Get application metadata for display purposes.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'jobs, candidates, members',
            'description' => 'Recruiting & ATS',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:workable',
        ];
    }

    /**
     * Get integration metadata for the marketplace.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Workable',
            'description' => 'Applicant tracking system — manage jobs, candidates, and hiring',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:workable',
            'category' => 'hr',
            'badge' => 'verified',
            'docs_url' => 'https://workable.com/spi/v3/docs',
        ];
    }

    /**
     * Get the configuration schema for the Workable integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Workable access token',
                'hint' => 'Generate an access token in your Workable account under Settings > Integrations > Access Token',
                'required' => true,
            ],
            [
                'key' => 'subdomain',
                'type' => 'text',
                'label' => 'Account Subdomain',
                'placeholder' => 'your-company',
                'hint' => 'Your Workable subdomain from <code>your-company.workable.com</code>',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://www.workable.com/spi/v3/accounts',
                'hint' => 'Change only if using a custom Workable API endpoint',
                'default' => 'https://www.workable.com/spi/v3/accounts',
            ],
        ];
    }

    /**
     * Test the connection to the Workable API.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $subdomain = $config['subdomain'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://www.workable.com/spi/v3/accounts', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        if (empty($subdomain)) {
            return ['success' => false, 'error' => 'No subdomain provided.'];
        }

        try {
            $url = $baseUrl . '/' . $subdomain . '/users/me';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($url);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Workable API at {$baseUrl}. Check the URL and subdomain.",
                ];
            }

            if ($response->successful()) {
                $name = $json['name'] ?? $json['email'] ?? 'Unknown';
                return [
                    'success' => true,
                    'message' => "Connected to Workable as {$name}.",
                ];
            }

            $error = $json['error'] ?? $json['message'] ?? $response->body();
            return [
                'success' => false,
                'error' => 'Workable API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the Workable configuration.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'subdomain' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    /**
     * Get all available Workable tools.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'workable_list_jobs' => [
                'class' => WorkableListJobs::class,
                'type' => 'read',
                'name' => 'List Jobs',
                'description' => 'List all jobs with optional state filtering.',
                'icon' => 'ph:briefcase',
            ],
            'workable_get_job' => [
                'class' => WorkableGetJob::class,
                'type' => 'read',
                'name' => 'Get Job',
                'description' => 'Get full details for a specific job.',
                'icon' => 'ph:briefcase',
            ],
            'workable_create_job' => [
                'class' => WorkableCreateJob::class,
                'type' => 'write',
                'name' => 'Create Job',
                'description' => 'Create a new job posting.',
                'icon' => 'ph:plus-circle',
            ],
            'workable_list_candidates' => [
                'class' => WorkableListCandidates::class,
                'type' => 'read',
                'name' => 'List Candidates',
                'description' => 'List candidates for a specific job.',
                'icon' => 'ph:users',
            ],
            'workable_get_candidate' => [
                'class' => WorkableGetCandidate::class,
                'type' => 'read',
                'name' => 'Get Candidate',
                'description' => 'Get full details for a specific candidate.',
                'icon' => 'ph:user',
            ],
            'workable_list_members' => [
                'class' => WorkableListMembers::class,
                'type' => 'read',
                'name' => 'List Members',
                'description' => 'List all team members (recruiters and hiring managers).',
                'icon' => 'ph:users-three',
            ],
            'workable_get_current_user' => [
                'class' => WorkableGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user\'s profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/workable.md';
    }

    /**
     * Get the credential fields for the Workable integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'subdomain', 'type' => 'string', 'label' => 'Subdomain', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://www.workable.com/spi/v3/accounts'],
        ];
    }

    /**
     * Confirm this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, with optional multi-account support.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' for multi-account.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the WorkableService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): WorkableService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new WorkableService(
                accessToken: $creds->get('workable', 'access_token', '', $account),
                subdomain: $creds->get('workable', 'subdomain', '', $account),
                baseUrl: $creds->get('workable', 'base_url', 'https://www.workable.com/spi/v3/accounts', $account),
            );
        }

        return app(WorkableService::class);
    }
}
