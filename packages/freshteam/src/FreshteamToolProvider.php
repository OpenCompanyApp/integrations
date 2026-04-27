<?php

namespace OpenCompany\Integrations\Freshteam;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Freshteam\Tools\FreshteamListCandidates;
use OpenCompany\Integrations\Freshteam\Tools\FreshteamGetCandidate;
use OpenCompany\Integrations\Freshteam\Tools\FreshteamListJobPostings;
use OpenCompany\Integrations\Freshteam\Tools\FreshteamGetJobPosting;
use OpenCompany\Integrations\Freshteam\Tools\FreshteamListEmployees;
use OpenCompany\Integrations\Freshteam\Tools\FreshteamGetEmployee;
use OpenCompany\Integrations\Freshteam\Tools\FreshteamGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class FreshteamToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'freshteam';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'candidates, jobs, employees',
            'description' => 'HR & recruitment',
            'icon' => 'ph:users-three',
            'logo' => 'simple-icons:freshteam',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Freshteam',
            'description' => 'HR software for recruiting, onboarding, and employee management',
            'icon' => 'ph:users-three',
            'logo' => 'simple-icons:freshteam',
            'category' => 'hr',
            'badge' => 'verified',
            'docs_url' => 'https://developers.freshteam.com/api/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Freshteam API access token',
                'hint' => 'Generate an API token in your Freshteam account under <strong>Settings → API Settings</strong>',
                'required' => true,
            ],
            [
                'key' => 'domain',
                'type' => 'string',
                'label' => 'Domain',
                'placeholder' => 'acme',
                'hint' => 'Your Freshteam subdomain (the part before <code>.freshteam.com</code>). E.g. <code>acme</code> for <code>acme.freshteam.com</code>.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $domain = $config['domain'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($domain)) {
            return ['success' => false, 'error' => 'No domain provided'];
        }

        try {
            $baseUrl = 'https://' . rtrim($domain, '.') . '.freshteam.com';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Freshteam API at {$baseUrl}. Check the domain.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Freshteam API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'domain' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'freshteam_list_candidates' => [
                'class' => FreshteamListCandidates::class,
                'type' => 'read',
                'name' => 'List Candidates',
                'description' => 'List recruitment candidates with pagination and status filtering.',
                'icon' => 'ph:users',
            ],
            'freshteam_get_candidate' => [
                'class' => FreshteamGetCandidate::class,
                'type' => 'read',
                'name' => 'Get Candidate',
                'description' => 'Retrieve details for a specific candidate.',
                'icon' => 'ph:user',
            ],
            'freshteam_list_job_postings' => [
                'class' => FreshteamListJobPostings::class,
                'type' => 'read',
                'name' => 'List Job Postings',
                'description' => 'List job postings with pagination, status, and department filtering.',
                'icon' => 'ph:briefcase',
            ],
            'freshteam_get_job_posting' => [
                'class' => FreshteamGetJobPosting::class,
                'type' => 'read',
                'name' => 'Get Job Posting',
                'description' => 'Retrieve details for a specific job posting.',
                'icon' => 'ph:briefcase',
            ],
            'freshteam_list_employees' => [
                'class' => FreshteamListEmployees::class,
                'type' => 'read',
                'name' => 'List Employees',
                'description' => 'List employees with pagination and department filtering.',
                'icon' => 'ph:users-three',
            ],
            'freshteam_get_employee' => [
                'class' => FreshteamGetEmployee::class,
                'type' => 'read',
                'name' => 'Get Employee',
                'description' => 'Retrieve details for a specific employee.',
                'icon' => 'ph:user-circle',
            ],
            'freshteam_get_current_user' => [
                'class' => FreshteamGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Retrieve the currently authenticated user profile.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/freshteam.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'domain', 'type' => 'string', 'label' => 'Domain', 'required' => true],
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

            $service = new FreshteamService(
                accessToken: $creds->get('freshteam', 'access_token', '', $account),
                domain: $creds->get('freshteam', 'domain', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(FreshteamService::class));
    }
}
