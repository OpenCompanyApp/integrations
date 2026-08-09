<?php

namespace OpenCompany\Integrations\Greenhouse;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostAuthToken;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3ApplicationStages;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3ApplicationsIdConvertToCandidate;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3Applications;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Applications;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3ApplicationsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3ApplicationsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3ApplicationsIdHire;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3ApplicationsIdMove;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3ApplicationsIdReject;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3ApplicationsIdUnreject;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3AppliedCandidateTags;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3AppliedCandidateTags;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3AppliedCandidateTagsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3ApprovalFlows;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3ApprovalFlows;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePutV3ApprovalFlowsIdReplaceApproverGroups;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3ApprovalFlowsIdRequestApprovals;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3ApprovalFlowsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3ApproverGroups;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePutV3ApproverGroupsIdReplaceApprover;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Approvers;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3Attachments;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Attachments;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3AttachmentsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3BulkRequests;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3BulkRequestsAbc123Def456;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3CandidateAttributeTypes;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3CandidateEducations;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3CandidateEducations;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3CandidateEducationsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3CandidateEmployments;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3CandidateEmployments;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3CandidateEmploymentsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3CandidateTags;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3CandidateTags;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3CandidateTagsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3CandidatesIdAnonymize;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3Candidates;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Candidates;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3CandidatesId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3CandidatesId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3CandidatesIdMerge;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3CloseReasons;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3CustomFieldDepartments;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3CustomFieldDepartments;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3CustomFieldDepartmentsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3CustomFieldOffices;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3CustomFieldOffices;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3CustomFieldOfficesId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3CustomFieldOptions;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3CustomFieldOptions;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3CustomFieldOptionsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3CustomFieldOptionsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3CustomFields;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3CustomFields;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3CustomFieldsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3CustomFieldsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3DefaultInterviewers;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3DemographicAnswerOptions;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3DemographicAnswers;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3DemographicQuestionSets;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3DemographicQuestions;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3Departments;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Departments;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3DepartmentsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Eeoc;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3EmailTemplates;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3FocusCandidateAttributes;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3FutureJobPermissions;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3FutureJobPermissions;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3FutureJobPermissionsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3InterviewKits;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3InterviewerTags;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Interviewers;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3Interviews;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Interviews;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3InterviewsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3InterviewsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3JobBoardCustomLocations;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3JobCandidateAttributes;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3JobHiringManagers;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3JobHiringManagers;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3JobHiringManagersId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3JobInterviewStages;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3JobInterviews;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3JobNotes;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3JobNotes;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3JobNotesId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3JobNotesId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3JobOwners;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3JobOwners;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3JobOwnersId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3JobPostLocations;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3JobPostLocations;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3JobPostLocationsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3JobPosts;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3JobPostsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3Jobs;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Jobs;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3JobsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3Notes;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3Offers;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Offers;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3OffersId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3Offices;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Offices;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3OfficesId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3Openings;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Openings;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3OpeningsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3OpeningsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3ProspectDetails;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3ProspectPoolStages;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3ProspectPools;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Referrers;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3RejectionDetails;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3RejectionDetailsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3RejectionReasons;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3ScorecardCandidateAttributes;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3ScorecardCandidateAttributes;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3ScorecardCandidateAttributesId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3ScorecardQuestionAnswerOptions;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3ScorecardQuestionAnswerOptions;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3ScorecardQuestionAnswers;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3ScorecardQuestionAnswers;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3ScorecardQuestionAnswersId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3ScorecardQuestionCandidateAttributes;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3ScorecardQuestionOptions;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3ScorecardQuestions;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3Scorecards;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Scorecards;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3ScorecardsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Sources;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3TrackingLinks;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3UserEmails;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3UserEmails;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3UserJobPermissions;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3UserJobPermissions;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3UserJobPermissionsId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3UserRoles;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3UsersIdActivate;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3UsersIdDeactivate;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Users;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3Users;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3UsersIdRevokePermissions;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3UsersId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePostV3Webhooks;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseGetV3Webhooks;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhouseDeleteV3WebhooksId;
use OpenCompany\Integrations\Greenhouse\Tools\GreenhousePatchV3WebhooksId;

/**
 * Tool catalog and configuration metadata for Greenhouse Harvest.
 *
 * Exposes the official Harvest v3 OpenAPI operation set as endpoint-specific
 * tools and resolves account-specific OAuth credentials for multi-account hosts.
 */
class GreenhouseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'oauth_client_credentials', 'legacy_auth_type' => 'bearer_token', 'credential_mode' => 'oauth_client_credentials', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => true, 'token_keys' => ['access_token', 'client_id', 'client_secret'], 'notes' => ['Harvest v3 uses OAuth 2.0 client credentials. A pre-issued bearer access_token can also be supplied for runtime calls.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'greenhouse'; }
    public function appMeta(): array { return ['label' => 'Greenhouse', 'description' => 'Harvest v3 recruiting data, candidates, applications, jobs, interviews, offers, users, approvals, and webhooks', 'icon' => 'ph:plant', 'logo' => 'ph:plant']; }
    public function integrationMeta(): array { return ['name' => 'Greenhouse', 'description' => 'Manage Greenhouse Harvest v3 recruiting resources including candidates, applications, jobs, interviews, offers, users, approvals, custom fields, and webhooks.', 'icon' => 'ph:plant', 'logo' => 'ph:plant', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://harvestdocs.greenhouse.io/reference']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Greenhouse Harvest v3 bearer token', 'hint' => 'Optional runtime bearer token. If omitted, client credentials are used to obtain one.', 'required' => false], ['key' => 'client_id', 'type' => 'text', 'label' => 'Client ID', 'placeholder' => 'Greenhouse Harvest v3 OAuth client ID', 'required' => false], ['key' => 'client_secret', 'type' => 'secret', 'label' => 'Client Secret', 'placeholder' => 'Greenhouse Harvest v3 OAuth client secret', 'required' => false], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://harvest.greenhouse.io', 'default' => 'https://harvest.greenhouse.io']]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://harvest.greenhouse.io'), '/');
        $accessToken = (string) ($config['access_token'] ?? '');
        $clientId = (string) ($config['client_id'] ?? '');
        $clientSecret = (string) ($config['client_secret'] ?? '');

        try {
            if ($clientId !== '' && $clientSecret !== '') {
                $response = Http::withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json', 'Authorization' => 'Basic ' . base64_encode($clientId . ':' . $clientSecret)])->timeout(10)->post($baseUrl . '/auth/token');
            } elseif ($accessToken !== '') {
                $response = Http::withHeaders(['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $accessToken])->timeout(10)->get($baseUrl . '/v3/users', ['per_page' => 1]);
            } else {
                return ['success' => false, 'error' => 'Provide a Greenhouse access token or Harvest v3 client credentials.'];
            }
            if (!$response->successful()) { return ['success' => false, 'error' => 'Greenhouse API returned HTTP ' . $response->status() . '.']; }
            return ['success' => true, 'message' => 'Connected to Greenhouse Harvest at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'client_id' => 'nullable|string', 'client_secret' => 'nullable|string', 'url' => 'nullable|url']; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function tools(): array { return [
            'greenhouse_post_auth_token' => [
                'class' => GreenhousePostAuthToken::class,
                'name' => 'generate access_token',
                'description' => 'generate access_token

Official Greenhouse Harvest v3 endpoint: POST /auth/token.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_application_stages' => [
                'class' => GreenhouseGetV3ApplicationStages::class,
                'name' => 'List application stages',
                'description' => 'List application stages

Official Greenhouse Harvest v3 endpoint: GET /v3/application_stages.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'application_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_interview_stage_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'current' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `current`.',
                    ],
                ],
            ],
            'greenhouse_post_v3_applications_id_convert_to_candidate' => [
                'class' => GreenhousePostV3ApplicationsIdConvertToCandidate::class,
                'name' => 'Convert a prospect to a candidate',
                'description' => 'Convert a prospect to a candidate

Official Greenhouse Harvest v3 endpoint: POST /v3/applications/{id}/convert_to_candidate.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_applications' => [
                'class' => GreenhousePostV3Applications::class,
                'name' => 'Create Application',
                'description' => 'Create Application

Official Greenhouse Harvest v3 endpoint: POST /v3/applications.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_applications' => [
                'class' => GreenhouseGetV3Applications::class,
                'name' => 'List applications',
                'description' => 'List applications

Official Greenhouse Harvest v3 endpoint: GET /v3/applications.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'candidate_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'prospective_job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_post_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'source_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'referrer_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'stage_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `status`.',
                        'enum' => [
                            'rejected',
                            'paused',
                            'completed',
                            'unvisited',
                            'hired',
                            'converted',
                            'active',
                        ],
                    ],
                    'custom_field_option_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `custom_field_option_id`.',
                    ],
                    'last_activity_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `last_activity_at`.',
                    ],
                    'prospect' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `prospect`.',
                    ],
                ],
            ],
            'greenhouse_delete_v3_applications_id' => [
                'class' => GreenhouseDeleteV3ApplicationsId::class,
                'name' => 'Delete Application',
                'description' => 'Delete Application

Official Greenhouse Harvest v3 endpoint: DELETE /v3/applications/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_applications_id' => [
                'class' => GreenhousePatchV3ApplicationsId::class,
                'name' => 'Update Applications',
                'description' => 'Update Applications

Official Greenhouse Harvest v3 endpoint: PATCH /v3/applications/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_applications_id_hire' => [
                'class' => GreenhousePostV3ApplicationsIdHire::class,
                'name' => 'Mark an application as hire',
                'description' => 'Mark an application as hire

Official Greenhouse Harvest v3 endpoint: POST /v3/applications/{id}/hire.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_applications_id_move' => [
                'class' => GreenhousePostV3ApplicationsIdMove::class,
                'name' => 'Move an application to a different stage within the same job or transfer to another job',
                'description' => 'Move an application to a different stage within the same job or transfer to another job

Official Greenhouse Harvest v3 endpoint: POST /v3/applications/{id}/move.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_applications_id_reject' => [
                'class' => GreenhousePostV3ApplicationsIdReject::class,
                'name' => 'Reject Application',
                'description' => 'Reject Application

Official Greenhouse Harvest v3 endpoint: POST /v3/applications/{id}/reject.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_applications_id_unreject' => [
                'class' => GreenhousePostV3ApplicationsIdUnreject::class,
                'name' => 'Unreject Application',
                'description' => 'Unreject Application

Official Greenhouse Harvest v3 endpoint: POST /v3/applications/{id}/unreject.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_applied_candidate_tags' => [
                'class' => GreenhousePostV3AppliedCandidateTags::class,
                'name' => 'Create Applied Candidate Tag',
                'description' => 'Create Applied Candidate Tag

Official Greenhouse Harvest v3 endpoint: POST /v3/applied_candidate_tags.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_applied_candidate_tags' => [
                'class' => GreenhouseGetV3AppliedCandidateTags::class,
                'name' => 'List applied candidate tags',
                'description' => 'List applied candidate tags

Official Greenhouse Harvest v3 endpoint: GET /v3/applied_candidate_tags.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'candidate_tag_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'candidate_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_delete_v3_applied_candidate_tags_id' => [
                'class' => GreenhouseDeleteV3AppliedCandidateTagsId::class,
                'name' => 'Delete Applied Candidate Tag',
                'description' => 'Delete Applied Candidate Tag

Official Greenhouse Harvest v3 endpoint: DELETE /v3/applied_candidate_tags/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_post_v3_approval_flows' => [
                'class' => GreenhousePostV3ApprovalFlows::class,
                'name' => 'Create Approval Flow',
                'description' => 'Create Approval Flow

Official Greenhouse Harvest v3 endpoint: POST /v3/approval_flows.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_approval_flows' => [
                'class' => GreenhouseGetV3ApprovalFlows::class,
                'name' => 'List approval flows',
                'description' => 'List approval flows

Official Greenhouse Harvest v3 endpoint: GET /v3/approval_flows.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'offer_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'approval_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `approval_type`.',
                        'enum' => [
                            'open_job',
                            'offer_job',
                            'offer_candidate',
                        ],
                    ],
                ],
            ],
            'greenhouse_put_v3_approval_flows_id_replace_approver_groups' => [
                'class' => GreenhousePutV3ApprovalFlowsIdReplaceApproverGroups::class,
                'name' => 'Replace Approver Groups',
                'description' => 'Replace Approver Groups

Official Greenhouse Harvest v3 endpoint: PUT /v3/approval_flows/{id}/replace_approver_groups.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_approval_flows_id_request_approvals' => [
                'class' => GreenhousePostV3ApprovalFlowsIdRequestApprovals::class,
                'name' => 'Request Approvals',
                'description' => 'Request Approvals

Official Greenhouse Harvest v3 endpoint: POST /v3/approval_flows/{id}/request_approvals.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_approval_flows_id' => [
                'class' => GreenhousePatchV3ApprovalFlowsId::class,
                'name' => 'Update Approval Flow',
                'description' => 'Update Approval Flow

Official Greenhouse Harvest v3 endpoint: PATCH /v3/approval_flows/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_approver_groups' => [
                'class' => GreenhouseGetV3ApproverGroups::class,
                'name' => 'List approver groups',
                'description' => 'List approver groups

Official Greenhouse Harvest v3 endpoint: GET /v3/approver_groups.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'approval_flow_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_put_v3_approver_groups_id_replace_approver' => [
                'class' => GreenhousePutV3ApproverGroupsIdReplaceApprover::class,
                'name' => 'Replace Approver',
                'description' => 'Replace Approver

Official Greenhouse Harvest v3 endpoint: PUT /v3/approver_groups/{id}/replace_approver.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_approvers' => [
                'class' => GreenhouseGetV3Approvers::class,
                'name' => 'List approvers',
                'description' => 'List approvers

Official Greenhouse Harvest v3 endpoint: GET /v3/approvers.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'approver_group_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'user_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `status`.',
                        'enum' => [
                            'waiting',
                            'due',
                            'approved',
                            'rejected',
                        ],
                    ],
                ],
            ],
            'greenhouse_post_v3_attachments' => [
                'class' => GreenhousePostV3Attachments::class,
                'name' => 'Create Attachment',
                'description' => 'Create Attachment

Official Greenhouse Harvest v3 endpoint: POST /v3/attachments.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_attachments' => [
                'class' => GreenhouseGetV3Attachments::class,
                'name' => 'List attachments',
                'description' => 'List attachments

Official Greenhouse Harvest v3 endpoint: GET /v3/attachments.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'application_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'candidate_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `type`.',
                        'enum' => [
                            'resume',
                            'cover_letter',
                            'take_home_test',
                            'offer_packet',
                            'offer_letter',
                            'signed_offer_letter',
                            'other',
                            'form_attachment',
                            'midfunnel_agreement',
                            'automated_agreement',
                        ],
                    ],
                ],
            ],
            'greenhouse_delete_v3_attachments_id' => [
                'class' => GreenhouseDeleteV3AttachmentsId::class,
                'name' => 'Delete Attachment',
                'description' => 'Delete Attachment

Official Greenhouse Harvest v3 endpoint: DELETE /v3/attachments/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_bulk_requests' => [
                'class' => GreenhouseGetV3BulkRequests::class,
                'name' => 'Bulk requests',
                'description' => 'Bulk requests

Official Greenhouse Harvest v3 endpoint: GET /v3/bulk_requests.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'bulk_action_uuid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `bulk_action_uuid`.',
                    ],
                    'active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `active`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_bulk_requests_abc_123_def_456' => [
                'class' => GreenhouseGetV3BulkRequestsAbc123Def456::class,
                'name' => 'Bulk requests',
                'description' => 'Bulk requests

Official Greenhouse Harvest v3 endpoint: GET /v3/bulk_requests/abc-123-def-456.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'bulk_action_uuid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `bulk_action_uuid`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_candidate_attribute_types' => [
                'class' => GreenhouseGetV3CandidateAttributeTypes::class,
                'name' => 'List candidate attribute types',
                'description' => 'List candidate attribute types

Official Greenhouse Harvest v3 endpoint: GET /v3/candidate_attribute_types.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `active`.',
                    ],
                    'is_draft' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `is_draft`.',
                    ],
                ],
            ],
            'greenhouse_post_v3_candidate_educations' => [
                'class' => GreenhousePostV3CandidateEducations::class,
                'name' => 'Create Candidate Education',
                'description' => 'Create Candidate Education

Official Greenhouse Harvest v3 endpoint: POST /v3/candidate_educations.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_candidate_educations' => [
                'class' => GreenhouseGetV3CandidateEducations::class,
                'name' => 'List candidate educations',
                'description' => 'List candidate educations

Official Greenhouse Harvest v3 endpoint: GET /v3/candidate_educations.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'candidate_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'start_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `start_at`.',
                    ],
                    'end_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `end_at`.',
                    ],
                    'latest' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `latest`.',
                    ],
                ],
            ],
            'greenhouse_delete_v3_candidate_educations_id' => [
                'class' => GreenhouseDeleteV3CandidateEducationsId::class,
                'name' => 'Delete Candidate Education',
                'description' => 'Delete Candidate Education

Official Greenhouse Harvest v3 endpoint: DELETE /v3/candidate_educations/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_post_v3_candidate_employments' => [
                'class' => GreenhousePostV3CandidateEmployments::class,
                'name' => 'Create Candidate Employment',
                'description' => 'Create Candidate Employment

Official Greenhouse Harvest v3 endpoint: POST /v3/candidate_employments.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_candidate_employments' => [
                'class' => GreenhouseGetV3CandidateEmployments::class,
                'name' => 'List candidate employments',
                'description' => 'List candidate employments

Official Greenhouse Harvest v3 endpoint: GET /v3/candidate_employments.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'candidate_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'latest' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `latest`.',
                    ],
                ],
            ],
            'greenhouse_delete_v3_candidate_employments_id' => [
                'class' => GreenhouseDeleteV3CandidateEmploymentsId::class,
                'name' => 'Delete Candidate Employments',
                'description' => 'Delete Candidate Employments

Official Greenhouse Harvest v3 endpoint: DELETE /v3/candidate_employments/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_post_v3_candidate_tags' => [
                'class' => GreenhousePostV3CandidateTags::class,
                'name' => 'Create Candidate Tag',
                'description' => 'Create Candidate Tag

Official Greenhouse Harvest v3 endpoint: POST /v3/candidate_tags.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_candidate_tags' => [
                'class' => GreenhouseGetV3CandidateTags::class,
                'name' => 'List candidate tags',
                'description' => 'List candidate tags

Official Greenhouse Harvest v3 endpoint: GET /v3/candidate_tags.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_delete_v3_candidate_tags_id' => [
                'class' => GreenhouseDeleteV3CandidateTagsId::class,
                'name' => 'Delete Candidate Tags',
                'description' => 'Delete Candidate Tags

Official Greenhouse Harvest v3 endpoint: DELETE /v3/candidate_tags/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_candidates_id_anonymize' => [
                'class' => GreenhousePatchV3CandidatesIdAnonymize::class,
                'name' => 'Anonymize Candidates',
                'description' => 'Anonymize Candidates

Official Greenhouse Harvest v3 endpoint: PATCH /v3/candidates/{id}/anonymize.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_candidates' => [
                'class' => GreenhousePostV3Candidates::class,
                'name' => 'Create Candidate',
                'description' => 'Create Candidate

Official Greenhouse Harvest v3 endpoint: POST /v3/candidates.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_candidates' => [
                'class' => GreenhouseGetV3Candidates::class,
                'name' => 'List candidates',
                'description' => 'List candidates

Official Greenhouse Harvest v3 endpoint: GET /v3/candidates.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'last_activity_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `last_activity_at`.',
                    ],
                    'custom_field_option_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `custom_field_option_id`.',
                    ],
                    'private' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `private`.',
                    ],
                    'email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `email`.',
                    ],
                    'tag' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `tag`.',
                    ],
                ],
            ],
            'greenhouse_delete_v3_candidates_id' => [
                'class' => GreenhouseDeleteV3CandidatesId::class,
                'name' => 'Delete Candidate',
                'description' => 'Delete Candidate

Official Greenhouse Harvest v3 endpoint: DELETE /v3/candidates/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_candidates_id' => [
                'class' => GreenhousePatchV3CandidatesId::class,
                'name' => 'Update Candidates',
                'description' => 'Update Candidates

Official Greenhouse Harvest v3 endpoint: PATCH /v3/candidates/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_candidates_id_merge' => [
                'class' => GreenhousePostV3CandidatesIdMerge::class,
                'name' => 'Merge Candidates',
                'description' => 'Merge Candidates

Official Greenhouse Harvest v3 endpoint: POST /v3/candidates/{id}/merge.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_close_reasons' => [
                'class' => GreenhouseGetV3CloseReasons::class,
                'name' => 'List close reasons',
                'description' => 'List close reasons

Official Greenhouse Harvest v3 endpoint: GET /v3/close_reasons.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_post_v3_custom_field_departments' => [
                'class' => GreenhousePostV3CustomFieldDepartments::class,
                'name' => 'Create Custom Field Department',
                'description' => 'Create Custom Field Department

Official Greenhouse Harvest v3 endpoint: POST /v3/custom_field_departments.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_custom_field_departments' => [
                'class' => GreenhouseGetV3CustomFieldDepartments::class,
                'name' => 'List custom field departments',
                'description' => 'List custom field departments

Official Greenhouse Harvest v3 endpoint: GET /v3/custom_field_departments.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'custom_field_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'department_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_delete_v3_custom_field_departments_id' => [
                'class' => GreenhouseDeleteV3CustomFieldDepartmentsId::class,
                'name' => 'Delete Custom Field Department',
                'description' => 'Delete Custom Field Department

Official Greenhouse Harvest v3 endpoint: DELETE /v3/custom_field_departments/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_post_v3_custom_field_offices' => [
                'class' => GreenhousePostV3CustomFieldOffices::class,
                'name' => 'Create Custom Field Office',
                'description' => 'Create Custom Field Office

Official Greenhouse Harvest v3 endpoint: POST /v3/custom_field_offices.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_custom_field_offices' => [
                'class' => GreenhouseGetV3CustomFieldOffices::class,
                'name' => 'List custom field offices',
                'description' => 'List custom field offices

Official Greenhouse Harvest v3 endpoint: GET /v3/custom_field_offices.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'custom_field_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'office_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_delete_v3_custom_field_offices_id' => [
                'class' => GreenhouseDeleteV3CustomFieldOfficesId::class,
                'name' => 'Delete Custom Field Office',
                'description' => 'Delete Custom Field Office

Official Greenhouse Harvest v3 endpoint: DELETE /v3/custom_field_offices/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_post_v3_custom_field_options' => [
                'class' => GreenhousePostV3CustomFieldOptions::class,
                'name' => 'Create Custom Field Option',
                'description' => 'Create Custom Field Option

Official Greenhouse Harvest v3 endpoint: POST /v3/custom_field_options.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_custom_field_options' => [
                'class' => GreenhouseGetV3CustomFieldOptions::class,
                'name' => 'List custom field options',
                'description' => 'List custom field options

Official Greenhouse Harvest v3 endpoint: GET /v3/custom_field_options.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'custom_field_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `active`.',
                    ],
                    'custom_field_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `custom_field_key`.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_custom_field_options_id' => [
                'class' => GreenhousePatchV3CustomFieldOptionsId::class,
                'name' => 'Update Custom Field Options',
                'description' => 'Update Custom Field Options

Official Greenhouse Harvest v3 endpoint: PATCH /v3/custom_field_options/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_delete_v3_custom_field_options_id' => [
                'class' => GreenhouseDeleteV3CustomFieldOptionsId::class,
                'name' => 'Delete Custom Field Option',
                'description' => 'Delete Custom Field Option

Official Greenhouse Harvest v3 endpoint: DELETE /v3/custom_field_options/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_post_v3_custom_fields' => [
                'class' => GreenhousePostV3CustomFields::class,
                'name' => 'Create Custom Field',
                'description' => 'Create Custom Field

Official Greenhouse Harvest v3 endpoint: POST /v3/custom_fields.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_custom_fields' => [
                'class' => GreenhouseGetV3CustomFields::class,
                'name' => 'List custom fields',
                'description' => 'List custom fields

Official Greenhouse Harvest v3 endpoint: GET /v3/custom_fields.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'field_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `field_type`.',
                        'enum' => [
                            'job',
                            'opening',
                            'standard',
                            'offer',
                            'compensation_frequency',
                            'candidate',
                            'referral_question',
                            'application',
                            'rejection_question',
                            'form',
                            'agency_question',
                            'user_attribute',
                        ],
                    ],
                    'active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `active`.',
                    ],
                    'name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `name`.',
                    ],
                    'name_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `name_key`.',
                    ],
                ],
            ],
            'greenhouse_delete_v3_custom_fields_id' => [
                'class' => GreenhouseDeleteV3CustomFieldsId::class,
                'name' => 'Delete Custom Field',
                'description' => 'Delete Custom Field

Official Greenhouse Harvest v3 endpoint: DELETE /v3/custom_fields/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_custom_fields_id' => [
                'class' => GreenhousePatchV3CustomFieldsId::class,
                'name' => 'Update Custom Fields',
                'description' => 'Update Custom Fields

Official Greenhouse Harvest v3 endpoint: PATCH /v3/custom_fields/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_default_interviewers' => [
                'class' => GreenhouseGetV3DefaultInterviewers::class,
                'name' => 'List default interviewers',
                'description' => 'List default interviewers

Official Greenhouse Harvest v3 endpoint: GET /v3/default_interviewers.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'user_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'interview_kit_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_get_v3_demographic_answer_options' => [
                'class' => GreenhouseGetV3DemographicAnswerOptions::class,
                'name' => 'List demographic answer options',
                'description' => 'List demographic answer options

Official Greenhouse Harvest v3 endpoint: GET /v3/demographic_answer_options.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'demographic_question_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `active`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_demographic_answers' => [
                'class' => GreenhouseGetV3DemographicAnswers::class,
                'name' => 'List demographic answers',
                'description' => 'List demographic answers

Official Greenhouse Harvest v3 endpoint: GET /v3/demographic_answers.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'application_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'demographic_question_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'demographic_answer_option_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_get_v3_demographic_question_sets' => [
                'class' => GreenhouseGetV3DemographicQuestionSets::class,
                'name' => 'List demographic question sets',
                'description' => 'List demographic question sets

Official Greenhouse Harvest v3 endpoint: GET /v3/demographic_question_sets.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `active`.',
                    ],
                    'enabled' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `enabled`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_demographic_questions' => [
                'class' => GreenhouseGetV3DemographicQuestions::class,
                'name' => 'List demographic questions',
                'description' => 'List demographic questions

Official Greenhouse Harvest v3 endpoint: GET /v3/demographic_questions.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'demographic_question_set_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `active`.',
                    ],
                    'required' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `required`.',
                    ],
                ],
            ],
            'greenhouse_post_v3_departments' => [
                'class' => GreenhousePostV3Departments::class,
                'name' => 'Create Department',
                'description' => 'Create Department

Official Greenhouse Harvest v3 endpoint: POST /v3/departments.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_departments' => [
                'class' => GreenhouseGetV3Departments::class,
                'name' => 'List departments',
                'description' => 'List departments

Official Greenhouse Harvest v3 endpoint: GET /v3/departments.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'parent_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `parent_id`.',
                    ],
                    'external_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `external_id`.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_departments_id' => [
                'class' => GreenhousePatchV3DepartmentsId::class,
                'name' => 'Update Department',
                'description' => 'Update Department

Official Greenhouse Harvest v3 endpoint: PATCH /v3/departments/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_eeoc' => [
                'class' => GreenhouseGetV3Eeoc::class,
                'name' => 'List EEOC',
                'description' => 'List EEOC

Official Greenhouse Harvest v3 endpoint: GET /v3/eeoc.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'application_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'submitted_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `submitted_at`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_email_templates' => [
                'class' => GreenhouseGetV3EmailTemplates::class,
                'name' => 'List email templates',
                'description' => 'List email templates

Official Greenhouse Harvest v3 endpoint: GET /v3/email_templates.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'email_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `email_type`.',
                        'enum' => [
                            'candidate_auto_reply',
                            'new_candidate',
                            'new_internal_candidate',
                            'new_referral',
                            'new_agency_submission',
                            'approved_to_start_recruiting',
                            'offer_fully_approved',
                            'job_closed',
                            'candidate_rejection',
                            'weekly_status',
                            'scorecard_reminder',
                            'scorecard_repeat_reminder',
                            'interviewer_invite',
                            'take_home_test_email',
                            'daily_recruiting',
                            'stage_transition',
                            'scorecard_progress',
                            'agency_candidate_status',
                            'agency_candidate_stage',
                            'candidate_email',
                            'team_email',
                            'none',
                            'extending_offer',
                            'non_admin_welcome',
                            'job_admin_welcome',
                            'site_admin_welcome',
                            'prospect_referral_receipt',
                            'candidate_referral_receipt',
                            'candidate_availability_request',
                            'candidate_availability_confirmation',
                            'approval_request',
                            'eeoc_data_request',
                            'event_prospect_auto_reply',
                            'job_post_request',
                            'gdpr_notification',
                            'stage_change_for_followers',
                            'rejection_for_followers',
                            'calendly_request',
                            'gdpr_consent_extension',
                            'agency_recruiter_assigned',
                            'slack_mentions',
                            'candidate_self_schedule_request',
                            'sourcing_automation_step',
                            'candidate_survey',
                            'esignature_request',
                            'scheduling_link_confirmation',
                        ],
                    ],
                    'from_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `from_type`.',
                        'enum' => [
                            'user_email',
                            'organization_email',
                            'my_email_address',
                            'inviter',
                            'organizer',
                            'not_applicable',
                        ],
                    ],
                ],
            ],
            'greenhouse_get_v3_focus_candidate_attributes' => [
                'class' => GreenhouseGetV3FocusCandidateAttributes::class,
                'name' => 'List focus candidate attributes',
                'description' => 'List focus candidate attributes

Official Greenhouse Harvest v3 endpoint: GET /v3/focus_candidate_attributes.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'interview_kit_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_candidate_attribute_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_post_v3_future_job_permissions' => [
                'class' => GreenhousePostV3FutureJobPermissions::class,
                'name' => 'Create Future Job Permission',
                'description' => 'Create Future Job Permission

Official Greenhouse Harvest v3 endpoint: POST /v3/future_job_permissions.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_future_job_permissions' => [
                'class' => GreenhouseGetV3FutureJobPermissions::class,
                'name' => 'List future job permissions',
                'description' => 'List future job permissions

Official Greenhouse Harvest v3 endpoint: GET /v3/future_job_permissions.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'department_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'office_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'user_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'role_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'external_department_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `external_department_id`.',
                    ],
                    'external_office_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `external_office_id`.',
                    ],
                ],
            ],
            'greenhouse_delete_v3_future_job_permissions_id' => [
                'class' => GreenhouseDeleteV3FutureJobPermissionsId::class,
                'name' => 'Delete Future Job Permission',
                'description' => 'Delete Future Job Permission

Official Greenhouse Harvest v3 endpoint: DELETE /v3/future_job_permissions/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_interview_kits' => [
                'class' => GreenhouseGetV3InterviewKits::class,
                'name' => 'List interview kits',
                'description' => 'List interview kits

Official Greenhouse Harvest v3 endpoint: GET /v3/interview_kits.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_interview_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_get_v3_interviewer_tags' => [
                'class' => GreenhouseGetV3InterviewerTags::class,
                'name' => 'List interviewer tags',
                'description' => 'List interviewer tags

Official Greenhouse Harvest v3 endpoint: GET /v3/interviewer_tags.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_get_v3_interviewers' => [
                'class' => GreenhouseGetV3Interviewers::class,
                'name' => 'List interviewers',
                'description' => 'List interviewers

Official Greenhouse Harvest v3 endpoint: GET /v3/interviewers.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'interview_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'user_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'scorecard_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'response_status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `response_status`.',
                        'enum' => [
                            'needs_action',
                            'declined',
                            'tentative',
                            'accepted',
                        ],
                    ],
                ],
            ],
            'greenhouse_post_v3_interviews' => [
                'class' => GreenhousePostV3Interviews::class,
                'name' => 'Create Interview',
                'description' => 'Create Interview

Official Greenhouse Harvest v3 endpoint: POST /v3/interviews.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_interviews' => [
                'class' => GreenhouseGetV3Interviews::class,
                'name' => 'List interviews',
                'description' => 'List interviews

Official Greenhouse Harvest v3 endpoint: GET /v3/interviews.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'application_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_interview_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'organizer_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'starts_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `starts_at`.',
                    ],
                    'ends_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `ends_at`.',
                    ],
                    'all_day_start_on' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `all_day_start_on`.',
                    ],
                    'all_day_end_on' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `all_day_end_on`.',
                    ],
                    'external_event_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `external_event_id`.',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `status`.',
                        'enum' => [
                            'to_be_scheduled',
                            'scheduled',
                            'awaiting_feedback',
                            'complete',
                            'skipped',
                            'collect_feedback',
                            'to_be_sent',
                            'sent',
                            'received',
                        ],
                    ],
                ],
            ],
            'greenhouse_delete_v3_interviews_id' => [
                'class' => GreenhouseDeleteV3InterviewsId::class,
                'name' => 'Delete Interview',
                'description' => 'Delete Interview

Official Greenhouse Harvest v3 endpoint: DELETE /v3/interviews/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_interviews_id' => [
                'class' => GreenhousePatchV3InterviewsId::class,
                'name' => 'Update Interviews',
                'description' => 'Update Interviews

Official Greenhouse Harvest v3 endpoint: PATCH /v3/interviews/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_job_board_custom_locations' => [
                'class' => GreenhouseGetV3JobBoardCustomLocations::class,
                'name' => 'List job board custom locations',
                'description' => 'List job board custom locations

Official Greenhouse Harvest v3 endpoint: GET /v3/job_board_custom_locations.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'greenhouse_job_board_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `active`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_job_candidate_attributes' => [
                'class' => GreenhouseGetV3JobCandidateAttributes::class,
                'name' => 'List job candidate attributes',
                'description' => 'List job candidate attributes

Official Greenhouse Harvest v3 endpoint: GET /v3/job_candidate_attributes.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'candidate_attribute_type_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_post_v3_job_hiring_managers' => [
                'class' => GreenhousePostV3JobHiringManagers::class,
                'name' => 'Create Job Hiring Manager',
                'description' => 'Create Job Hiring Manager

Official Greenhouse Harvest v3 endpoint: POST /v3/job_hiring_managers.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_job_hiring_managers' => [
                'class' => GreenhouseGetV3JobHiringManagers::class,
                'name' => 'List job hiring managers',
                'description' => 'List job hiring managers

Official Greenhouse Harvest v3 endpoint: GET /v3/job_hiring_managers.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'user_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_delete_v3_job_hiring_managers_id' => [
                'class' => GreenhouseDeleteV3JobHiringManagersId::class,
                'name' => 'Delete Job Hiring Manager',
                'description' => 'Delete Job Hiring Manager

Official Greenhouse Harvest v3 endpoint: DELETE /v3/job_hiring_managers/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_job_interview_stages' => [
                'class' => GreenhouseGetV3JobInterviewStages::class,
                'name' => 'List job interview stages',
                'description' => 'List job interview stages

Official Greenhouse Harvest v3 endpoint: GET /v3/job_interview_stages.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `active`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_job_interviews' => [
                'class' => GreenhouseGetV3JobInterviews::class,
                'name' => 'List job interviews',
                'description' => 'List job interviews

Official Greenhouse Harvest v3 endpoint: GET /v3/job_interviews.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'job_interview_stage_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `active`.',
                    ],
                    'scheduling_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `scheduling_type`.',
                        'enum' => [
                            'none',
                            'needs_scheduling',
                            'take_home_test',
                            'offer',
                        ],
                    ],
                ],
            ],
            'greenhouse_post_v3_job_notes' => [
                'class' => GreenhousePostV3JobNotes::class,
                'name' => 'Create Job Note',
                'description' => 'Create Job Note

Official Greenhouse Harvest v3 endpoint: POST /v3/job_notes.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_job_notes' => [
                'class' => GreenhouseGetV3JobNotes::class,
                'name' => 'List job notes',
                'description' => 'List job notes

Official Greenhouse Harvest v3 endpoint: GET /v3/job_notes.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'user_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'visibility' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `visibility`.',
                        'enum' => [
                            'admin_only_visible',
                            'privately_visible',
                        ],
                    ],
                ],
            ],
            'greenhouse_delete_v3_job_notes_id' => [
                'class' => GreenhouseDeleteV3JobNotesId::class,
                'name' => 'Delete Job Note',
                'description' => 'Delete Job Note

Official Greenhouse Harvest v3 endpoint: DELETE /v3/job_notes/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_job_notes_id' => [
                'class' => GreenhousePatchV3JobNotesId::class,
                'name' => 'Update Job Notes',
                'description' => 'Update Job Notes

Official Greenhouse Harvest v3 endpoint: PATCH /v3/job_notes/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_job_owners' => [
                'class' => GreenhousePostV3JobOwners::class,
                'name' => 'Create Job Owner',
                'description' => 'Create Job Owner

Official Greenhouse Harvest v3 endpoint: POST /v3/job_owners.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_job_owners' => [
                'class' => GreenhouseGetV3JobOwners::class,
                'name' => 'List job owners',
                'description' => 'List job owners

Official Greenhouse Harvest v3 endpoint: GET /v3/job_owners.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'user_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `type`.',
                        'enum' => [
                            'sourcer',
                            'recruiter',
                            'coordinator',
                        ],
                    ],
                ],
            ],
            'greenhouse_delete_v3_job_owners_id' => [
                'class' => GreenhouseDeleteV3JobOwnersId::class,
                'name' => 'Delete Job Owner',
                'description' => 'Delete Job Owner

Official Greenhouse Harvest v3 endpoint: DELETE /v3/job_owners/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_post_v3_job_post_locations' => [
                'class' => GreenhousePostV3JobPostLocations::class,
                'name' => 'Create Job Post Location',
                'description' => 'Create Job Post Location

Official Greenhouse Harvest v3 endpoint: POST /v3/job_post_locations.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_job_post_locations' => [
                'class' => GreenhouseGetV3JobPostLocations::class,
                'name' => 'List job post locations',
                'description' => 'List job post locations

Official Greenhouse Harvest v3 endpoint: GET /v3/job_post_locations.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'office_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_post_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'custom_location_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `type`.',
                        'enum' => [
                            'free_text',
                            'office',
                            'custom_list',
                        ],
                    ],
                    'plain_text_location' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `plain_text_location`.',
                    ],
                ],
            ],
            'greenhouse_delete_v3_job_post_locations_id' => [
                'class' => GreenhouseDeleteV3JobPostLocationsId::class,
                'name' => 'Delete Job Post Location',
                'description' => 'Delete Job Post Location

Official Greenhouse Harvest v3 endpoint: DELETE /v3/job_post_locations/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_job_posts' => [
                'class' => GreenhouseGetV3JobPosts::class,
                'name' => 'List job posts',
                'description' => 'List job posts

Official Greenhouse Harvest v3 endpoint: GET /v3/job_posts.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_board_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `active`.',
                    ],
                    'featured' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `featured`.',
                    ],
                    'live' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `live`.',
                    ],
                    'internal' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `internal`.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_job_posts_id' => [
                'class' => GreenhousePatchV3JobPostsId::class,
                'name' => 'Update Job Posts',
                'description' => 'Update Job Posts

