<?php

namespace OpenCompany\Integrations\Recruitee;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeListOffers;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeGetOffer;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeListCandidates;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeGetCandidate;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeListDepartments;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class RecruiteeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'recruitee';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'offers, candidates, departments',
            'description' => 'Applicant tracking system',
            'icon' => 'ph:users-three',
            'logo' => 'simple-icons:recruitee',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Recruitee',
            'description' => 'Applicant tracking system for hiring teams',
            'icon' => 'ph:users-three',
            'logo' => 'simple-icons:recruitee',
            'category' => 'hr',
            'badge' => 'verified',
            'docs_url' => 'https://docs.recruitee.com/reference',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Recruitee API token',
                'hint' => 'Generate a personal API token in your Recruitee account under Settings → Integrations → API Tokens',
                'required' => true,
            ],
            [
                'key' => 'company_id',
                'type' => 'text',
                'label' => 'Company ID',
                'placeholder' => 'Enter your Recruitee company ID',
                'hint' => 'Found in your Recruitee account settings. Used to identify your company in API requests.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://{company}.recruitee.com/api/v2',
                'hint' => 'Use the default Recruitee cloud URL, or your custom domain if applicable.',
                'default' => 'https://{company}.recruitee.com/api/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://{company}.recruitee.com/api/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $data = $response->json();
                $userName = $data['first_name'] . ' ' . $data['last_name'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Recruitee API as {$userName}.",
                ];
            }

            return [
                'success' => false,
                'error' => "API returned status {$response->status()}. Check your access token and URL.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'company_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'recruitee_list_offers' => [
                'class' => RecruiteeListOffers::class,
                'type' => 'read',
                'name' => 'List Offers',
                'description' => 'List job offers (open positions) from Recruitee.',
                'icon' => 'ph:briefcase',
            ],
            'recruitee_get_offer' => [
                'class' => RecruiteeGetOffer::class,
                'type' => 'read',
                'name' => 'Get Offer',
                'description' => 'Get details for a specific job offer.',
                'icon' => 'ph:briefcase',
            ],
            'recruitee_list_candidates' => [
                'class' => RecruiteeListCandidates::class,
                'type' => 'read',
                'name' => 'List Candidates',
                'description' => 'List candidates from Recruitee.',
                'icon' => 'ph:users',
            ],
            'recruitee_get_candidate' => [
                'class' => RecruiteeGetCandidate::class,
                'type' => 'read',
                'name' => 'Get Candidate',
                'description' => 'Get details for a specific candidate.',
                'icon' => 'ph:user',
            ],
            'recruitee_list_departments' => [
                'class' => RecruiteeListDepartments::class,
                'type' => 'read',
                'name' => 'List Departments',
                'description' => 'List all departments in Recruitee.',
                'icon' => 'ph:buildings',
            ],
            'recruitee_get_current_user' => [
                'class' => RecruiteeGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Recruitee user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/recruitee.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'company_id', 'type' => 'text', 'label' => 'Company ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://{company}.recruitee.com/api/v2'],
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

            $service = new RecruiteeService(
                accessToken: $creds->get('recruitee', 'access_token', '', $account),
                companyId: $creds->get('recruitee', 'company_id', '', $account),
                baseUrl: $creds->get('recruitee', 'url', 'https://{company}.recruitee.com/api/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(RecruiteeService::class));
    }
}
