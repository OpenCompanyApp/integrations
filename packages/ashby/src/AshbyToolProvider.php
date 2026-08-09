<?php

namespace OpenCompany\Integrations\Ashby;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Ashby\Tools\AshbyApiPost;
use OpenCompany\Integrations\Ashby\Tools\AshbyApproveOffer;
use OpenCompany\Integrations\Ashby\Tools\AshbyCreateApplication;
use OpenCompany\Integrations\Ashby\Tools\AshbyCreateCandidate;
use OpenCompany\Integrations\Ashby\Tools\AshbyCreateJob;
use OpenCompany\Integrations\Ashby\Tools\AshbyCreateNote;
use OpenCompany\Integrations\Ashby\Tools\AshbyCreateOffer;
use OpenCompany\Integrations\Ashby\Tools\AshbyCreateOpening;
use OpenCompany\Integrations\Ashby\Tools\AshbyCreateWebhook;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetApplication;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetCandidate;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetCurrentUser;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetFile;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetInterview;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetJob;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetJobPosting;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetOffer;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetWebhook;
use OpenCompany\Integrations\Ashby\Tools\AshbyListApplications;
use OpenCompany\Integrations\Ashby\Tools\AshbyListCandidateNotes;
use OpenCompany\Integrations\Ashby\Tools\AshbyListCandidates;
use OpenCompany\Integrations\Ashby\Tools\AshbyListCriteriaEvaluations;
use OpenCompany\Integrations\Ashby\Tools\AshbyListDepartments;
use OpenCompany\Integrations\Ashby\Tools\AshbyListInterviewEvents;
use OpenCompany\Integrations\Ashby\Tools\AshbyListInterviewPlans;
use OpenCompany\Integrations\Ashby\Tools\AshbyListInterviews;
use OpenCompany\Integrations\Ashby\Tools\AshbyListInterviewSchedules;
use OpenCompany\Integrations\Ashby\Tools\AshbyListJobPostings;
use OpenCompany\Integrations\Ashby\Tools\AshbyListJobs;
use OpenCompany\Integrations\Ashby\Tools\AshbyListLocations;
use OpenCompany\Integrations\Ashby\Tools\AshbyListOffers;
use OpenCompany\Integrations\Ashby\Tools\AshbyListOpenings;
use OpenCompany\Integrations\Ashby\Tools\AshbyListSources;
use OpenCompany\Integrations\Ashby\Tools\AshbyListUsers;
use OpenCompany\Integrations\Ashby\Tools\AshbyListWebhooks;
use OpenCompany\Integrations\Ashby\Tools\AshbySearchCandidates;
use OpenCompany\Integrations\Ashby\Tools\AshbySearchJobs;
use OpenCompany\Integrations\Ashby\Tools\AshbySetCustomFieldValue;
use OpenCompany\Integrations\Ashby\Tools\AshbyUpdateApplication;
use OpenCompany\Integrations\Ashby\Tools\AshbyUpdateAssessment;
use OpenCompany\Integrations\Ashby\Tools\AshbyUpdateCandidate;
use OpenCompany\Integrations\Ashby\Tools\AshbyUpdateInterviewSchedule;
use OpenCompany\Integrations\Ashby\Tools\AshbyUpdateJob;
use OpenCompany\Integrations\Ashby\Tools\AshbyUpdateOffer;

/**
 * Tool provider for the Ashby ATS integration.
 *
 * Registers candidate, application, job, interview, offer, webhook, and raw
 * endpoint tools for Ashby's public RPC-style API.
 */
class AshbyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'basic_api_key',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Ashby uses HTTP Basic auth with the API key as username and an empty password.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
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
        return 'ashby';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Ashby',
            'description' => 'Applicant tracking and recruiting workflows',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:ashby',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Ashby',
            'description' => 'Applicant tracking API for candidates, applications, jobs, interviews, offers, and webhooks',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:ashby',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.ashbyhq.com/reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Ashby API key',
                'hint' => 'Generate an API key in Ashby account settings under Integrations > API',
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

    /**
     * Test the connection to the Ashby API using the provided config.
     *
     * @param  array<string, mixed>  $config  Credential form values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.ashbyhq.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($accessToken, '')->timeout(10)->post($baseUrl . '/user.me');

            if (!$response->successful()) {
                $error = $response->json('errors') ?? $response->json('error') ?? "HTTP {$response->status()}";

                return ['success' => false, 'error' => is_string($error) ? $error : json_encode($error)];
            }

            $user = $response->json('results') ?? $response->json();

            return [
                'success' => true,
                'message' => 'Connected to Ashby API.' . (isset($user['email']) ? " Logged in as {$user['email']}." : ''),
            ];
        } catch (\Throwable $e) {
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
            'ashby_api_post' => ['class' => AshbyApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call any Ashby RPC API endpoint.', 'icon' => 'ph:plug'],
            'ashby_get_current_user' => ['class' => AshbyGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the authenticated Ashby user profile.', 'icon' => 'ph:user'],
            'ashby_list_users' => ['class' => AshbyListUsers::class, 'type' => 'read', 'name' => 'List Users', 'description' => 'List Ashby users.', 'icon' => 'ph:users'],

            'ashby_list_candidates' => ['class' => AshbyListCandidates::class, 'type' => 'read', 'name' => 'List Candidates', 'description' => 'List candidates with pagination and sync tokens.', 'icon' => 'ph:users-three'],
            'ashby_search_candidates' => ['class' => AshbySearchCandidates::class, 'type' => 'read', 'name' => 'Search Candidates', 'description' => 'Search candidates by name or email.', 'icon' => 'ph:magnifying-glass'],
            'ashby_get_candidate' => ['class' => AshbyGetCandidate::class, 'type' => 'read', 'name' => 'Get Candidate', 'description' => 'Get a single candidate.', 'icon' => 'ph:user'],
            'ashby_create_candidate' => ['class' => AshbyCreateCandidate::class, 'type' => 'write', 'name' => 'Create Candidate', 'description' => 'Create a candidate.', 'icon' => 'ph:user-plus'],
            'ashby_update_candidate' => ['class' => AshbyUpdateCandidate::class, 'type' => 'write', 'name' => 'Update Candidate', 'description' => 'Update a candidate.', 'icon' => 'ph:pencil-simple'],
            'ashby_create_note' => ['class' => AshbyCreateNote::class, 'type' => 'write', 'name' => 'Create Note', 'description' => 'Create a note on a candidate.', 'icon' => 'ph:note-pencil'],
            'ashby_list_candidate_notes' => ['class' => AshbyListCandidateNotes::class, 'type' => 'read', 'name' => 'List Candidate Notes', 'description' => 'List notes for a candidate.', 'icon' => 'ph:note'],

            'ashby_list_applications' => ['class' => AshbyListApplications::class, 'type' => 'read', 'name' => 'List Applications', 'description' => 'List applications.', 'icon' => 'ph:files'],
            'ashby_get_application' => ['class' => AshbyGetApplication::class, 'type' => 'read', 'name' => 'Get Application', 'description' => 'Get application details.', 'icon' => 'ph:file-text'],
            'ashby_create_application' => ['class' => AshbyCreateApplication::class, 'type' => 'write', 'name' => 'Create Application', 'description' => 'Create an application for a candidate and job.', 'icon' => 'ph:file-plus'],
            'ashby_update_application' => ['class' => AshbyUpdateApplication::class, 'type' => 'write', 'name' => 'Update Application', 'description' => 'Update an application.', 'icon' => 'ph:pencil-simple'],
            'ashby_list_criteria_evaluations' => ['class' => AshbyListCriteriaEvaluations::class, 'type' => 'read', 'name' => 'List Criteria Evaluations', 'description' => 'List AI criteria evaluations for an application.', 'icon' => 'ph:chart-line'],

            'ashby_list_jobs' => ['class' => AshbyListJobs::class, 'type' => 'read', 'name' => 'List Jobs', 'description' => 'List jobs.', 'icon' => 'ph:briefcase'],
            'ashby_search_jobs' => ['class' => AshbySearchJobs::class, 'type' => 'read', 'name' => 'Search Jobs', 'description' => 'Search jobs.', 'icon' => 'ph:magnifying-glass'],
            'ashby_get_job' => ['class' => AshbyGetJob::class, 'type' => 'read', 'name' => 'Get Job', 'description' => 'Get a job.', 'icon' => 'ph:briefcase'],
            'ashby_create_job' => ['class' => AshbyCreateJob::class, 'type' => 'write', 'name' => 'Create Job', 'description' => 'Create a job.', 'icon' => 'ph:briefcase'],
            'ashby_update_job' => ['class' => AshbyUpdateJob::class, 'type' => 'write', 'name' => 'Update Job', 'description' => 'Update a job.', 'icon' => 'ph:pencil-simple'],
            'ashby_list_job_postings' => ['class' => AshbyListJobPostings::class, 'type' => 'read', 'name' => 'List Job Postings', 'description' => 'List job postings.', 'icon' => 'ph:megaphone'],
            'ashby_get_job_posting' => ['class' => AshbyGetJobPosting::class, 'type' => 'read', 'name' => 'Get Job Posting', 'description' => 'Get a job posting.', 'icon' => 'ph:megaphone'],
            'ashby_list_openings' => ['class' => AshbyListOpenings::class, 'type' => 'read', 'name' => 'List Openings', 'description' => 'List openings.', 'icon' => 'ph:door-open'],
            'ashby_create_opening' => ['class' => AshbyCreateOpening::class, 'type' => 'write', 'name' => 'Create Opening', 'description' => 'Create an opening.', 'icon' => 'ph:plus'],
            'ashby_list_departments' => ['class' => AshbyListDepartments::class, 'type' => 'read', 'name' => 'List Departments', 'description' => 'List departments/teams.', 'icon' => 'ph:tree-structure'],
            'ashby_list_locations' => ['class' => AshbyListLocations::class, 'type' => 'read', 'name' => 'List Locations', 'description' => 'List locations.', 'icon' => 'ph:map-pin'],
            'ashby_list_sources' => ['class' => AshbyListSources::class, 'type' => 'read', 'name' => 'List Sources', 'description' => 'List sources.', 'icon' => 'ph:git-branch'],

            'ashby_list_interviews' => ['class' => AshbyListInterviews::class, 'type' => 'read', 'name' => 'List Interviews', 'description' => 'List interviews.', 'icon' => 'ph:calendar'],
            'ashby_get_interview' => ['class' => AshbyGetInterview::class, 'type' => 'read', 'name' => 'Get Interview', 'description' => 'Get an interview schedule.', 'icon' => 'ph:calendar-check'],
            'ashby_list_interview_plans' => ['class' => AshbyListInterviewPlans::class, 'type' => 'read', 'name' => 'List Interview Plans', 'description' => 'List interview plans.', 'icon' => 'ph:list-checks'],
            'ashby_list_interview_schedules' => ['class' => AshbyListInterviewSchedules::class, 'type' => 'read', 'name' => 'List Interview Schedules', 'description' => 'List interview schedules.', 'icon' => 'ph:calendar'],
            'ashby_update_interview_schedule' => ['class' => AshbyUpdateInterviewSchedule::class, 'type' => 'write', 'name' => 'Update Interview Schedule', 'description' => 'Update an interview schedule.', 'icon' => 'ph:pencil-simple'],
            'ashby_list_interview_events' => ['class' => AshbyListInterviewEvents::class, 'type' => 'read', 'name' => 'List Interview Events', 'description' => 'List interview events.', 'icon' => 'ph:calendar-dots'],

            'ashby_list_offers' => ['class' => AshbyListOffers::class, 'type' => 'read', 'name' => 'List Offers', 'description' => 'List offers.', 'icon' => 'ph:handshake'],
            'ashby_get_offer' => ['class' => AshbyGetOffer::class, 'type' => 'read', 'name' => 'Get Offer', 'description' => 'Get an offer.', 'icon' => 'ph:handshake'],
            'ashby_create_offer' => ['class' => AshbyCreateOffer::class, 'type' => 'write', 'name' => 'Create Offer', 'description' => 'Create an offer.', 'icon' => 'ph:plus'],
            'ashby_update_offer' => ['class' => AshbyUpdateOffer::class, 'type' => 'write', 'name' => 'Update Offer', 'description' => 'Update an offer.', 'icon' => 'ph:pencil-simple'],
            'ashby_approve_offer' => ['class' => AshbyApproveOffer::class, 'type' => 'write', 'name' => 'Approve Offer', 'description' => 'Approve an offer.', 'icon' => 'ph:check'],

            'ashby_get_file' => ['class' => AshbyGetFile::class, 'type' => 'read', 'name' => 'Get File', 'description' => 'Retrieve a file URL.', 'icon' => 'ph:file'],
            'ashby_set_custom_field_value' => ['class' => AshbySetCustomFieldValue::class, 'type' => 'write', 'name' => 'Set Custom Field Value', 'description' => 'Set a custom field value.', 'icon' => 'ph:tag'],
            'ashby_list_webhooks' => ['class' => AshbyListWebhooks::class, 'type' => 'read', 'name' => 'List Webhooks', 'description' => 'List webhook settings.', 'icon' => 'ph:webhooks-logo'],
            'ashby_get_webhook' => ['class' => AshbyGetWebhook::class, 'type' => 'read', 'name' => 'Get Webhook', 'description' => 'Get a webhook setting.', 'icon' => 'ph:webhooks-logo'],
            'ashby_create_webhook' => ['class' => AshbyCreateWebhook::class, 'type' => 'write', 'name' => 'Create Webhook', 'description' => 'Create a webhook setting.', 'icon' => 'ph:webhooks-logo'],
            'ashby_update_assessment' => ['class' => AshbyUpdateAssessment::class, 'type' => 'write', 'name' => 'Update Assessment', 'description' => 'Update assessment status/results.', 'icon' => 'ph:clipboard-text'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/ashby.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.ashbyhq.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @param  array<string, mixed>  $context  Optional context containing account.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve default or account-scoped Ashby credentials.
     *
     * @param  array<string, mixed>  $context  Optional context containing account.
     */
    private function resolveService(array $context = []): AshbyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AshbyService(
                accessToken: $creds->get('ashby', 'access_token', '', $account),
                baseUrl: $creds->get('ashby', 'url', 'https://api.ashbyhq.com', $account),
            );
        }

        return app(AshbyService::class);
    }
}