Official Greenhouse Harvest v3 endpoint: PATCH /v3/job_posts/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_jobs' => [
                'class' => GreenhousePostV3Jobs::class,
                'name' => 'Create job',
                'description' => 'Create job

Official Greenhouse Harvest v3 endpoint: POST /v3/jobs.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_jobs' => [
                'class' => GreenhouseGetV3Jobs::class,
                'name' => 'List jobs',
                'description' => 'List jobs

Official Greenhouse Harvest v3 endpoint: GET /v3/jobs.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'opened_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `opened_at`.',
                    ],
                    'closed_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `closed_at`.',
                    ],
                    'requisition_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `requisition_id`.',
                    ],
                    'department_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `department_id`.',
                    ],
                    'office_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `office_id`.',
                    ],
                    'custom_field_option_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `custom_field_option_id`.',
                    ],
                    'confidential' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `confidential`.',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `status`.',
                        'enum' => [
                            'open',
                            'draft',
                            'closed',
                        ],
                    ],
                ],
            ],
            'greenhouse_patch_v3_jobs_id' => [
                'class' => GreenhousePatchV3JobsId::class,
                'name' => 'Update Job',
                'description' => 'Update Job

Official Greenhouse Harvest v3 endpoint: PATCH /v3/jobs/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_notes' => [
                'class' => GreenhousePostV3Notes::class,
                'name' => 'Create Note',
                'description' => 'Create Note

Official Greenhouse Harvest v3 endpoint: POST /v3/notes.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_offers' => [
                'class' => GreenhousePostV3Offers::class,
                'name' => 'Create Offer',
                'description' => 'Create Offer

Official Greenhouse Harvest v3 endpoint: POST /v3/offers.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_offers' => [
                'class' => GreenhouseGetV3Offers::class,
                'name' => 'List offers',
                'description' => 'List offers

Official Greenhouse Harvest v3 endpoint: GET /v3/offers.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'application_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'candidate_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'opening_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'current_only' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `current_only`.',
                    ],
                    'custom_field_option_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `custom_field_option_id`.',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `status`.',
                        'enum' => [
                            'Created',
                            'Accepted',
                            'Rejected',
                            'Deprecated',
                        ],
                    ],
                    'resolved_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `resolved_at`.',
                    ],
                    'sent_on' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `sent_on`.',
                    ],
                    'starts_on' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `starts_on`.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_offers_id' => [
                'class' => GreenhousePatchV3OffersId::class,
                'name' => 'Update Offers',
                'description' => 'Update Offers

