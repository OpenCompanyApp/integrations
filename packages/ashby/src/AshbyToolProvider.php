<?php

namespace OpenCompany\Integrations\Ashby;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Ashby\Tools\AshbyListApplications;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetApplication;
use OpenCompany\Integrations\Ashby\Tools\AshbyListJobs;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetJob;
use OpenCompany\Integrations\Ashby\Tools\AshbyListInterviews;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetInterview;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\Ashby\Tools\AshbyCreateNote;
use OpenCompany\Integrations\Ashby\Tools\AshbyListCandidates;
/**
 * Tool provider for the Ashby ATS integration.
 *
 * Registers all Ashby tools with the integration registry and provides
 * configuration schema, connection testing, and multi-account support.
 */
class AshbyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'ashby';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Ashby',
            'description' => 'Applicant tracking system',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:ashby',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Ashby',
            'description' => 'Modern applicant tracking system for growing companies',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:ashby',
            'category' => 'hr',
            'badge' => 'verified',
            'docs_url' => 'https://developers.ashbyhq.com',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Ashby API access token',
                'hint' => 'Generate an API key in your Ashby account settings under "Integrations → API"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.ashbyhq.com',
                'hint' => 'Use the default <code>https://api.ashbyhq.com</code> unless using a custom endpoint',
                'default' => 'https://api.ashbyhq.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.ashbyhq.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->post($baseUrl . '/api/v1/user.me');

            if (!$response->successful()) {
                $error = $response->json('errors') ?? $response->json('error') ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => is_string($error) ? $error : json_encode($error),
                ];
            }

            $user = $response->json('results') ?? $response->json();

            return [
                'success' => true,
                'message' => "Connected to Ashby API." . (isset($user['email']) ? " Logged in as {$user['email']}." : ''),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

        public function tools(): array
    {
        return [
            'ashby_create_note' => [
                'class' => AshbyCreateNote::class,
                'type' => 'write',
                'name' => 'Create Note',
                'description' => 'Create a note in Ashby attached to a candidate, application, or job. Notes are visible to the hiring team and appear in activity feeds.',
                'icon' => 'ph:wrench',
            ],
            'ashby_get_application' => [
                'class' => AshbyGetApplication::class,
                'type' => 'read',
                'name' => 'Get Application',
                'description' => 'Get detailed information about a specific job application in Ashby, including candidate details, status, and evaluation data.',
                'icon' => 'ph:wrench',
            ],
            'ashby_get_current_user' => [
                'class' => AshbyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated Ashby user. Use this to verify API access and see user details.',
                'icon' => 'ph:wrench',
            ],
            'ashby_get_interview' => [
                'class' => AshbyGetInterview::class,
                'type' => 'read',
                'name' => 'Get Interview',
                'description' => 'Get detailed information about a specific interview in Ashby, including scheduled time, interviewers, feedback, and scorecards.',
                'icon' => 'ph:wrench',
            ],
            'ashby_get_job' => [
                'class' => AshbyGetJob::class,
                'type' => 'read',
                'name' => 'Get Job',
                'description' => 'Get detailed information about a specific job in Ashby, including full description, requirements, compensation, and hiring team.',
                'icon' => 'ph:wrench',
            ],
            'ashby_list_applications' => [
                'class' => AshbyListApplications::class,
                'type' => 'read',
                'name' => 'List Applications',
                'description' => 'List job applications in Ashby. Returns applications with candidate info, status, and associated job. Use filters to narrow by job or status.',
                'icon' => 'ph:wrench',
            ],
            'ashby_list_candidates' => [
                'class' => AshbyListCandidates::class,
                'type' => 'read',
                'name' => 'List Candidates',
                'description' => 'List candidates from Ashby. Returns candidate profiles with contact info, tags, and source. Supports filtering by name, email, tags, and pagination.',
                'icon' => 'ph:wrench',
            ],
            'ashby_list_interviews' => [
                'class' => AshbyListInterviews::class,
                'type' => 'read',
                'name' => 'List Interviews',
                'description' => 'List scheduled interviews in Ashby. Returns interview details with date, time, interviewers, and associated application. Filter by application to see interviews for a specific candidate.',
                'icon' => 'ph:wrench',
            ],
            'ashby_list_jobs' => [
                'class' => AshbyListJobs::class,
                'type' => 'read',
                'name' => 'List Jobs',
                'description' => 'List job postings in Ashby. Returns open and closed positions with department, location, and application count. Filter by status to find active openings.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/ashby.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.ashbyhq.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new AshbyService(
                accessToken: $creds->get('ashby', 'access_token', '', $account),
                baseUrl: $creds->get('ashby', 'url', 'https://api.ashbyhq.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(AshbyService::class));
    }
}
