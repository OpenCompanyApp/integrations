<?php

namespace OpenCompany\Integrations\Workable;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Workable\Tools\WorkableListJobs;
use OpenCompany\Integrations\Workable\Tools\WorkableGetJob;
use OpenCompany\Integrations\Workable\Tools\WorkableListCandidates;
use OpenCompany\Integrations\Workable\Tools\WorkableGetCandidate;
use OpenCompany\Integrations\Workable\Tools\WorkableCreateCandidate;
use OpenCompany\Integrations\Workable\Tools\WorkableListMembers;
use OpenCompany\Integrations\Workable\Tools\WorkableGetCurrentUser;

/**
 * Tool provider for the Workable ATS integration.
 *
 * Implements ConfigurableIntegration for multi-account support, credential management,
 * connection testing, and full tool registration with the integration-core registry.
 */
class WorkableToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * The application name used for registration.
     */
    public function appName(): string
    {
        return 'workable';
    }

    /**
     * Metadata for the app picker / tool listing UI.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'jobs, candidates, members',
            'description' => 'Applicant tracking system',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:workable',
        ];
    }

    /**
     * Integration metadata for the integrations catalog.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Workable',
            'description' => 'Applicant tracking system for recruiting and hiring',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:workable',
            'category' => 'hr',
            'badge' => 'verified',
            'docs_url' => 'https://workable.readme.io/reference',
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
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Workable API access token',
                'hint' => 'Generate an access token in your Workable account under <strong>Settings &gt; Integrations &gt; Access Token</strong>',
                'required' => true,
            ],
            [
                'key' => 'subdomain',
                'type' => 'text',
                'label' => 'Subdomain',
                'placeholder' => 'your-company',
                'hint' => 'Your Workable account subdomain (the part before <code>.workable.com</code>)',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Workable API using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $subdomain = $config['subdomain'] ?? '';

        if (empty($accessToken) || empty($subdomain)) {
            return ['success' => false, 'error' => 'Access token and subdomain are required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get("https://www.workable.com/spi/v3/accounts/{$subdomain}/user");

            if ($response->successful()) {
                $data = $response->json();
                $name = $data['name'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Workable as {$name} ({$subdomain}).",
                ];
            }

            return [
                'success' => false,
                'error' => "Workable API returned HTTP {$response->status()}. Check your access token and subdomain.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'required|string',
            'subdomain' => 'required|string',
        ];
    }

    /**
     * Return the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'workable_list_jobs' => [
                'class' => WorkableListJobs::class,
                'type' => 'read',
                'name' => 'List Jobs',
                'description' => 'List open and closed jobs in your Workable account.',
                'icon' => 'ph:briefcase',
            ],
            'workable_get_job' => [
                'class' => WorkableGetJob::class,
                'type' => 'read',
                'name' => 'Get Job',
                'description' => 'Get details for a specific job by shortcode.',
                'icon' => 'ph:briefcase',
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
                'description' => 'Get details for a specific candidate.',
                'icon' => 'ph:user',
            ],
            'workable_create_candidate' => [
                'class' => WorkableCreateCandidate::class,
                'type' => 'write',
                'name' => 'Create Candidate',
                'description' => 'Create a new candidate for a specific job.',
                'icon' => 'ph:user-plus',
            ],
            'workable_list_members' => [
                'class' => WorkableListMembers::class,
                'type' => 'read',
                'name' => 'List Members',
                'description' => 'List team members in your Workable account.',
                'icon' => 'ph:users-three',
            ],
            'workable_get_current_user' => [
                'class' => WorkableGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user\'s profile.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/workable.md';
    }

    /**
     * Credential field definitions for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'subdomain', 'type' => 'text', 'label' => 'Subdomain', 'required' => true],
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
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  string  $class    The tool class to instantiate.
     * @param  array   $context  Context containing optional 'account' for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new WorkableService(
                accessToken: $creds->get('workable', 'access_token', '', $account),
                subdomain: $creds->get('workable', 'subdomain', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(WorkableService::class));
    }
}