Official Greenhouse Harvest v3 endpoint: PATCH /v3/offers/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_offices' => [
                'class' => GreenhousePostV3Offices::class,
                'name' => 'Create Office',
                'description' => 'Create Office

Official Greenhouse Harvest v3 endpoint: POST /v3/offices.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_offices' => [
                'class' => GreenhouseGetV3Offices::class,
                'name' => 'List offices',
                'description' => 'List offices

Official Greenhouse Harvest v3 endpoint: GET /v3/offices.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'parent_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `parent_id`.',
                    ],
                    'external_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `external_id`.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_offices_id' => [
                'class' => GreenhousePatchV3OfficesId::class,
                'name' => 'Update Office',
                'description' => 'Update Office

Official Greenhouse Harvest v3 endpoint: PATCH /v3/offices/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_openings' => [
                'class' => GreenhousePostV3Openings::class,
                'name' => 'Create Opening',
                'description' => 'Create Opening

Official Greenhouse Harvest v3 endpoint: POST /v3/openings.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_openings' => [
                'class' => GreenhouseGetV3Openings::class,
                'name' => 'List openings',
                'description' => 'List openings

Official Greenhouse Harvest v3 endpoint: GET /v3/openings.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'application_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'close_reason_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'opened_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `opened_at`.',
                    ],
                    'closed_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `closed_at`.',
                    ],
                    'custom_field_option_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `custom_field_option_id`.',
                    ],
                    'open' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `open`.',
                    ],
                    'opening_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `opening_id`.',
                    ],
                ],
            ],
            'greenhouse_delete_v3_openings_id' => [
                'class' => GreenhouseDeleteV3OpeningsId::class,
                'name' => 'Delete Openings',
                'description' => 'Delete Openings

Official Greenhouse Harvest v3 endpoint: DELETE /v3/openings/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_openings_id' => [
                'class' => GreenhousePatchV3OpeningsId::class,
                'name' => 'Update Openings',
                'description' => 'Update Openings

Official Greenhouse Harvest v3 endpoint: PATCH /v3/openings/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_prospect_details' => [
                'class' => GreenhouseGetV3ProspectDetails::class,
                'name' => 'List prospect details',
                'description' => 'List prospect details

Official Greenhouse Harvest v3 endpoint: GET /v3/prospect_details.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'application_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'pool_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'pool_stage_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'prospect_owner_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'department_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'office_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_get_v3_prospect_pool_stages' => [
                'class' => GreenhouseGetV3ProspectPoolStages::class,
                'name' => 'List prospect pool stages',
                'description' => 'List prospect pool stages

Official Greenhouse Harvest v3 endpoint: GET /v3/prospect_pool_stages.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'prospect_pool_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_get_v3_prospect_pools' => [
                'class' => GreenhouseGetV3ProspectPools::class,
                'name' => 'List prospect pools',
                'description' => 'List prospect pools

Official Greenhouse Harvest v3 endpoint: GET /v3/prospect_pools.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'department_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'office_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `active`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_referrers' => [
                'class' => GreenhouseGetV3Referrers::class,
                'name' => 'List referrers',
                'description' => 'List referrers

Official Greenhouse Harvest v3 endpoint: GET /v3/referrers.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'user_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_get_v3_rejection_details' => [
                'class' => GreenhouseGetV3RejectionDetails::class,
                'name' => 'List rejection details',
                'description' => 'List rejection details

Official Greenhouse Harvest v3 endpoint: GET /v3/rejection_details.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'application_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'rejection_reason_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'custom_field_option_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `custom_field_option_id`.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_rejection_details_id' => [
                'class' => GreenhousePatchV3RejectionDetailsId::class,
                'name' => 'Update Rejection Details',
                'description' => 'Update Rejection Details

Official Greenhouse Harvest v3 endpoint: PATCH /v3/rejection_details/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_rejection_reasons' => [
                'class' => GreenhouseGetV3RejectionReasons::class,
                'name' => 'List rejection reasons',
                'description' => 'List rejection reasons

Official Greenhouse Harvest v3 endpoint: GET /v3/rejection_reasons.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'include_defaults' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `include_defaults`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_scorecard_candidate_attributes' => [
                'class' => GreenhouseGetV3ScorecardCandidateAttributes::class,
                'name' => 'List scorecard candidate attributes',
                'description' => 'List scorecard candidate attributes

Official Greenhouse Harvest v3 endpoint: GET /v3/scorecard_candidate_attributes.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'scorecard_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_candidate_attribute_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_post_v3_scorecard_candidate_attributes' => [
                'class' => GreenhousePostV3ScorecardCandidateAttributes::class,
                'name' => 'Create scorecard candidate attributes - **restricted**',
                'description' => 'Create scorecard candidate attributes - **restricted**

Official Greenhouse Harvest v3 endpoint: POST /v3/scorecard_candidate_attributes.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_scorecard_candidate_attributes_id' => [
                'class' => GreenhousePatchV3ScorecardCandidateAttributesId::class,
                'name' => 'Updates scorecard candidate attributes - **restricted**',
                'description' => 'Updates scorecard candidate attributes - **restricted**

Official Greenhouse Harvest v3 endpoint: PATCH /v3/scorecard_candidate_attributes/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_scorecard_question_answer_options' => [
                'class' => GreenhouseGetV3ScorecardQuestionAnswerOptions::class,
                'name' => 'List scorecard question answer options',
                'description' => 'List scorecard question answer options

Official Greenhouse Harvest v3 endpoint: GET /v3/scorecard_question_answer_options.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'scorecard_question_option_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'scorecard_question_answer_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_post_v3_scorecard_question_answer_options' => [
                'class' => GreenhousePostV3ScorecardQuestionAnswerOptions::class,
                'name' => 'Create scorecard question answer options',
                'description' => 'Create scorecard question answer options

Official Greenhouse Harvest v3 endpoint: POST /v3/scorecard_question_answer_options.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_scorecard_question_answers' => [
                'class' => GreenhouseGetV3ScorecardQuestionAnswers::class,
                'name' => 'List scorecard question answers',
                'description' => 'List scorecard question answers

Official Greenhouse Harvest v3 endpoint: GET /v3/scorecard_question_answers.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'scorecard_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'scorecard_question_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_post_v3_scorecard_question_answers' => [
                'class' => GreenhousePostV3ScorecardQuestionAnswers::class,
                'name' => 'Create scorecard question answers - **restricted**',
                'description' => 'Create scorecard question answers - **restricted**

Official Greenhouse Harvest v3 endpoint: POST /v3/scorecard_question_answers.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_scorecard_question_answers_id' => [
                'class' => GreenhousePatchV3ScorecardQuestionAnswersId::class,
                'name' => 'Update scorecard question answers - **restricted**',
                'description' => 'Update scorecard question answers - **restricted**

Official Greenhouse Harvest v3 endpoint: PATCH /v3/scorecard_question_answers/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_scorecard_question_candidate_attributes' => [
                'class' => GreenhouseGetV3ScorecardQuestionCandidateAttributes::class,
                'name' => 'List scorecard question candidate attributes',
                'description' => 'List scorecard question candidate attributes

Official Greenhouse Harvest v3 endpoint: GET /v3/scorecard_question_candidate_attributes.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'scorecard_question_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'focus_candidate_attribute_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_get_v3_scorecard_question_options' => [
                'class' => GreenhouseGetV3ScorecardQuestionOptions::class,
                'name' => 'List scorecard question options',
                'description' => 'List scorecard question options

Official Greenhouse Harvest v3 endpoint: GET /v3/scorecard_question_options.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'scorecard_question_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `active`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_scorecard_questions' => [
                'class' => GreenhouseGetV3ScorecardQuestions::class,
                'name' => 'List scorecard questions',
                'description' => 'List scorecard questions

Official Greenhouse Harvest v3 endpoint: GET /v3/scorecard_questions.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'interview_kit_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_post_v3_scorecards' => [
                'class' => GreenhousePostV3Scorecards::class,
                'name' => 'Create Scorecard - **restricted**',
                'description' => 'Create Scorecard - **restricted**

Official Greenhouse Harvest v3 endpoint: POST /v3/scorecards.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_scorecards' => [
                'class' => GreenhouseGetV3Scorecards::class,
                'name' => 'List scorecards',
                'description' => 'List scorecards

Official Greenhouse Harvest v3 endpoint: GET /v3/scorecards.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'interview_kit_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'interviewer_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'submitter_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'application_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'interviewed_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `interviewed_at`.',
                    ],
                    'submitted_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `submitted_at`.',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `status`.',
                        'enum' => [
                            'draft',
                            'complete',
                        ],
                    ],
                ],
            ],
            'greenhouse_patch_v3_scorecards_id' => [
                'class' => GreenhousePatchV3ScorecardsId::class,
                'name' => 'Update Scorecard',
                'description' => 'Update Scorecard

Official Greenhouse Harvest v3 endpoint: PATCH /v3/scorecards/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_sources' => [
                'class' => GreenhouseGetV3Sources::class,
                'name' => 'List sources',
                'description' => 'List sources

Official Greenhouse Harvest v3 endpoint: GET /v3/sources.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_get_v3_tracking_links' => [
                'class' => GreenhouseGetV3TrackingLinks::class,
                'name' => 'List tracking links',
                'description' => 'List tracking links

Official Greenhouse Harvest v3 endpoint: GET /v3/tracking_links.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'source_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'referrer_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_board_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'job_post_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'related_post_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `token`.',
                    ],
                    'related_post_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `related_post_type`.',
                    ],
                ],
            ],
            'greenhouse_post_v3_user_emails' => [
                'class' => GreenhousePostV3UserEmails::class,
                'name' => 'Create User Email',
                'description' => 'Create User Email

Official Greenhouse Harvest v3 endpoint: POST /v3/user_emails.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_user_emails' => [
                'class' => GreenhouseGetV3UserEmails::class,
                'name' => 'List user emails',
                'description' => 'List user emails

Official Greenhouse Harvest v3 endpoint: GET /v3/user_emails.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'user_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'email' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'verified' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `verified`.',
                    ],
                    'verification_token_sent_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `verification_token_sent_at`.',
                    ],
                ],
            ],
            'greenhouse_post_v3_user_job_permissions' => [
                'class' => GreenhousePostV3UserJobPermissions::class,
                'name' => 'Create User Job Permission',
                'description' => 'Create User Job Permission

Official Greenhouse Harvest v3 endpoint: POST /v3/user_job_permissions.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_user_job_permissions' => [
                'class' => GreenhouseGetV3UserJobPermissions::class,
                'name' => 'List user job permissions',
                'description' => 'List user job permissions

Official Greenhouse Harvest v3 endpoint: GET /v3/user_job_permissions.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'job_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'user_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'role_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_delete_v3_user_job_permissions_id' => [
                'class' => GreenhouseDeleteV3UserJobPermissionsId::class,
                'name' => 'Delete User Job Permission',
                'description' => 'Delete User Job Permission

Official Greenhouse Harvest v3 endpoint: DELETE /v3/user_job_permissions/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_get_v3_user_roles' => [
                'class' => GreenhouseGetV3UserRoles::class,
                'name' => 'List user roles',
                'description' => 'List user roles

Official Greenhouse Harvest v3 endpoint: GET /v3/user_roles.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                ],
            ],
            'greenhouse_post_v3_users_id_activate' => [
                'class' => GreenhousePostV3UsersIdActivate::class,
                'name' => 'Activate a user',
                'description' => 'Activate a user

Official Greenhouse Harvest v3 endpoint: POST /v3/users/{id}/activate.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_users_id_deactivate' => [
                'class' => GreenhousePostV3UsersIdDeactivate::class,
                'name' => 'Deactivate a user',
                'description' => 'Deactivate a user

Official Greenhouse Harvest v3 endpoint: POST /v3/users/{id}/deactivate.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_users' => [
                'class' => GreenhouseGetV3Users::class,
                'name' => 'List users',
                'description' => 'List users

Official Greenhouse Harvest v3 endpoint: GET /v3/users.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'agency_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'office_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'department_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'linked_candidate_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'interviewer_tag_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'employee_ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'custom_field_option_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'query parameter `custom_field_option_id`.',
                    ],
                    'deactivated' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `deactivated`.',
                    ],
                    'primary_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `primary_email`.',
                    ],
                    'external_office_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `external_office_id`.',
                    ],
                    'external_department_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `external_department_id`.',
                    ],
                ],
            ],
            'greenhouse_post_v3_users' => [
                'class' => GreenhousePostV3Users::class,
                'name' => 'Create user',
                'description' => 'Create user

Official Greenhouse Harvest v3 endpoint: POST /v3/users.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_users_id_revoke_permissions' => [
                'class' => GreenhousePostV3UsersIdRevokePermissions::class,
                'name' => 'Revoke user permissions',
                'description' => 'Revoke user permissions

Official Greenhouse Harvest v3 endpoint: POST /v3/users/{id}/revoke_permissions.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_users_id' => [
                'class' => GreenhousePatchV3UsersId::class,
                'name' => 'Update Users',
                'description' => 'Update Users

Official Greenhouse Harvest v3 endpoint: PATCH /v3/users/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_post_v3_webhooks' => [
                'class' => GreenhousePostV3Webhooks::class,
                'name' => 'Create Webhook - **Greenhouse Partners Exclusive**',
                'description' => 'Create Webhook - **Greenhouse Partners Exclusive**

Official Greenhouse Harvest v3 endpoint: POST /v3/webhooks.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
            'greenhouse_get_v3_webhooks' => [
                'class' => GreenhouseGetV3Webhooks::class,
                'name' => 'List Webhooks **Greenhouse Partners Exclusive**',
                'description' => 'List Webhooks **Greenhouse Partners Exclusive**

Official Greenhouse Harvest v3 endpoint: GET /v3/webhooks.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor link for pagination from previous page response header. Do not use any other parameters when using this.',
                    ],
                    'per_page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Number of results per page',
                    ],
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list',
                    ],
                    'created_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `created_at`.',
                    ],
                    'updated_at' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `updated_at`.',
                    ],
                    'fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Comma separated list of fields to return',
                    ],
                    'last_delivered' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'query parameter `last_delivered`.',
                    ],
                    'event_action_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'query parameter `event_action_type`.',
                        'enum' => [
                            'application_updated',
                            'candidate_anonymized',
                            'candidate_stage_change',
                            'delete_application',
                            'delete_candidate',
                            'department_deleted',
                            'hire_candidate',
                            'interview_deleted',
                            'job_approved',
                            'job_created',
                            'job_deleted',
                            'job_interview_stage_deleted',
                            'job_post_created',
                            'job_post_deleted',
                            'job_post_updated',
                            'job_updated',
                            'merge_candidate',
                            'new_candidate_application',
                            'new_prospect_application',
                            'offer_approved',
                            'offer_created',
                            'offer_deleted',
                            'offer_updated',
                            'office_deleted',
                            'reject_candidate',
                            'scorecard_deleted',
                            'unhire_candidate',
                            'unreject_candidate',
                            'update_candidate',
                        ],
                    ],
                    'deactivated' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'query parameter `deactivated`.',
                    ],
                ],
            ],
            'greenhouse_delete_v3_webhooks_id' => [
                'class' => GreenhouseDeleteV3WebhooksId::class,
                'name' => 'Delete Webhook - **Greenhouse Partners Exclusive**',
                'description' => 'Delete Webhook - **Greenhouse Partners Exclusive**

Official Greenhouse Harvest v3 endpoint: DELETE /v3/webhooks/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                ],
            ],
            'greenhouse_patch_v3_webhooks_id' => [
                'class' => GreenhousePatchV3WebhooksId::class,
                'name' => 'Update Webhook - **Greenhouse Partners Exclusive**',
                'description' => 'Update Webhook - **Greenhouse Partners Exclusive**

Official Greenhouse Harvest v3 endpoint: PATCH /v3/webhooks/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'path parameter `id`.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'JSON request body matching the official Greenhouse Harvest v3 schema for this operation.',
                    ],
                ],
            ],
        ]; }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): GreenhouseService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GreenhouseService(accessToken: $creds->get('greenhouse', 'access_token', '', $account), clientId: $creds->get('greenhouse', 'client_id', '', $account), clientSecret: $creds->get('greenhouse', 'client_secret', '', $account), baseUrl: $creds->get('greenhouse', 'url', 'https://harvest.greenhouse.io', $account));
        }

        return app(GreenhouseService::class);
    }

    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/greenhouse.md'; }
    public function isIntegration(): bool { return true; }
}
