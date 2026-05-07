<?php

namespace OpenCompany\Integrations\Recruitee;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeApiDelete;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeApiGet;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeApiPatch;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeApiPost;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeCreateCandidate;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeCreateOffer;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeDeleteCandidate;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeDeleteOffer;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeGetCandidate;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeGetCurrentUser;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeGetOffer;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeListCandidateNotes;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeListCandidates;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeListDepartments;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeListLocations;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeListOffers;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeSearchCandidates;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeUpdateCandidate;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeUpdateCandidateCv;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeUpdateOffer;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeUploadAttachment;

/**
 * Exposes Recruitee tools and credential metadata to host applications.
 */
class RecruiteeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const DEFAULT_BASE_URL = 'https://api.recruitee.com/c/{company_id}';

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
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
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
            'label' => 'Recruitee',
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
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.recruitee.com/reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Recruitee API token',
                'hint' => 'Generate a personal API token in Recruitee and store it as a bearer token.',
                'required' => true,
            ],
            [
                'key' => 'company_id',
                'type' => 'text',
                'label' => 'Company ID',
                'placeholder' => '123456 or company-subdomain',
                'hint' => 'Recruitee company ID. A company subdomain can also be used by the API.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => self::DEFAULT_BASE_URL,
                'hint' => 'Use the default Recruitee Core API URL unless you are targeting another environment.',
                'default' => self::DEFAULT_BASE_URL,
            ],
        ];
    }

    /**
     * Verify credentials with a lightweight company metadata endpoint.
     *
     * @param  array<string, mixed>  $config  Recruitee connection configuration.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = trim((string) ($config['access_token'] ?? ''));
        $companyId = trim((string) ($config['company_id'] ?? ''));

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        if ($companyId === '') {
            return ['success' => false, 'error' => 'No company ID provided.'];
        }

        try {
            $service = new RecruiteeService(
                accessToken: $accessToken,
                companyId: $companyId,
                baseUrl: (string) ($config['url'] ?? self::DEFAULT_BASE_URL),
            );
            $service->listDepartments();

            return [
                'success' => true,
                'message' => 'Connected to Recruitee API.',
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'required|string',
            'company_id' => 'required|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'recruitee_list_offers' => ['class' => RecruiteeListOffers::class, 'type' => 'read', 'name' => 'List Offers', 'description' => 'List company offers.', 'icon' => 'ph:briefcase'],
            'recruitee_get_offer' => ['class' => RecruiteeGetOffer::class, 'type' => 'read', 'name' => 'Get Offer', 'description' => 'Get one offer.', 'icon' => 'ph:briefcase'],
            'recruitee_create_offer' => ['class' => RecruiteeCreateOffer::class, 'type' => 'write', 'name' => 'Create Offer', 'description' => 'Create a company offer.', 'icon' => 'ph:briefcase'],
            'recruitee_update_offer' => ['class' => RecruiteeUpdateOffer::class, 'type' => 'write', 'name' => 'Update Offer', 'description' => 'Update a company offer.', 'icon' => 'ph:pencil-simple'],
            'recruitee_delete_offer' => ['class' => RecruiteeDeleteOffer::class, 'type' => 'write', 'name' => 'Delete Offer', 'description' => 'Delete a company offer.', 'icon' => 'ph:trash'],
            'recruitee_list_candidates' => ['class' => RecruiteeListCandidates::class, 'type' => 'read', 'name' => 'List Candidates', 'description' => 'List candidates.', 'icon' => 'ph:users'],
            'recruitee_search_candidates' => ['class' => RecruiteeSearchCandidates::class, 'type' => 'read', 'name' => 'Search Candidates', 'description' => 'Search candidates through the new search endpoint.', 'icon' => 'ph:magnifying-glass'],
            'recruitee_get_candidate' => ['class' => RecruiteeGetCandidate::class, 'type' => 'read', 'name' => 'Get Candidate', 'description' => 'Get one candidate.', 'icon' => 'ph:user'],
            'recruitee_create_candidate' => ['class' => RecruiteeCreateCandidate::class, 'type' => 'write', 'name' => 'Create Candidate', 'description' => 'Create a candidate.', 'icon' => 'ph:user-plus'],
            'recruitee_update_candidate' => ['class' => RecruiteeUpdateCandidate::class, 'type' => 'write', 'name' => 'Update Candidate', 'description' => 'Update a candidate.', 'icon' => 'ph:pencil-simple'],
            'recruitee_update_candidate_cv' => ['class' => RecruiteeUpdateCandidateCv::class, 'type' => 'write', 'name' => 'Update Candidate CV', 'description' => 'Update a candidate CV file.', 'icon' => 'ph:file-arrow-up'],
            'recruitee_delete_candidate' => ['class' => RecruiteeDeleteCandidate::class, 'type' => 'write', 'name' => 'Delete Candidate', 'description' => 'Delete a candidate.', 'icon' => 'ph:trash'],
            'recruitee_list_candidate_notes' => ['class' => RecruiteeListCandidateNotes::class, 'type' => 'read', 'name' => 'List Candidate Notes', 'description' => 'List notes for one candidate.', 'icon' => 'ph:note'],
            'recruitee_list_departments' => ['class' => RecruiteeListDepartments::class, 'type' => 'read', 'name' => 'List Departments', 'description' => 'List departments.', 'icon' => 'ph:buildings'],
            'recruitee_list_locations' => ['class' => RecruiteeListLocations::class, 'type' => 'read', 'name' => 'List Locations', 'description' => 'List company locations.', 'icon' => 'ph:map-pin'],
            'recruitee_upload_attachment' => ['class' => RecruiteeUploadAttachment::class, 'type' => 'write', 'name' => 'Upload Attachment', 'description' => 'Upload a remote file attachment.', 'icon' => 'ph:paperclip'],
            'recruitee_get_current_user' => ['class' => RecruiteeGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get current user when available.', 'icon' => 'ph:user-circle'],
            'recruitee_api_get' => ['class' => RecruiteeApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a documented Recruitee GET endpoint.', 'icon' => 'ph:terminal-window'],
            'recruitee_api_post' => ['class' => RecruiteeApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a documented Recruitee POST endpoint.', 'icon' => 'ph:terminal-window'],
            'recruitee_api_patch' => ['class' => RecruiteeApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call a documented Recruitee PATCH endpoint.', 'icon' => 'ph:terminal-window'],
            'recruitee_api_delete' => ['class' => RecruiteeApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a documented Recruitee DELETE endpoint.', 'icon' => 'ph:terminal-window'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/recruitee.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'company_id', 'type' => 'text', 'label' => 'Company ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => self::DEFAULT_BASE_URL],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Recruitee service for the default or selected account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): RecruiteeService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new RecruiteeService(
                accessToken: $creds->get('recruitee', 'access_token', '', $account),
                companyId: $creds->get('recruitee', 'company_id', '', $account),
                baseUrl: $creds->get('recruitee', 'url', self::DEFAULT_BASE_URL, $account),
            );
        }

        return app(RecruiteeService::class);
    }
}
