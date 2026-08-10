<?php

namespace OpenCompany\Integrations\GitGuardian;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianSelfRetrieveApiToken;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianSelfDeleteApiToken;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListApiTokens;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRetrieveApiToken;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianDeleteApiToken;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianPublicJwtCreate;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRetrieveIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateSecretIncident;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRetrieveIncidentsLeaks;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianAssignIncident;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUnassignIncident;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianResolveIncident;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianIgnoreIncident;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianReopenIncident;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianShareIncident;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUnshareIncident;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianGrantAccessIncident;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRevokeAccessIncident;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListIncidentNotes;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreateIncidentNote;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateIncidentNote;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianDeleteIncidentNote;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListIncidentMembers;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListIncidentTeams;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListIncidentInvitations;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRetrieveIncidentImpactedPerimeter;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianGetSecretIncidentVaults;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListSecretIncidentMemberAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListSecretIncidentTeamAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListSecretIncidentInvitationAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListOccs;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListSeverityRules;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreateCodeFixRequest;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListPublicIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRetrievePublicIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListPublicSecretOccurrences;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRetrievePublicSecretOccurrence;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianResolvePublicIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianIgnorePublicIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianReopenPublicIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianAssignPublicIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUnassignPublicIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianSharePublicIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUnsharePublicIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianSetSeverityPublicIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianSetCustomTagsPublicIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListPublicIncidentNotes;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreatePublicIncidentNote;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdatePublicIncidentNote;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianDeletePublicIncidentNote;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianGetPublicSecretIncidentVaults;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListInvitations;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreateInvitations;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRetrieveInvitation;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianDeleteInvitation;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianResendInvitation;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianGetInvitationResourceAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianSetInvitationResourceAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRevokeInvitationResourceAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListInvitationSecretIncidentAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListMembers;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRetrieveMember;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianDeleteMember;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateMember;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListMemberTeams;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianGetMemberResourceAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianSetMemberResourceAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRevokeMemberResourceAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListMemberSecretIncidentAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRetrieveMemberEmailSettings;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateMemberEmailSettings;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianContentScan;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianMultipleScan;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScanCreateIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListSecretDetectors;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianGetSecretDetector;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianGetSecretDetail;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianQuotas;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListSources;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRetrieveSource;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateSource;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListSourcesIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianTriggerSourceScans;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListCustomSources;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreateCustomSource;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianGetCustomSource;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateCustomSource;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianDeleteCustomSource;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListDevelopers;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListAuditLogs;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListAuditLogEventNames;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianApiHealth;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListHealthChecks;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListHealthCheckInstanceHistory;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianTriggerHealthCheck;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListTeams;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreateTeams;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRetrieveTeam;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianDeleteTeam;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateTeam;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListTeamIncidents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianGetTeamResourceAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianSetTeamResourceAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRevokeTeamResourceAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListTeamSecretIncidentAccess;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListTeamInvitation;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreateTeamInvitations;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateTeamInvitation;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianDeleteTeamInvitation;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListTeamMemberships;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreateTeamMembership;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateTeamMembership;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianDeleteTeamMembership;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListMemberTeamMemberships;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListTeamRequests;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreateTeamRequest;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianDeleteTeamRequest;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianAcceptTeamRequest;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListMemberTeamRequests;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListTeamSources;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateTeamSources;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListHoneytoken;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreateHoneytoken;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreateHoneytokenWithContext;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRetrieveHoneytoken;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateHoneytoken;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianResetHoneytoken;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRevokeHoneytoken;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListHoneytokenNotes;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreateHoneytokenNote;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateHoneytokenNote;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianDeleteHoneytokenNote;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListHoneytokenSources;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCheckHoneytokenPrefixes;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListHoneytokensEvents;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListIpAllowlist;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreateIpAllowlist;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianRetrieveIpallowlist;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateIpallowlist;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianDeleteIpallowlist;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListIpAddresses;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimUserCreate;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimUserList;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimUserDetail;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimUserUpdate;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimUserPartialUpdate;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimUserDelete;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimGroupList;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimGroupCreate;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimGroupDetail;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimGroupUpdate;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimGroupPartialUpdate;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimGroupDelete;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimServiceProviderConfig;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimResourceTypesList;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimResourceTypesDetail;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimSchemaList;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianScimSchemaDetail;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianListCustomTags;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianCreateCustomTag;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateCustomTagsKey;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianDeleteCustomTagsKey;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianGetCustomTag;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianUpdateCustomTag;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianPartialUpdateCustomTag;
use OpenCompany\Integrations\GitGuardian\Tools\GitGuardianDeleteCustomTag;

/**
 * Tool catalog and configuration metadata for GitGuardian.
 *
 * Exposes the official GitGuardian OpenAPI operation set as endpoint-specific
 * tools and resolves account-specific API keys for multi-account hosts.
 */
class GitGuardianToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'api_key', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => [], 'notes' => ['GitGuardian uses Authorization: Token <api_key>.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'gitguardian'; }
    public function appMeta(): array { return ['label' => 'GitGuardian', 'description' => 'Secret detection, incidents, sources, teams, SCIM, honeytokens, audit logs, custom tags, and IP allowlists', 'icon' => 'ph:shield-check', 'logo' => 'ph:shield-check']; }
    public function integrationMeta(): array { return ['name' => 'GitGuardian', 'description' => 'Manage GitGuardian secret incidents, scan methods, sources, teams, members, SCIM users and groups, honeytokens, audit logs, custom tags, and IP allowlists.', 'icon' => 'ph:shield-check', 'logo' => 'ph:shield-check', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://api.gitguardian.com/docs']; }
    public function configSchema(): array { return [['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'GitGuardian API key', 'hint' => 'Sent as Authorization: Token <api_key>.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.gitguardian.com', 'hint' => 'Use https://api.gitguardian.com or https://api.eu1.gitguardian.com.', 'default' => 'https://api.gitguardian.com']]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.gitguardian.com'), '/');
        if ($apiKey === '') { return ['success' => false, 'error' => 'GitGuardian API key is required.']; }

        try {
            $response = Http::withHeaders(['Authorization' => 'Token ' . $apiKey, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl . '/v1/api_tokens/self');
            if (!$response->successful()) { return ['success' => false, 'error' => 'GitGuardian API returned HTTP ' . $response->status() . '.']; }
            return ['success' => true, 'message' => 'Connected to GitGuardian at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array { return ['api_key' => 'nullable|string', 'url' => 'nullable|url']; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function tools(): array { return [
            'gitguardian_self_retrieve_api_token' => [
                'class' => GitGuardianSelfRetrieveApiToken::class,
                'name' => 'Self Retrieve API Token',
                'description' => 'Retrieve details of the current API token.

Official GitGuardian endpoint: GET /v1/api_tokens/self.',
                'parameters' => [],
            ],
            'gitguardian_self_delete_api_token' => [
                'class' => GitGuardianSelfDeleteApiToken::class,
                'name' => 'Self Delete API Token',
                'description' => 'Revoke the current API token.

Official GitGuardian endpoint: DELETE /v1/api_tokens/self.',
                'parameters' => [],
            ],
            'gitguardian_list_api_tokens' => [
                'class' => GitGuardianListApiTokens::class,
                'name' => 'List API Tokens',
                'description' => 'List all the tokens in the workspace, some filters are available and described below.

Official GitGuardian endpoint: GET /v1/api_tokens.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                    ],
                    'member_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Filter by member id.',
                    ],
                    'creator_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Filter by creator id.',
                    ],
                    'scopes' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'scopes',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['created_at', '-created_at', 'last_used_at', '-last_used_at', 'expire_at', '-expire_at', 'revoked_at', '-revoked_at'],
                    ],
                ],
            ],
            'gitguardian_retrieve_api_token' => [
                'class' => GitGuardianRetrieveApiToken::class,
                'name' => 'Retrieve API Token',
                'description' => 'Retrieve details of an API token.

Official GitGuardian endpoint: GET /v1/api_tokens/{token_id}.',
                'parameters' => [
                    'token_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Id of the token.',
                    ],
                ],
            ],
            'gitguardian_delete_api_token' => [
                'class' => GitGuardianDeleteApiToken::class,
                'name' => 'Delete API Token',
                'description' => 'Revoke an API token.

Official GitGuardian endpoint: DELETE /v1/api_tokens/{token_id}.',
                'parameters' => [
                    'token_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Id of the token.',
                    ],
                ],
            ],
            'gitguardian_public_jwt_create' => [
                'class' => GitGuardianPublicJwtCreate::class,
                'name' => 'Public JWT Create',
                'description' => 'Create a short lived JWT for authentication to specific GitGuardian services, including HasMySecretLeaked.

Official GitGuardian endpoint: POST /v1/auth/jwt.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_incidents' => [
                'class' => GitGuardianListIncidents::class,
                'name' => 'List Incidents',
                'description' => 'List secret incidents detected by the GitGuardian dashboard. Occurrences are not returned in this route.

Official GitGuardian endpoint: GET /v1/incidents/secrets.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Page number.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'date_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_before',
                    ],
                    'date_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_after',
                    ],
                    'triggered_at_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'triggered_at_before',
                    ],
                    'triggered_at_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'triggered_at_after',
                    ],
                    'assignee_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'assignee_email',
                    ],
                    'assignee_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'assignee_id',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                    ],
                    'severity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'severity',
                    ],
                    'validity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'validity',
                    ],
                    'tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'tags',
                    ],
                    'exclude_tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'exclude_tags',
                    ],
                    'custom_tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tags',
                    ],
                    'custom_tag_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tag_key',
                    ],
                    'custom_tag_value' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tag_value',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['date', '-date', 'resolved_at', '-resolved_at', 'ignored_at', '-ignored_at', 'risk_score', '-risk_score'],
                    ],
                    'detector_group_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'detector_group_name',
                    ],
                    'ignorer_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'ignorer_id',
                    ],
                    'ignorer_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'ignorer_api_token_id',
                    ],
                    'resolver_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'resolver_id',
                    ],
                    'resolver_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'resolver_api_token_id',
                    ],
                    'feedback' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'feedback',
                    ],
                    'only_on_provider_archived_sources' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'only_on_provider_archived_sources',
                    ],
                    'risk_score_min' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'risk_score_min',
                    ],
                    'risk_score_max' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'risk_score_max',
                    ],
                ],
            ],
            'gitguardian_retrieve_incidents' => [
                'class' => GitGuardianRetrieveIncidents::class,
                'name' => 'Retrieve Incidents',
                'description' => 'Retrieve secret incident detected by the GitGuardian dashboard with its occurrences.

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'with_occurrences' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Retrieve a number of occurrences of this incident.',
                    ],
                ],
            ],
            'gitguardian_update_secret_incident' => [
                'class' => GitGuardianUpdateSecretIncident::class,
                'name' => 'Update Secret Incident',
                'description' => 'Update a secret incident.

Official GitGuardian endpoint: PATCH /v1/incidents/secrets/{incident_id}.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_retrieve_incidents_leaks' => [
                'class' => GitGuardianRetrieveIncidentsLeaks::class,
                'name' => 'Retrieve Incidents Leaks',
                'description' => 'Retrieve where a secret has been publicly leaked. **Limitations:** - Does not work for multimatch secrets. - Does not return publicly visible internal sources.

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}/leaks.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                ],
            ],
            'gitguardian_assign_incident' => [
                'class' => GitGuardianAssignIncident::class,
                'name' => 'Assign Incident',
                'description' => 'Assign secret incident detected by the GitGuardian dashboard to a workspace member by email.

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/assign.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'send_email' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to notify the assignee.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_unassign_incident' => [
                'class' => GitGuardianUnassignIncident::class,
                'name' => 'Unassign Incident',
                'description' => 'Unassign secret incident from a workspace member by email.

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/unassign.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_resolve_incident' => [
                'class' => GitGuardianResolveIncident::class,
                'name' => 'Resolve Incident',
                'description' => 'Resolve a secret incident detected by the GitGuardian dashboard.

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/resolve.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_ignore_incident' => [
                'class' => GitGuardianIgnoreIncident::class,
                'name' => 'Ignore Incident',
                'description' => 'Ignore a secret incident detected by the GitGuardian dashboard.

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/ignore.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_reopen_incident' => [
                'class' => GitGuardianReopenIncident::class,
                'name' => 'Reopen Incident',
                'description' => 'Unresolve or unignore a secret incident detected by the GitGuardian dashboard.

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/reopen.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_share_incident' => [
                'class' => GitGuardianShareIncident::class,
                'name' => 'Share Incident',
                'description' => 'Share a secret incident by creating a public link.

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/share.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_unshare_incident' => [
                'class' => GitGuardianUnshareIncident::class,
                'name' => 'Unshare Incident',
                'description' => 'Unshare a secret incident by revoking its public link.

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/unshare.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_grant_access_incident' => [
                'class' => GitGuardianGrantAccessIncident::class,
                'name' => 'Grant Access Incident',
                'description' => 'Grant a user, an existing invitee or a team access to a secret incident. DEPRECATED: This endpoint has been replaced by [this one](#tag/Members/operation/set-member-resource-access) for members, [this one](#tag/Teams/operation/set-team-resource-access) for teams, and [this one](#tag/Invitations/operation/set-invitation-resource-access) for invitations.

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/grant_access.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_revoke_access_incident' => [
                'class' => GitGuardianRevokeAccessIncident::class,
                'name' => 'Revoke Access Incident',
                'description' => 'Revoke access to a secret incident

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/revoke_access.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_incident_notes' => [
                'class' => GitGuardianListIncidentNotes::class,
                'name' => 'List Incident Notes',
                'description' => 'List notes left on a secret incident in chronological order.

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}/notes.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Page number.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['created_at', '-created_at', 'updated_at', '-updated_at'],
                    ],
                    'member_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Filter by member id.',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                ],
            ],
            'gitguardian_create_incident_note' => [
                'class' => GitGuardianCreateIncidentNote::class,
                'name' => 'Create Incident Note',
                'description' => 'Add a note on a secret incident.

Official GitGuardian endpoint: POST /v1/incidents/secrets/{incident_id}/notes.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_update_incident_note' => [
                'class' => GitGuardianUpdateIncidentNote::class,
                'name' => 'Update Incident Note',
                'description' => 'Update an existing comment on a secret incident. Only incident notes created by the current API key can be updated.

Official GitGuardian endpoint: PATCH /v1/incidents/secrets/{incident_id}/notes/{note_id}.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'note_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident note to update',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_delete_incident_note' => [
                'class' => GitGuardianDeleteIncidentNote::class,
                'name' => 'Delete Incident Note',
                'description' => 'Delete an existing comment on a secret incident. Only incident notes created by the current API key can be deleted.

Official GitGuardian endpoint: DELETE /v1/incidents/secrets/{incident_id}/notes/{note_id}.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'note_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident note to delete',
                    ],
                ],
            ],
            'gitguardian_list_incident_members' => [
                'class' => GitGuardianListIncidentMembers::class,
                'name' => 'List Incident Members',
                'description' => 'List all the members having access to a secret incident. DEPRECATED: This endpoint has been replaced by [/v1/secret-incidents/{incident_id}/members](#tag/Secret-Incidents/operation/list-secret-incident-member-access)

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}/members.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Page number.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'member_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'member_id',
                    ],
                    'incident_permission' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'incident_permission',
                    ],
                    'role' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'role',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                ],
            ],
            'gitguardian_list_incident_teams' => [
                'class' => GitGuardianListIncidentTeams::class,
                'name' => 'List Incident Teams',
                'description' => 'List all the teams having access to a secret incident. DEPRECATED: This endpoint has been replaced by [/v1/secret-incidents/{incident_id}/teams](#tag/Secret-Incidents/operation/list-secret-incident-team-access)

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}/teams.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'team_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'team_id',
                    ],
                    'incident_permission' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'incident_permission',
                    ],
                ],
            ],
            'gitguardian_list_incident_invitations' => [
                'class' => GitGuardianListIncidentInvitations::class,
                'name' => 'List Incident Invitations',
                'description' => 'List all the invitations having access to a Secret Incident. DEPRECATED: This endpoint has been replaced by [/v1/secret-incidents/{incident_id}/invitations](#tag/Secret-Incidents/operation/list-secret-incident-invitation-access)

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}/invitations.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'invitation_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'invitation_id',
                    ],
                    'incident_permission' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'filter accesses with a specific permission.',
                    ],
                ],
            ],
            'gitguardian_retrieve_incident_impacted_perimeter' => [
                'class' => GitGuardianRetrieveIncidentImpactedPerimeter::class,
                'name' => 'Retrieve Incident Impacted Perimeter',
                'description' => 'Retrieve metrics about the impacted perimeter of a secret incident detected by the GitGuardian dashboard.

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}/impacted_perimeter.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                ],
            ],
            'gitguardian_get_secret_incident_vaults' => [
                'class' => GitGuardianGetSecretIncidentVaults::class,
                'name' => 'Get Secret Incident Vaults',
                'description' => 'Returns detailed vault path information if the secret is stored in a vault. This endpoint requires the NHI (Non-Human Identity) feature to be enabled and the `show_vault_path_in_public_api` setting to be active. If either condition is not met, an empty array is returned.

Official GitGuardian endpoint: GET /v1/incidents/secrets/{incident_id}/vaults.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                ],
            ],
            'gitguardian_list_secret_incident_member_access' => [
                'class' => GitGuardianListSecretIncidentMemberAccess::class,
                'name' => 'List Secret Incident Member Access',
                'description' => 'List members that have access to a secret incident.

Official GitGuardian endpoint: GET /v1/secret-incidents/{incident_id}/members.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'role' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'role',
                    ],
                    'access_level' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'access_level',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['created_at', '-created_at', 'last_login', '-last_login'],
                    ],
                    'direct_access' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Filter on direct or indirect accesses.',
                    ],
                ],
            ],
            'gitguardian_list_secret_incident_team_access' => [
                'class' => GitGuardianListSecretIncidentTeamAccess::class,
                'name' => 'List Secret Incident Team Access',
                'description' => 'List teams that have access to a secret incident.

Official GitGuardian endpoint: GET /v1/secret-incidents/{incident_id}/teams.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'direct_access' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Filter on direct or indirect accesses.',
                    ],
                ],
            ],
            'gitguardian_list_secret_incident_invitation_access' => [
                'class' => GitGuardianListSecretIncidentInvitationAccess::class,
                'name' => 'List Secret Incident Invitation Access',
                'description' => 'List invitations that have access to a secret incident.

Official GitGuardian endpoint: GET /v1/secret-incidents/{incident_id}/invitations.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['date', '-date'],
                    ],
                    'direct_access' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Filter on direct or indirect accesses.',
                    ],
                ],
            ],
            'gitguardian_list_occs' => [
                'class' => GitGuardianListOccs::class,
                'name' => 'List Occs',
                'description' => 'List occurrences of secrets in the monitored perimeter.

Official GitGuardian endpoint: GET /v1/occurrences/secrets.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Page number.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'date_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_before',
                    ],
                    'date_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_after',
                    ],
                    'source_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Filter on the source ID.',
                    ],
                    'source_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'source_name',
                    ],
                    'source_type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'source_type',
                    ],
                    'incident_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Filter by incident ID.',
                    ],
                    'incident_assignee_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Filter by incident assignee member ID.',
                    ],
                    'presence' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'presence',
                    ],
                    'author_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'author_name',
                    ],
                    'author_info' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'author_info',
                    ],
                    'sha' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'sha',
                    ],
                    'filepath' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'filepath',
                    ],
                    'severity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'severity',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                    ],
                    'validity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'validity',
                    ],
                    'tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'tags',
                    ],
                    'exclude_tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'exclude_tags',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['date', '-date'],
                    ],
                ],
            ],
            'gitguardian_list_severity_rules' => [
                'class' => GitGuardianListSeverityRules::class,
                'name' => 'List Severity Rules',
                'description' => 'List the severity rules currently active for the workspace. These rules determine how incident severity is automatically assigned. Use the rule `id` to correlate with the `severity_rule_id` field on incidents.

Official GitGuardian endpoint: GET /v1/severity-rules.',
                'parameters' => [],
            ],
            'gitguardian_create_code_fix_request' => [
                'class' => GitGuardianCreateCodeFixRequest::class,
                'name' => 'Create Code Fix Request',
                'description' => 'Create code fix requests for multiple secret incidents with their locations. This will generate pull requests to automatically remediate the detected secrets. Each request must include: - One or more issues (by issue_id) - One or more location IDs for each issue The system will group locations by source repository and create one pull request per source.

Official GitGuardian endpoint: POST /v1/code-fix-requests.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_public_incidents' => [
                'class' => GitGuardianListPublicIncidents::class,
                'name' => 'List Public Incidents',
                'description' => 'List public secret incidents detected by the GitGuardian dashboard.

Official GitGuardian endpoint: GET /v1/public-incidents/secrets.',
                'parameters' => [
                    'x_privacy_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'When set to `true`, sensitive values in the response are obfuscated (replaced with `<GG>OBFUSCATED</GG>`). Useful for sharing API responses without exposing sensitive data.',
                        'enum' => ['true', 'false'],
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'date_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_before',
                    ],
                    'date_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_after',
                    ],
                    'triggered_at_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'triggered_at_before',
                    ],
                    'triggered_at_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'triggered_at_after',
                    ],
                    'assignee_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'assignee_email',
                    ],
                    'assignee_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'assignee_id',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                    ],
                    'severity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'severity',
                    ],
                    'validity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'validity',
                    ],
                    'tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'tags',
                    ],
                    'custom_tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tags',
                    ],
                    'custom_tag_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tag_key',
                    ],
                    'custom_tag_value' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tag_value',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['date', '-date', 'resolved_at', '-resolved_at', 'ignored_at', '-ignored_at', 'risk_score', '-risk_score'],
                    ],
                    'detector_group_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'detector_group_name',
                    ],
                    'ignorer_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'ignorer_id',
                    ],
                    'ignorer_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'ignorer_api_token_id',
                    ],
                    'resolver_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'resolver_id',
                    ],
                    'resolver_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'resolver_api_token_id',
                    ],
                    'feedback' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'feedback',
                    ],
                    'declarative_secret_status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'declarative_secret_status',
                    ],
                    'risk_score_min' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'risk_score_min',
                    ],
                    'risk_score_max' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'risk_score_max',
                    ],
                ],
            ],
            'gitguardian_retrieve_public_incidents' => [
                'class' => GitGuardianRetrievePublicIncidents::class,
                'name' => 'Retrieve Public Incidents',
                'description' => 'Retrieve public secret incident detected by the GitGuardian dashboard

Official GitGuardian endpoint: GET /v1/public-incidents/secrets/{incident_id}.',
                'parameters' => [
                    'x_privacy_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'When set to `true`, sensitive values in the response are obfuscated (replaced with `<GG>OBFUSCATED</GG>`). Useful for sharing API responses without exposing sensitive data.',
                        'enum' => ['true', 'false'],
                    ],
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                ],
            ],
            'gitguardian_list_public_secret_occurrences' => [
                'class' => GitGuardianListPublicSecretOccurrences::class,
                'name' => 'List Public Secret Occurrences',
                'description' => 'List occurrences of a public secret incident detected by the GitGuardian dashboard

Official GitGuardian endpoint: GET /v1/public-incidents/secrets/{incident_id}/occurrences.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'date_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_before',
                    ],
                    'date_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_after',
                    ],
                    'source_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Filter on the source ID.',
                    ],
                    'presence' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'presence',
                    ],
                    'sha' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'sha',
                    ],
                    'filepath' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'filepath',
                    ],
                    'attachment_reason' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'attachment_reason',
                    ],
                    'severity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'severity',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                    ],
                    'validity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'validity',
                    ],
                    'tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'tags',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['id', '-id', 'date', '-date'],
                    ],
                ],
            ],
            'gitguardian_retrieve_public_secret_occurrence' => [
                'class' => GitGuardianRetrievePublicSecretOccurrence::class,
                'name' => 'Retrieve Public Secret Occurrence',
                'description' => 'Retrieve a specific occurrence of a public secret incident detected by the GitGuardian dashboard

Official GitGuardian endpoint: GET /v1/public-incidents/secrets/{incident_id}/occurrences/{occurrence_id}.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'occurrence_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The ID of the occurrence to retrieve',
                    ],
                ],
            ],
            'gitguardian_resolve_public_incidents' => [
                'class' => GitGuardianResolvePublicIncidents::class,
                'name' => 'Resolve Public Incidents',
                'description' => 'Resolve a public secret incident detected by the GitGuardian dashboard.

Official GitGuardian endpoint: POST /v1/public-incidents/secrets/{incident_id}/resolve.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_ignore_public_incidents' => [
                'class' => GitGuardianIgnorePublicIncidents::class,
                'name' => 'Ignore Public Incidents',
                'description' => 'Ignore a public secret incident detected by the GitGuardian dashboard.

Official GitGuardian endpoint: POST /v1/public-incidents/secrets/{incident_id}/ignore.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_reopen_public_incidents' => [
                'class' => GitGuardianReopenPublicIncidents::class,
                'name' => 'Reopen Public Incidents',
                'description' => 'Reopen a public secret incident that was previously resolved or ignored.

Official GitGuardian endpoint: POST /v1/public-incidents/secrets/{incident_id}/reopen.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_assign_public_incidents' => [
                'class' => GitGuardianAssignPublicIncidents::class,
                'name' => 'Assign Public Incidents',
                'description' => 'Assign a public secret incident to a workspace member by email or member ID.

Official GitGuardian endpoint: POST /v1/public-incidents/secrets/{incident_id}/assign.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'send_email' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to notify the assignee.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_unassign_public_incidents' => [
                'class' => GitGuardianUnassignPublicIncidents::class,
                'name' => 'Unassign Public Incidents',
                'description' => 'Unassign a public secret incident from its current assignee.

Official GitGuardian endpoint: POST /v1/public-incidents/secrets/{incident_id}/unassign.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_share_public_incidents' => [
                'class' => GitGuardianSharePublicIncidents::class,
                'name' => 'Share Public Incidents',
                'description' => 'Create a public link to share a public secret incident with an external developer.

Official GitGuardian endpoint: POST /v1/public-incidents/secrets/{incident_id}/share.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_unshare_public_incidents' => [
                'class' => GitGuardianUnsharePublicIncidents::class,
                'name' => 'Unshare Public Incidents',
                'description' => 'Delete a public secret incident\'s share link.

Official GitGuardian endpoint: POST /v1/public-incidents/secrets/{incident_id}/unshare.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_set_severity_public_incidents' => [
                'class' => GitGuardianSetSeverityPublicIncidents::class,
                'name' => 'Set Severity Public Incidents',
                'description' => 'Set the severity of a public secret incident.

Official GitGuardian endpoint: POST /v1/public-incidents/secrets/{incident_id}/set_severity.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_set_custom_tags_public_incidents' => [
                'class' => GitGuardianSetCustomTagsPublicIncidents::class,
                'name' => 'Set Custom Tags Public Incidents',
                'description' => 'Set the custom tags of a public secret incident.

Official GitGuardian endpoint: POST /v1/public-incidents/secrets/{incident_id}/set_custom_tags.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_public_incident_notes' => [
                'class' => GitGuardianListPublicIncidentNotes::class,
                'name' => 'List Public Incident Notes',
                'description' => 'List notes left on a public secret incident in chronological order.

Official GitGuardian endpoint: GET /v1/public-incidents/secrets/{incident_id}/notes.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['created_at', '-created_at', 'updated_at', '-updated_at'],
                    ],
                    'member_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Filter by member id.',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                ],
            ],
            'gitguardian_create_public_incident_note' => [
                'class' => GitGuardianCreatePublicIncidentNote::class,
                'name' => 'Create Public Incident Note',
                'description' => 'Add a note on a public secret incident.

Official GitGuardian endpoint: POST /v1/public-incidents/secrets/{incident_id}/notes.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_update_public_incident_note' => [
                'class' => GitGuardianUpdatePublicIncidentNote::class,
                'name' => 'Update Public Incident Note',
                'description' => 'Update an existing comment on a public secret incident. Only incident notes created by the current API key can be updated.

Official GitGuardian endpoint: PATCH /v1/public-incidents/secrets/{incident_id}/notes/{note_id}.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'note_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident note to update',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_delete_public_incident_note' => [
                'class' => GitGuardianDeletePublicIncidentNote::class,
                'name' => 'Delete Public Incident Note',
                'description' => 'Delete an existing comment on a public secret incident. Only incident notes created by the current API key can be deleted.

Official GitGuardian endpoint: DELETE /v1/public-incidents/secrets/{incident_id}/notes/{note_id}.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                    'note_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident note to delete',
                    ],
                ],
            ],
            'gitguardian_get_public_secret_incident_vaults' => [
                'class' => GitGuardianGetPublicSecretIncidentVaults::class,
                'name' => 'Get Public Secret Incident Vaults',
                'description' => 'Returns detailed vault path information if the secret is stored in a vault. This endpoint requires the NHI (Non-Human Identity) feature to be enabled and the `show_vault_path_in_public_api` setting to be active. If either condition is not met, an empty array is returned.

Official GitGuardian endpoint: GET /v1/public-incidents/secrets/{incident_id}/vaults.',
                'parameters' => [
                    'incident_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the incident to retrieve',
                    ],
                ],
            ],
            'gitguardian_list_invitations' => [
                'class' => GitGuardianListInvitations::class,
                'name' => 'List Invitations',
                'description' => 'This endpoint allows you to list all pending invitations. The response contains the list of invitations and a pagination cursor to retrieve the next page. The invitations are sorted by id. If you are using a personal access token, you need to have an access level superior or equal to `member`.

Official GitGuardian endpoint: GET /v1/invitations.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['date', '-date'],
                    ],
                ],
            ],
            'gitguardian_create_invitations' => [
                'class' => GitGuardianCreateInvitations::class,
                'name' => 'Create Invitations',
                'description' => 'This endpoint allows you to send an invitation to a user. If you are using a personal access token, you need to have an access level superior or equal to `member`.

Official GitGuardian endpoint: POST /v1/invitations.',
                'parameters' => [
                    'send_email' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to send an email to the invitee with a link to accept the invitation.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_retrieve_invitation' => [
                'class' => GitGuardianRetrieveInvitation::class,
                'name' => 'Retrieve Invitation',
                'description' => 'Retrieve an existing invitation. If you are using a personal access token, you need to have an access level superior or equal to `member`.

Official GitGuardian endpoint: GET /v1/invitations/{invitation_id}.',
                'parameters' => [
                    'invitation_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the invitation to retrieve',
                    ],
                ],
            ],
            'gitguardian_delete_invitation' => [
                'class' => GitGuardianDeleteInvitation::class,
                'name' => 'Delete Invitation',
                'description' => 'Delete an existing invitation. If you are using a personal access token, you need to have an access level superior or equal to `manager`.

Official GitGuardian endpoint: DELETE /v1/invitations/{invitation_id}.',
                'parameters' => [
                    'invitation_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the invitation to retrieve',
                    ],
                ],
            ],
            'gitguardian_resend_invitation' => [
                'class' => GitGuardianResendInvitation::class,
                'name' => 'Resend Invitation',
                'description' => 'Resend an existing invitation. If you are using a personal access token, you need to have an access level superior or equal to `manager`.

Official GitGuardian endpoint: POST /v1/invitations/{invitation_id}/resend.',
                'parameters' => [
                    'invitation_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the invitation to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_get_invitation_resource_access' => [
                'class' => GitGuardianGetInvitationResourceAccess::class,
                'name' => 'Get Invitation Resource Access',
                'description' => 'Return the permission an invitation has on a resource. If the invitation has an admin access level, it will be the highest possible value.

Official GitGuardian endpoint: GET /v1/invitations/{invitation_id}/{resource_type}/{resource_id}.',
                'parameters' => [
                    'invitation_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the invitation to retrieve',
                    ],
                    'resource_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The kind of resource of the access',
                        'enum' => ['secret-incidents'],
                    ],
                    'resource_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the resource of the access',
                    ],
                ],
            ],
            'gitguardian_set_invitation_resource_access' => [
                'class' => GitGuardianSetInvitationResourceAccess::class,
                'name' => 'Set Invitation Resource Access',
                'description' => 'This will create or update a direct access for the invitation on the resource. If the invitation has an administrator access level, it will take precedence over the permission you have given.

Official GitGuardian endpoint: PUT /v1/invitations/{invitation_id}/{resource_type}/{resource_id}.',
                'parameters' => [
                    'invitation_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the invitation to retrieve',
                    ],
                    'resource_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The kind of resource of the access',
                        'enum' => ['secret-incidents'],
                    ],
                    'resource_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the resource of the access',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_revoke_invitation_resource_access' => [
                'class' => GitGuardianRevokeInvitationResourceAccess::class,
                'name' => 'Revoke Invitation Resource Access',
                'description' => 'Revoke an invitation access to a resource. This only works for direct accesses. If the access is from the administrator access level of the invitation, a 404 is returned.

Official GitGuardian endpoint: DELETE /v1/invitations/{invitation_id}/{resource_type}/{resource_id}.',
                'parameters' => [
                    'invitation_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the invitation to retrieve',
                    ],
                    'resource_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The kind of resource of the access',
                        'enum' => ['secret-incidents'],
                    ],
                    'resource_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the resource of the access',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_invitation_secret_incident_access' => [
                'class' => GitGuardianListInvitationSecretIncidentAccess::class,
                'name' => 'List Invitation Secret Incident Access',
                'description' => 'List secret incidents that an invitation has access to.

Official GitGuardian endpoint: GET /v1/invitations/{invitation_id}/secret-incidents.',
                'parameters' => [
                    'invitation_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the invitation to retrieve',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Page number.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'date_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_before',
                    ],
                    'date_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_after',
                    ],
                    'assignee_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'assignee_email',
                    ],
                    'assignee_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'assignee_id',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                    ],
                    'severity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'severity',
                    ],
                    'validity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'validity',
                    ],
                    'tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'tags',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['date', '-date', 'resolved_at', '-resolved_at', 'ignored_at', '-ignored_at'],
                    ],
                    'detector_group_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'detector_group_name',
                    ],
                    'ignorer_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'ignorer_id',
                    ],
                    'ignorer_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'ignorer_api_token_id',
                    ],
                    'resolver_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'resolver_id',
                    ],
                    'resolver_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'resolver_api_token_id',
                    ],
                    'feedback' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'feedback',
                    ],
                    'only_on_provider_archived_sources' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'only_on_provider_archived_sources',
                    ],
                ],
            ],
            'gitguardian_list_members' => [
                'class' => GitGuardianListMembers::class,
                'name' => 'List Members',
                'description' => 'List members of the workspace.

Official GitGuardian endpoint: GET /v1/members.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Page number.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'role' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'role',
                    ],
                    'access_level' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'access_level',
                    ],
                    'active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'active',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['created_at', '-created_at', 'last_login', '-last_login'],
                    ],
                ],
            ],
            'gitguardian_retrieve_member' => [
                'class' => GitGuardianRetrieveMember::class,
                'name' => 'Retrieve Member',
                'description' => 'Retrieve an existing workspace member. If you are using a personal access token, you need to have an access level greater or equal to `member`.

Official GitGuardian endpoint: GET /v1/members/{member_id}.',
                'parameters' => [
                    'member_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the workspace member',
                    ],
                ],
            ],
            'gitguardian_delete_member' => [
                'class' => GitGuardianDeleteMember::class,
                'name' => 'Delete Member',
                'description' => 'Delete an existing workspace member. If you are using a personal access token, you need to have an access level greater or equal to `manager`.

Official GitGuardian endpoint: DELETE /v1/members/{member_id}.',
                'parameters' => [
                    'member_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the workspace member',
                    ],
                    'send_email' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to notify the member about the removal.',
                    ],
                ],
            ],
            'gitguardian_update_member' => [
                'class' => GitGuardianUpdateMember::class,
                'name' => 'Update Member',
                'description' => 'Update an existing workspace member. If you are using a personal access token, you need to have an access level greater or equal to `manager`.

Official GitGuardian endpoint: PATCH /v1/members/{member_id}.',
                'parameters' => [
                    'member_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the workspace member',
                    ],
                    'send_email' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to notify the member about the update.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_member_teams' => [
                'class' => GitGuardianListMemberTeams::class,
                'name' => 'List Member Teams',
                'description' => 'List teams of a workspace member. The response contains the list of teams and a pagination cursor to retrieve the next page. The teams are sorted by id. If you are using a personal access token, you need to have an access level superior or equal to `manager` except if the requested member is yourself.

Official GitGuardian endpoint: GET /v1/members/{member_id}/teams.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'is_global' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'is_global',
                    ],
                    'member_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the workspace member',
                    ],
                ],
            ],
            'gitguardian_get_member_resource_access' => [
                'class' => GitGuardianGetMemberResourceAccess::class,
                'name' => 'Get Member Resource Access',
                'description' => 'Return the permission a member has on a resource. The permission is the higher value between the different accesses the member can have (direct access, member\'s teams accesses, and administrator access).

Official GitGuardian endpoint: GET /v1/members/{member_id}/{resource_type}/{resource_id}.',
                'parameters' => [
                    'member_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the workspace member',
                    ],
                    'resource_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The kind of resource of the access',
                        'enum' => ['secret-incidents'],
                    ],
                    'resource_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the resource of the access',
                    ],
                ],
            ],
            'gitguardian_set_member_resource_access' => [
                'class' => GitGuardianSetMemberResourceAccess::class,
                'name' => 'Set Member Resource Access',
                'description' => 'This will create or update a direct access for the member on the resource. If the member has higher permission from another source, they will take precedence over those you have given.

Official GitGuardian endpoint: PUT /v1/members/{member_id}/{resource_type}/{resource_id}.',
                'parameters' => [
                    'member_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the workspace member',
                    ],
                    'resource_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The kind of resource of the access',
                        'enum' => ['secret-incidents'],
                    ],
                    'resource_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the resource of the access',
                    ],
                    'send_email' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to notify the member about the access.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_revoke_member_resource_access' => [
                'class' => GitGuardianRevokeMemberResourceAccess::class,
                'name' => 'Revoke Member Resource Access',
                'description' => 'Revoke a member access to a resource. This only works for direct accesses. If the member has only indirect access, a 404 is returned.

Official GitGuardian endpoint: DELETE /v1/members/{member_id}/{resource_type}/{resource_id}.',
                'parameters' => [
                    'member_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the workspace member',
                    ],
                    'resource_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The kind of resource of the access',
                        'enum' => ['secret-incidents'],
                    ],
                    'resource_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the resource of the access',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_member_secret_incident_access' => [
                'class' => GitGuardianListMemberSecretIncidentAccess::class,
                'name' => 'List Member Secret Incident Access',
                'description' => 'List secret incidents that a member has access to.

Official GitGuardian endpoint: GET /v1/members/{member_id}/secret-incidents.',
                'parameters' => [
                    'member_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the workspace member',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Page number.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'date_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_before',
                    ],
                    'date_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_after',
                    ],
                    'assignee_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'assignee_email',
                    ],
                    'assignee_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'assignee_id',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                    ],
                    'severity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'severity',
                    ],
                    'validity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'validity',
                    ],
                    'tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'tags',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['date', '-date', 'resolved_at', '-resolved_at', 'ignored_at', '-ignored_at'],
                    ],
                    'detector_group_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'detector_group_name',
                    ],
                    'ignorer_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'ignorer_id',
                    ],
                    'ignorer_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'ignorer_api_token_id',
                    ],
                    'resolver_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'resolver_id',
                    ],
                    'resolver_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'resolver_api_token_id',
                    ],
                    'feedback' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'feedback',
                    ],
                    'only_on_provider_archived_sources' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'only_on_provider_archived_sources',
                    ],
                ],
            ],
            'gitguardian_retrieve_member_email_settings' => [
                'class' => GitGuardianRetrieveMemberEmailSettings::class,
                'name' => 'Retrieve Member Email Settings',
                'description' => 'Retrieve a member\'s email settings If you are using a personal access token, you need to have access level greater than `member` to view other member\'s settings

Official GitGuardian endpoint: GET /v1/members/{member_id}/email_notifications.',
                'parameters' => [
                    'member_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the workspace member',
                    ],
                ],
            ],
            'gitguardian_update_member_email_settings' => [
                'class' => GitGuardianUpdateMemberEmailSettings::class,
                'name' => 'Update Member Email Settings',
                'description' => 'Update a member\'s email settings If you are using a personal access token, you need to have access level greater than `member` to edit other member\'s settings

Official GitGuardian endpoint: PATCH /v1/members/{member_id}/email_notifications.',
                'parameters' => [
                    'member_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the workspace member',
                    ],
                    'send_email' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to notify the member about the update.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_content_scan' => [
                'class' => GitGuardianContentScan::class,
                'name' => 'Content Scan',
                'description' => 'Scan provided document content for policy breaks. Request body shouldn\'t exceed 1MB. This endpoint is stateless and as such will not store in our servers neither the documents nor the secrets found.

Official GitGuardian endpoint: POST /v1/scan.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_multiple_scan' => [
                'class' => GitGuardianMultipleScan::class,
                'name' => 'Multiple Scan',
                'description' => 'Multiple content scan

Official GitGuardian endpoint: POST /v1/multiscan.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_scan_create_incidents' => [
                'class' => GitGuardianScanCreateIncidents::class,
                'name' => 'Scan Create Incidents',
                'description' => 'Scan content and create incidents

Official GitGuardian endpoint: POST /v1/scan/create-incidents.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_secret_detectors' => [
                'class' => GitGuardianListSecretDetectors::class,
                'name' => 'List Secret Detectors',
                'description' => 'List secret detectors.

Official GitGuardian endpoint: GET /v1/secret_detectors.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'is_active' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'is_active',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'type',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['name', '-name'],
                    ],
                ],
            ],
            'gitguardian_get_secret_detector' => [
                'class' => GitGuardianGetSecretDetector::class,
                'name' => 'Get Secret Detector',
                'description' => 'Get a secret detector.

Official GitGuardian endpoint: GET /v1/secret_detectors/{detector_name}.',
                'parameters' => [
                    'detector_name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Name of the detector to retrieve',
                    ],
                ],
            ],
            'gitguardian_get_secret_detail' => [
                'class' => GitGuardianGetSecretDetail::class,
                'name' => 'Get Secret Detail',
                'description' => 'Retrieve the information, including its clear text value, of a secret by its ID. **Prerequisites**: - This endpoint must be enabled in the workspace settings under Security by a workspace admin. - A valid API key with the secrets:read scope. This scope is available only for Personal Access Tokens (PATs).

Official GitGuardian endpoint: GET /v1/secrets/{secret_id}.',
                'parameters' => [
                    'secret_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The ID of the secret to retrieve',
                    ],
                    'x_privacy_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'When set to `true`, sensitive values in the response are obfuscated (replaced with `<GG>OBFUSCATED</GG>`). Useful for sharing API responses without exposing sensitive data.',
                        'enum' => ['true', 'false'],
                    ],
                ],
            ],
            'gitguardian_quotas' => [
                'class' => GitGuardianQuotas::class,
                'name' => 'Quotas',
                'description' => 'Check available scanning calls for this token. Quota is shared between all tokens of a workspace

Official GitGuardian endpoint: GET /v1/quotas.',
                'parameters' => [],
            ],
            'gitguardian_list_sources' => [
                'class' => GitGuardianListSources::class,
                'name' => 'List Sources',
                'description' => 'List sources known by GitGuardian.

Official GitGuardian endpoint: GET /v1/sources.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Page number.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'last_scan_status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'last_scan_status',
                    ],
                    'health' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'health',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'type',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['last_scan_date', '-last_scan_date'],
                    ],
                    'visibility' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'visibility',
                        'enum' => ['public', 'private', 'internal'],
                    ],
                    'external_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'external_id',
                    ],
                    'source_criticality' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'source_criticality',
                        'enum' => ['critical', 'high', 'medium', 'low', 'unknown'],
                    ],
                    'monitored' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'monitored',
                    ],
                    'provider_metadata_archived' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'provider_metadata_archived',
                    ],
                ],
            ],
            'gitguardian_retrieve_source' => [
                'class' => GitGuardianRetrieveSource::class,
                'name' => 'Retrieve Source',
                'description' => 'Retrieve a source known by GitGuardian.

Official GitGuardian endpoint: GET /v1/sources/{source_id}.',
                'parameters' => [
                    'source_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the source to retrieve.',
                    ],
                ],
            ],
            'gitguardian_update_source' => [
                'class' => GitGuardianUpdateSource::class,
                'name' => 'Update Source',
                'description' => 'Update some source attributes such as monitored status and source criticality. The monitored status can be updated for all source types except Custom Sources. **⚠️ Note**: some sources types are supported on this endpoint, but cannot be updated yet on the dashboard. Business sources can\'t be updated if your account doesn\'t have access to them.

Official GitGuardian endpoint: PATCH /v1/sources/{source_id}.',
                'parameters' => [
                    'source_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the source to retrieve.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_sources_incidents' => [
                'class' => GitGuardianListSourcesIncidents::class,
                'name' => 'List Sources Incidents',
                'description' => 'List secret incidents linked to a source. Occurrences are not returned in this route.

Official GitGuardian endpoint: GET /v1/sources/{source_id}/incidents/secrets.',
                'parameters' => [
                    'source_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the source to filter on.',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'date_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_before',
                    ],
                    'date_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_after',
                    ],
                    'assignee_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'assignee_email',
                    ],
                    'assignee_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'assignee_id',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                    ],
                    'severity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'severity',
                    ],
                    'validity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'validity',
                    ],
                    'tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'tags',
                    ],
                    'custom_tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tags',
                    ],
                    'custom_tag_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tag_key',
                    ],
                    'custom_tag_value' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tag_value',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['date', '-date', 'resolved_at', '-resolved_at', 'ignored_at', '-ignored_at'],
                    ],
                    'detector_group_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'detector_group_name',
                    ],
                    'ignorer_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'ignorer_id',
                    ],
                    'ignorer_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'ignorer_api_token_id',
                    ],
                    'resolver_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'resolver_id',
                    ],
                    'resolver_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'resolver_api_token_id',
                    ],
                    'feedback' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'feedback',
                    ],
                    'only_on_provider_archived_sources' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'only_on_provider_archived_sources',
                    ],
                ],
            ],
            'gitguardian_trigger_source_scans' => [
                'class' => GitGuardianTriggerSourceScans::class,
                'name' => 'Trigger Source Scans',
                'description' => 'Trigger scans on sources

Official GitGuardian endpoint: POST /v1/sources/scans.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_custom_sources' => [
                'class' => GitGuardianListCustomSources::class,
                'name' => 'List Custom Sources',
                'description' => 'List custom sources for the authenticated account. **⚠️ Beta Version**: This endpoint is in beta and may be subject to changes in future releases.

Official GitGuardian endpoint: GET /v1/sources/custom-sources.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Page number.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['id', '-id', 'name', '-name'],
                    ],
                ],
            ],
            'gitguardian_create_custom_source' => [
                'class' => GitGuardianCreateCustomSource::class,
                'name' => 'Create Custom Source',
                'description' => 'Create a new custom source for the authenticated account. **⚠️ Beta Version**: This endpoint is in beta and may be subject to changes in future releases.

Official GitGuardian endpoint: POST /v1/sources/custom-sources.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_get_custom_source' => [
                'class' => GitGuardianGetCustomSource::class,
                'name' => 'Get Custom Source',
                'description' => 'Get a custom source by ID. **⚠️ Beta Version**: This endpoint is in beta and may be subject to changes in future releases.

Official GitGuardian endpoint: GET /v1/sources/custom-sources/{custom_source_id}.',
                'parameters' => [
                    'custom_source_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the custom source to retrieve.',
                    ],
                ],
            ],
            'gitguardian_update_custom_source' => [
                'class' => GitGuardianUpdateCustomSource::class,
                'name' => 'Update Custom Source',
                'description' => 'Update a custom source\'s name and description. **⚠️ Beta Version**: This endpoint is in beta and may be subject to changes in future releases.

Official GitGuardian endpoint: PATCH /v1/sources/custom-sources/{custom_source_id}.',
                'parameters' => [
                    'custom_source_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the custom source to update.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_delete_custom_source' => [
                'class' => GitGuardianDeleteCustomSource::class,
                'name' => 'Delete Custom Source',
                'description' => 'Delete a custom source. This will also delete the related integration if no other sources exist. **⚠️ Beta Version**: This endpoint is in beta and may be subject to changes in future releases.

Official GitGuardian endpoint: DELETE /v1/sources/custom-sources/{custom_source_id}.',
                'parameters' => [
                    'custom_source_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the custom source to delete.',
                    ],
                ],
            ],
            'gitguardian_list_developers' => [
                'class' => GitGuardianListDevelopers::class,
                'name' => 'List Developers',
                'description' => 'List developers in the public perimeter.

Official GitGuardian endpoint: GET /v1/public-perimeter/developers.',
                'parameters' => [
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['github_login', '-github_login', 'name', '-name', 'emails', '-emails', 'is_active', '-is_active'],
                    ],
                ],
            ],
            'gitguardian_list_audit_logs' => [
                'class' => GitGuardianListAuditLogs::class,
                'name' => 'List Audit Logs',
                'description' => 'List audit logs.

Official GitGuardian endpoint: GET /v1/audit_logs.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'date_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_before',
                    ],
                    'date_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_after',
                    ],
                    'event_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Entries matching this event name.',
                    ],
                    'member_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The id of the member to retrieve.',
                    ],
                    'member_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Entries matching this member name.',
                    ],
                    'member_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Entries matching this member email.',
                    ],
                    'api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Entries matching this API token id.',
                    ],
                    'ip_address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Entries matching this IP address.',
                    ],
                ],
            ],
            'gitguardian_list_audit_log_event_names' => [
                'class' => GitGuardianListAuditLogEventNames::class,
                'name' => 'List Audit Log Event Names',
                'description' => 'List all the existing event names for audit logs. Use this endpoint to discover which event types are available for filtering when querying audit logs.

Official GitGuardian endpoint: GET /v1/audit_logs/event_names.',
                'parameters' => [],
            ],
            'gitguardian_api_health' => [
                'class' => GitGuardianApiHealth::class,
                'name' => 'API Health',
                'description' => 'Check the status of the API and your token without spending your quota.

Official GitGuardian endpoint: GET /v1/health.',
                'parameters' => [],
            ],
            'gitguardian_list_health_checks' => [
                'class' => GitGuardianListHealthChecks::class,
                'name' => 'List Health Checks',
                'description' => 'List the latest health check per integration instance for the authenticated account. Each entry represents the most recent health check run for a given instance. Results can be filtered by integration type and health status.

Official GitGuardian endpoint: GET /v1/health-checks.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter by integration type.',
                        'enum' => ['aws-ecr-installation', 'aws-honeytoken-organization', 'aws-s3-installation', 'azure-cr-installation', 'azure-devops-installation', 'bitbucket-cloud-workspace', 'bitbucket-installation', 'confluence-cloud-installation', 'confluence-data-center-installation', 'docker-hub-installation', 'gerrit-installation', 'github-installation', 'gitlab-installation', 'google-artifact-installation', 'jfrog-artifact-installation', 'jfrog-package-installation', 'jira-cloud-installation', 'jira-data-center-installation', 'microsoft-onedrive-installation', 'microsoft-teams-installation', 'red-hat-quay-installation', 'servicenow-installation', 'servicenow-issue-tracking-config', 'sharepoint-online-drive-installation', 'slack-workspace'],
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                        'enum' => ['pass', 'warn', 'fail'],
                    ],
                    'started_at_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'started_at_after',
                    ],
                    'started_at_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'started_at_before',
                    ],
                ],
            ],
            'gitguardian_list_health_check_instance_history' => [
                'class' => GitGuardianListHealthCheckInstanceHistory::class,
                'name' => 'List Health Check Instance History',
                'description' => 'List all historical health check runs for a specific integration instance, ordered by most recent first by default. The `type` path parameter identifies the integration type using its public name. The `instance_id` is the internal ID of the integration instance (e.g. a GitHub installation, GitLab integration, or Slack workspace).

Official GitGuardian endpoint: GET /v1/health-checks/{type}/{instance_id}.',
                'parameters' => [
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The integration type identifier.',
                        'enum' => ['aws-ecr-installation', 'aws-honeytoken-organization', 'aws-s3-installation', 'azure-cr-installation', 'azure-devops-installation', 'bitbucket-cloud-workspace', 'bitbucket-installation', 'confluence-cloud-installation', 'confluence-data-center-installation', 'docker-hub-installation', 'gerrit-installation', 'github-installation', 'gitlab-installation', 'google-artifact-installation', 'jfrog-artifact-installation', 'jfrog-package-installation', 'jira-cloud-installation', 'jira-data-center-installation', 'microsoft-onedrive-installation', 'microsoft-teams-installation', 'red-hat-quay-installation', 'servicenow-installation', 'servicenow-issue-tracking-config', 'sharepoint-online-drive-installation', 'slack-workspace'],
                    ],
                    'instance_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The ID of the integration instance.',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                        'enum' => ['pass', 'warn', 'fail'],
                    ],
                    'started_at_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'started_at_after',
                    ],
                    'started_at_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'started_at_before',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is DESC (most recent first). Prefix with `-` for descending order.',
                        'enum' => ['started_at', '-started_at', 'id'],
                    ],
                ],
            ],
            'gitguardian_trigger_health_check' => [
                'class' => GitGuardianTriggerHealthCheck::class,
                'name' => 'Trigger Health Check',
                'description' => 'Enqueue a health check for a specific integration instance. The check runs asynchronously. The response includes a `result_url` pointing to the instance history endpoint pre-filtered to checks started after the trigger time, so you can poll for the result. Returns `429` if a health check was performed too recently for this instance.

Official GitGuardian endpoint: POST /v1/health-checks/{type}/{instance_id}/trigger.',
                'parameters' => [
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The integration type identifier.',
                        'enum' => ['aws-ecr-installation', 'aws-honeytoken-organization', 'aws-s3-installation', 'azure-cr-installation', 'azure-devops-installation', 'bitbucket-cloud-workspace', 'bitbucket-installation', 'confluence-cloud-installation', 'confluence-data-center-installation', 'docker-hub-installation', 'gerrit-installation', 'github-installation', 'gitlab-installation', 'google-artifact-installation', 'jfrog-artifact-installation', 'jfrog-package-installation', 'jira-cloud-installation', 'jira-data-center-installation', 'microsoft-onedrive-installation', 'microsoft-teams-installation', 'red-hat-quay-installation', 'servicenow-installation', 'servicenow-issue-tracking-config', 'sharepoint-online-drive-installation', 'slack-workspace'],
                    ],
                    'instance_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The ID of the integration instance.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_teams' => [
                'class' => GitGuardianListTeams::class,
                'name' => 'List Teams',
                'description' => 'This endpoint allows you to list all the teams of your workspace. The response contains the list of teams and a pagination cursor to retrieve the next page. The teams are sorted by id. If you are using a personal access token, you need to have an access level superior or equal to `member`.

Official GitGuardian endpoint: GET /v1/teams.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'is_global' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'is_global',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'linked_to_an_external_provider' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'linked_to_an_external_provider',
                    ],
                ],
            ],
            'gitguardian_create_teams' => [
                'class' => GitGuardianCreateTeams::class,
                'name' => 'Create Teams',
                'description' => 'This endpoint allows you to create a team. If you are using a personal access token, you need to have an access level superior or equal to `manager`. If a personal access token is being used, the member is automatically added to the created team with permissions `can_manage` and `full_access`

Official GitGuardian endpoint: POST /v1/teams.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_retrieve_team' => [
                'class' => GitGuardianRetrieveTeam::class,
                'name' => 'Retrieve Team',
                'description' => 'Retrieve an existing team. If you are using a personal access token, you need to have an access level greater or equal to `member`.

Official GitGuardian endpoint: GET /v1/teams/{team_id}.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                ],
            ],
            'gitguardian_delete_team' => [
                'class' => GitGuardianDeleteTeam::class,
                'name' => 'Delete Team',
                'description' => 'Delete an existing team. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager. The "All-incidents" team (is_global=true) cannot be deleted.

Official GitGuardian endpoint: DELETE /v1/teams/{team_id}.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                ],
            ],
            'gitguardian_update_team' => [
                'class' => GitGuardianUpdateTeam::class,
                'name' => 'Update Team',
                'description' => 'Update a team\'s name and/or its description. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager. The "All-incidents" team (is_global=true) cannot be updated.

Official GitGuardian endpoint: PATCH /v1/teams/{team_id}.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_team_incidents' => [
                'class' => GitGuardianListTeamIncidents::class,
                'name' => 'List Team Incidents',
                'description' => 'List secret incidents of a particular team. Occurrences are not returned in this route. DEPRECATED: THis endpoint has been replaced by [/v1/teams/{team_id}/secret-incidents](#tag/Teams/operation/list-team-secret-incident-access)

Official GitGuardian endpoint: GET /v1/teams/{team_id}/incidents/secrets.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'date_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_before',
                    ],
                    'date_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_after',
                    ],
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'assignee_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'assignee_email',
                    ],
                    'assignee_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'assignee_id',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                    ],
                    'severity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'severity',
                    ],
                    'validity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'validity',
                    ],
                    'tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'tags',
                    ],
                    'custom_tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tags',
                    ],
                    'custom_tag_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tag_key',
                    ],
                    'custom_tag_value' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tag_value',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['date', '-date', 'resolved_at', '-resolved_at', 'ignored_at', '-ignored_at'],
                    ],
                    'detector_group_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'detector_group_name',
                    ],
                    'ignorer_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'ignorer_id',
                    ],
                    'ignorer_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'ignorer_api_token_id',
                    ],
                    'resolver_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'resolver_id',
                    ],
                    'resolver_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'resolver_api_token_id',
                    ],
                    'only_on_provider_archived_sources' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'only_on_provider_archived_sources',
                    ],
                ],
            ],
            'gitguardian_get_team_resource_access' => [
                'class' => GitGuardianGetTeamResourceAccess::class,
                'name' => 'Get Team Resource Access',
                'description' => 'Return the permission a team has on a resource. For the global team, it will always be the highest possible permission.

Official GitGuardian endpoint: GET /v1/teams/{team_id}/{resource_type}/{resource_id}.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'resource_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The kind of resource of the access',
                        'enum' => ['secret-incidents'],
                    ],
                    'resource_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the resource of the access',
                    ],
                ],
            ],
            'gitguardian_set_team_resource_access' => [
                'class' => GitGuardianSetTeamResourceAccess::class,
                'name' => 'Set Team Resource Access',
                'description' => 'This will create or update a direct access for the team on the resource. If the access to the resource is already given by the team\'s perimeter, an error is raised. This endpoint is not allowed for the global team.

Official GitGuardian endpoint: PUT /v1/teams/{team_id}/{resource_type}/{resource_id}.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'resource_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The kind of resource of the access',
                        'enum' => ['secret-incidents'],
                    ],
                    'resource_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the resource of the access',
                    ],
                    'send_email' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to notify the team members about the access.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_revoke_team_resource_access' => [
                'class' => GitGuardianRevokeTeamResourceAccess::class,
                'name' => 'Revoke Team Resource Access',
                'description' => 'Revoke the access a team has to a resource. This only works for direct accesses. If the access to the resource is given by the team\'s perimeter, an error is raised. This endpoint is not allowed for the global team.

Official GitGuardian endpoint: DELETE /v1/teams/{team_id}/{resource_type}/{resource_id}.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'resource_type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The kind of resource of the access',
                        'enum' => ['secret-incidents'],
                    ],
                    'resource_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the resource of the access',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_team_secret_incident_access' => [
                'class' => GitGuardianListTeamSecretIncidentAccess::class,
                'name' => 'List Team Secret Incident Access',
                'description' => 'List secret incidents that a team has access to.

Official GitGuardian endpoint: GET /v1/teams/{team_id}/secret-incidents.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Page number.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'date_before' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_before',
                    ],
                    'date_after' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'date_after',
                    ],
                    'assignee_email' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'assignee_email',
                    ],
                    'assignee_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'assignee_id',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                    ],
                    'severity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'severity',
                    ],
                    'validity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'validity',
                    ],
                    'tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'tags',
                    ],
                    'custom_tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tags',
                    ],
                    'custom_tag_key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tag_key',
                    ],
                    'custom_tag_value' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'custom_tag_value',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['date', '-date', 'resolved_at', '-resolved_at', 'ignored_at', '-ignored_at'],
                    ],
                    'detector_group_name' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'detector_group_name',
                    ],
                    'ignorer_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'ignorer_id',
                    ],
                    'ignorer_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'ignorer_api_token_id',
                    ],
                    'resolver_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'resolver_id',
                    ],
                    'resolver_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'resolver_api_token_id',
                    ],
                    'feedback' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'feedback',
                    ],
                    'only_on_provider_archived_sources' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'only_on_provider_archived_sources',
                    ],
                ],
            ],
            'gitguardian_list_team_invitation' => [
                'class' => GitGuardianListTeamInvitation::class,
                'name' => 'List Team Invitation',
                'description' => 'List all existing team invitations. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: GET /v1/teams/{team_id}/team_invitations.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'invitation_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The id of an invitation to filter on',
                    ],
                    'is_team_leader' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'is_team_leader',
                    ],
                    'team_permission' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'team_permission',
                    ],
                    'incident_permission' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'incident_permission',
                    ],
                ],
            ],
            'gitguardian_create_team_invitations' => [
                'class' => GitGuardianCreateTeamInvitations::class,
                'name' => 'Create Team Invitations',
                'description' => 'This endpoint allows you to create a team invitation from an existing team and invitation. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: POST /v1/teams/{team_id}/team_invitations.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_update_team_invitation' => [
                'class' => GitGuardianUpdateTeamInvitation::class,
                'name' => 'Update Team Invitation',
                'description' => 'Update permissions of a team invitation. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: PATCH /v1/teams/{team_id}/team_invitations/{team_invitation_id}.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'team_invitation_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team invitation',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_delete_team_invitation' => [
                'class' => GitGuardianDeleteTeamInvitation::class,
                'name' => 'Delete Team Invitation',
                'description' => 'Delete an existing team invitation. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: DELETE /v1/teams/{team_id}/team_invitations/{team_invitation_id}.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'team_invitation_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team invitation',
                    ],
                ],
            ],
            'gitguardian_list_team_memberships' => [
                'class' => GitGuardianListTeamMemberships::class,
                'name' => 'List Team Memberships',
                'description' => 'List all the memberships of a team. If you are using a personal access token, you need to be a workspace manager or be part of the team.

Official GitGuardian endpoint: GET /v1/teams/{team_id}/team_memberships.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'is_team_leader' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'is_team_leader',
                    ],
                    'team_permission' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'team_permission',
                    ],
                    'incident_permission' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'incident_permission',
                    ],
                    'member_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'member_id',
                    ],
                ],
            ],
            'gitguardian_create_team_membership' => [
                'class' => GitGuardianCreateTeamMembership::class,
                'name' => 'Create Team Membership',
                'description' => 'Add a member to a team. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: POST /v1/teams/{team_id}/team_memberships.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'send_email' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to notify the member about the team membership.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_update_team_membership' => [
                'class' => GitGuardianUpdateTeamMembership::class,
                'name' => 'Update Team Membership',
                'description' => 'Update permissions of a team membership. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: PATCH /v1/teams/{team_id}/team_memberships/{team_membership_id}.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'team_membership_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team membership',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_delete_team_membership' => [
                'class' => GitGuardianDeleteTeamMembership::class,
                'name' => 'Delete Team Membership',
                'description' => 'Remove a member from a team. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager, or be the member being removed.

Official GitGuardian endpoint: DELETE /v1/teams/{team_id}/team_memberships/{team_membership_id}.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'team_membership_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team membership',
                    ],
                    'send_email' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to notify the member about the removal from the team.',
                    ],
                ],
            ],
            'gitguardian_list_member_team_memberships' => [
                'class' => GitGuardianListMemberTeamMemberships::class,
                'name' => 'List Member Team Memberships',
                'description' => 'List team memberships of a workspace member. The response contains the list of team memberships and a pagination cursor to retrieve the next page. The team memberships are sorted by id. If you are using a personal access token, you need to have an access level superior or equal to `manager` except if the requested member is yourself.

Official GitGuardian endpoint: GET /v1/members/{member_id}/team_memberships.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'member_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the workspace member',
                    ],
                    'team_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The id of a team to filter on',
                    ],
                ],
            ],
            'gitguardian_list_team_requests' => [
                'class' => GitGuardianListTeamRequests::class,
                'name' => 'List Team Requests',
                'description' => 'List pending requests of a team. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: GET /v1/teams/{team_id}/team_requests.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'member_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'member_id',
                    ],
                ],
            ],
            'gitguardian_create_team_request' => [
                'class' => GitGuardianCreateTeamRequest::class,
                'name' => 'Create Team Request',
                'description' => 'Create an access request to a team. You must be authenticated via a Personal Access Token. You must not already have a pending request on the team, be a member of the team, be a workspace manager or have the restricted access level.

Official GitGuardian endpoint: POST /v1/teams/{team_id}/team_requests.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_delete_team_request' => [
                'class' => GitGuardianDeleteTeamRequest::class,
                'name' => 'Delete Team Request',
                'description' => 'Cancel or decline a team request. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager, or be the member who created the request being cancelled.

Official GitGuardian endpoint: DELETE /v1/teams/{team_id}/team_requests/{team_request_id}.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'team_request_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team request',
                    ],
                    'send_email' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to notify the member about the request having been denied.',
                    ],
                ],
            ],
            'gitguardian_accept_team_request' => [
                'class' => GitGuardianAcceptTeamRequest::class,
                'name' => 'Accept Team Request',
                'description' => 'Accept a team request by adding the member to the team. If you are using a personal access token, you must have "can manage" permission on the team or be a workspace manager.

Official GitGuardian endpoint: POST /v1/teams/{team_id}/team_requests/{team_request_id}/accept.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'team_request_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team request',
                    ],
                    'send_email' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to notify the member about the request having been accepted.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_member_team_requests' => [
                'class' => GitGuardianListMemberTeamRequests::class,
                'name' => 'List Member Team Requests',
                'description' => 'List pending team requests of a member. If you are using a personal access token, you need to be either a workspace manager or the member being queried.

Official GitGuardian endpoint: GET /v1/members/{member_id}/team_requests.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'member_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the workspace member',
                    ],
                    'team_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'team_id',
                    ],
                ],
            ],
            'gitguardian_list_team_sources' => [
                'class' => GitGuardianListTeamSources::class,
                'name' => 'List Team Sources',
                'description' => 'List sources belonging to a team\'s perimeter.

Official GitGuardian endpoint: GET /v1/teams/{team_id}/sources.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'last_scan_status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'last_scan_status',
                    ],
                    'health' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'health',
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'type',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['last_scan_date', '-last_scan_date'],
                    ],
                    'visibility' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'visibility',
                        'enum' => ['public', 'private', 'internal'],
                    ],
                    'external_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'external_id',
                    ],
                ],
            ],
            'gitguardian_update_team_sources' => [
                'class' => GitGuardianUpdateTeamSources::class,
                'name' => 'Update Team Sources',
                'description' => 'This endpoint allows you to add and remove sources from the perimeter of a team. If you are using a personal access token, you need to be a workspace manager.

Official GitGuardian endpoint: POST /v1/teams/{team_id}/sources.',
                'parameters' => [
                    'team_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The id of the team',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_honeytoken' => [
                'class' => GitGuardianListHoneytoken::class,
                'name' => 'List Honeytoken',
                'description' => 'This endpoint allows you to list all the honeytokens of your workspace. The response contains the list of honeytokens and a pagination cursor to retrieve the next page. The honeytokens are sorted by id. If you are using a personal access token, you need to have an access level superior or equal to `manager`.

Official GitGuardian endpoint: GET /v1/honeytokens.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'status',
                        'enum' => ['triggered', 'active', 'revoked'],
                    ],
                    'type' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'type',
                        'enum' => ['AWS'],
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'creator_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'creator_id',
                    ],
                    'revoker_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'revoker_id',
                    ],
                    'creator_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'creator_api_token_id',
                    ],
                    'revoker_api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'revoker_api_token_id',
                    ],
                    'tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'tags',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['created_at', '-created_at', 'triggered_at', '-triggered_at', 'revoked_at', '-revoked_at', 'name', '-name'],
                    ],
                    'show_token' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'show_token',
                    ],
                    'x_privacy_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'When set to `true`, sensitive values in the response are obfuscated (replaced with `<GG>OBFUSCATED</GG>`). Useful for sharing API responses without exposing sensitive data.',
                        'enum' => ['true', 'false'],
                    ],
                ],
            ],
            'gitguardian_create_honeytoken' => [
                'class' => GitGuardianCreateHoneytoken::class,
                'name' => 'Create Honeytoken',
                'description' => 'This endpoint allows you to create a honeytoken of a type. If you are using a personal access token, you need to have an access level superior or equal to `manager`.

Official GitGuardian endpoint: POST /v1/honeytokens.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_create_honeytoken_with_context' => [
                'class' => GitGuardianCreateHoneytokenWithContext::class,
                'name' => 'Create Honeytoken With Context',
                'description' => 'This endpoint allows you to create a honeytoken of a given type within a context. The context is a realistic file in which your honeytoken is inserted. If `language`, `project_extensions` and `filename` are not provided, a random context will be generated.

Official GitGuardian endpoint: POST /v1/honeytokens/with-context.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_retrieve_honeytoken' => [
                'class' => GitGuardianRetrieveHoneytoken::class,
                'name' => 'Retrieve Honeytoken',
                'description' => 'Retrieve an existing honeytoken. If you are using a personal access token, you need to have an access level greater or equal to `manager`.

Official GitGuardian endpoint: GET /v1/honeytokens/{honeytoken_id}.',
                'parameters' => [
                    'honeytoken_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the honeytoken to retrieve',
                    ],
                    'x_privacy_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'When set to `true`, sensitive values in the response are obfuscated (replaced with `<GG>OBFUSCATED</GG>`). Useful for sharing API responses without exposing sensitive data.',
                        'enum' => ['true', 'false'],
                    ],
                    'show_token' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'show_token',
                    ],
                ],
            ],
            'gitguardian_update_honeytoken' => [
                'class' => GitGuardianUpdateHoneytoken::class,
                'name' => 'Update Honeytoken',
                'description' => 'Update a name or descriptions of an existing honeytoken.

Official GitGuardian endpoint: PATCH /v1/honeytokens/{honeytoken_id}.',
                'parameters' => [
                    'honeytoken_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the honeytoken to retrieve',
                    ],
                    'x_privacy_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'When set to `true`, sensitive values in the response are obfuscated (replaced with `<GG>OBFUSCATED</GG>`). Useful for sharing API responses without exposing sensitive data.',
                        'enum' => ['true', 'false'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_reset_honeytoken' => [
                'class' => GitGuardianResetHoneytoken::class,
                'name' => 'Reset Honeytoken',
                'description' => 'Resets a triggered honeytoken. All the associated events will be closed.

Official GitGuardian endpoint: POST /v1/honeytokens/{honeytoken_id}/reset.',
                'parameters' => [
                    'honeytoken_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the honeytoken to retrieve',
                    ],
                    'x_privacy_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'When set to `true`, sensitive values in the response are obfuscated (replaced with `<GG>OBFUSCATED</GG>`). Useful for sharing API responses without exposing sensitive data.',
                        'enum' => ['true', 'false'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_revoke_honeytoken' => [
                'class' => GitGuardianRevokeHoneytoken::class,
                'name' => 'Revoke Honeytoken',
                'description' => 'Revokes an active or triggered honeytoken. All the associated events will be closed.

Official GitGuardian endpoint: POST /v1/honeytokens/{honeytoken_id}/revoke.',
                'parameters' => [
                    'honeytoken_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the honeytoken to retrieve',
                    ],
                    'x_privacy_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'When set to `true`, sensitive values in the response are obfuscated (replaced with `<GG>OBFUSCATED</GG>`). Useful for sharing API responses without exposing sensitive data.',
                        'enum' => ['true', 'false'],
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_honeytoken_notes' => [
                'class' => GitGuardianListHoneytokenNotes::class,
                'name' => 'List Honeytoken Notes',
                'description' => 'List notes left on a honeytoken in chronological order.

Official GitGuardian endpoint: GET /v1/honeytokens/{honeytoken_id}/notes.',
                'parameters' => [
                    'honeytoken_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the honeytoken to retrieve',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['created_at', '-created_at', 'updated_at', '-updated_at'],
                    ],
                    'member_id' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Filter by member id.',
                    ],
                    'api_token_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Entries matching this API token id.',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                ],
            ],
            'gitguardian_create_honeytoken_note' => [
                'class' => GitGuardianCreateHoneytokenNote::class,
                'name' => 'Create Honeytoken Note',
                'description' => 'Add a note on a honeytoken.

Official GitGuardian endpoint: POST /v1/honeytokens/{honeytoken_id}/notes.',
                'parameters' => [
                    'honeytoken_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the honeytoken to retrieve',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_update_honeytoken_note' => [
                'class' => GitGuardianUpdateHoneytokenNote::class,
                'name' => 'Update Honeytoken Note',
                'description' => 'Update an existing comment on a honeytoken. Only honeytoken notes created by the current API key can be updated.

Official GitGuardian endpoint: PATCH /v1/honeytokens/{honeytoken_id}/notes/{note_id}.',
                'parameters' => [
                    'honeytoken_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the honeytoken to retrieve',
                    ],
                    'note_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the honeytoken note to update',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_delete_honeytoken_note' => [
                'class' => GitGuardianDeleteHoneytokenNote::class,
                'name' => 'Delete Honeytoken Note',
                'description' => 'Delete an existing comment on a honeytoken. Only honeytoken notes created by the current API key can be deleted.

Official GitGuardian endpoint: DELETE /v1/honeytokens/{honeytoken_id}/notes/{note_id}.',
                'parameters' => [
                    'honeytoken_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the honeytoken to retrieve',
                    ],
                    'note_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the honeytoken note to update',
                    ],
                ],
            ],
            'gitguardian_list_honeytoken_sources' => [
                'class' => GitGuardianListHoneytokenSources::class,
                'name' => 'List Honeytoken Sources',
                'description' => 'List sources where a honeytoken appears.

Official GitGuardian endpoint: GET /v1/honeytokens/{honeytoken_id}/sources.',
                'parameters' => [
                    'honeytoken_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the honeytoken to retrieve',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['source_id', '-source_id'],
                    ],
                    'provider_metadata_archived' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'provider_metadata_archived',
                    ],
                ],
            ],
            'gitguardian_check_honeytoken_prefixes' => [
                'class' => GitGuardianCheckHoneytokenPrefixes::class,
                'name' => 'Check Honeytoken Prefixes',
                'description' => 'Bulk prefix lookup for honeytoken HMSL hashes

Official GitGuardian endpoint: POST /v1/honeytokens/prefixes.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_list_honeytokens_events' => [
                'class' => GitGuardianListHoneytokensEvents::class,
                'name' => 'List Honeytokens Events',
                'description' => 'List events related to all honeytokens of the workspace.

Official GitGuardian endpoint: GET /v1/honeytokens_events.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'',
                        'enum' => ['triggered_at', '-triggered_at'],
                    ],
                    'honeytoken_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter by honeytoken id',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter by status',
                        'enum' => ['open', 'archived', 'allowed'],
                    ],
                    'ip_address' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter by ip address',
                    ],
                    'tags' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'tags',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Search events based on the `data` field content',
                    ],
                    'x_privacy_mode' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'When set to `true`, sensitive values in the response are obfuscated (replaced with `<GG>OBFUSCATED</GG>`). Useful for sharing API responses without exposing sensitive data.',
                        'enum' => ['true', 'false'],
                    ],
                ],
            ],
            'gitguardian_list_ip_allowlist' => [
                'class' => GitGuardianListIpAllowlist::class,
                'name' => 'List IP Allowlist',
                'description' => 'This endpoint allows you to list all the IP allowlist rules of your workspace. The response contains the list of IP allowlist rules and a pagination cursor to retrieve the next page. If you are using a personal access token, you need to have an access level superior or equal to `manager`.

Official GitGuardian endpoint: GET /v1/ip-allowlist.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'search' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'search',
                    ],
                    'ordering' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Sort the results by their field value. The default sort is ASC, DESC if the field is preceded by a \'-\'.',
                        'enum' => ['created_at', '-created_at', 'tag', '-tag'],
                    ],
                ],
            ],
            'gitguardian_create_ip_allowlist' => [
                'class' => GitGuardianCreateIpAllowlist::class,
                'name' => 'Create IP Allowlist',
                'description' => 'This endpoint allows you to create an IP allowlist rule. If you are using a personal access token, you need to have an access level superior or equal to `manager`.

Official GitGuardian endpoint: POST /v1/ip-allowlist.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_retrieve_ipallowlist' => [
                'class' => GitGuardianRetrieveIpallowlist::class,
                'name' => 'Retrieve Ipallowlist',
                'description' => 'Retrieve an existing IP allowlist rule. If you are using a personal access token, you need to have an access level greater or equal to `manager`.

Official GitGuardian endpoint: GET /v1/ip-allowlist/{ip_allowlist_rule_id}.',
                'parameters' => [
                    'ip_allowlist_rule_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the IP allowlist rule',
                    ],
                ],
            ],
            'gitguardian_update_ipallowlist' => [
                'class' => GitGuardianUpdateIpallowlist::class,
                'name' => 'Update Ipallowlist',
                'description' => 'Update the tag or the IP ranges of an existing IP allowlist rule.

Official GitGuardian endpoint: PATCH /v1/ip-allowlist/{ip_allowlist_rule_id}.',
                'parameters' => [
                    'ip_allowlist_rule_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the IP allowlist rule',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_delete_ipallowlist' => [
                'class' => GitGuardianDeleteIpallowlist::class,
                'name' => 'Delete Ipallowlist',
                'description' => 'Delete an existing IP allowlist rule.

Official GitGuardian endpoint: DELETE /v1/ip-allowlist/{ip_allowlist_rule_id}.',
                'parameters' => [
                    'ip_allowlist_rule_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the IP allowlist rule',
                    ],
                ],
            ],
            'gitguardian_list_ip_addresses' => [
                'class' => GitGuardianListIpAddresses::class,
                'name' => 'List IP Addresses',
                'description' => 'Get GitGuardian\'s egress IP addresses for IP allowlisting. Use these IP addresses to configure access controls and allow GitGuardian services to access your resources. This includes: - Firewall rules - Application-level IP allowlists - Network security groups - Proxy configurations - VPN allowlists

Official GitGuardian endpoint: GET /v1/ips.',
                'parameters' => [],
            ],
            'gitguardian_scim_user_create' => [
                'class' => GitGuardianScimUserCreate::class,
                'name' => 'SCIM User Create',
                'description' => 'Create a new workspace member (using SCIM Protocol).

Official GitGuardian endpoint: POST /v1/scim/v2/Users.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_scim_user_list' => [
                'class' => GitGuardianScimUserList::class,
                'name' => 'SCIM User List',
                'description' => 'List members of the workspace (using SCIM Protocol).

Official GitGuardian endpoint: GET /v1/scim/v2/Users.',
                'parameters' => [
                    'filter' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter users using SCIM filtering DSL.',
                    ],
                    'start_index' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The 1-based index of the first result in the current set of list results.',
                    ],
                    'count' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Specifies the desired maximum number of query results per page.',
                    ],
                ],
            ],
            'gitguardian_scim_user_detail' => [
                'class' => GitGuardianScimUserDetail::class,
                'name' => 'SCIM User Detail',
                'description' => 'Detail of a workspace member (using SCIM Protocol).

Official GitGuardian endpoint: GET /v1/scim/v2/Users/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'gitguardian_scim_user_update' => [
                'class' => GitGuardianScimUserUpdate::class,
                'name' => 'SCIM User Update',
                'description' => 'Update of a workspace member (using SCIM Protocol).

Official GitGuardian endpoint: PUT /v1/scim/v2/Users/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_scim_user_partial_update' => [
                'class' => GitGuardianScimUserPartialUpdate::class,
                'name' => 'SCIM User Partial Update',
                'description' => 'Update of a workspace member (using SCIM Protocol).

Official GitGuardian endpoint: PATCH /v1/scim/v2/Users/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_scim_user_delete' => [
                'class' => GitGuardianScimUserDelete::class,
                'name' => 'SCIM User Delete',
                'description' => 'Delete a workspace member (using SCIM Protocol).

Official GitGuardian endpoint: DELETE /v1/scim/v2/Users/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'gitguardian_scim_group_list' => [
                'class' => GitGuardianScimGroupList::class,
                'name' => 'SCIM Group List',
                'description' => 'List groups (teams in GIM) of the workspace using the SCIM Protocol.

Official GitGuardian endpoint: GET /v1/scim/v2/Groups.',
                'parameters' => [
                    'filter' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter groups using the SCIM filtering DSL.',
                    ],
                    'start_index' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'The 1-based index of the first result in the current set of list results.',
                    ],
                    'count' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Specifies the desired maximum number of query results per page.',
                    ],
                ],
            ],
            'gitguardian_scim_group_create' => [
                'class' => GitGuardianScimGroupCreate::class,
                'name' => 'SCIM Group Create',
                'description' => 'Create a new group (team in GIM) using the SCIM Protocol.

Official GitGuardian endpoint: POST /v1/scim/v2/Groups.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_scim_group_detail' => [
                'class' => GitGuardianScimGroupDetail::class,
                'name' => 'SCIM Group Detail',
                'description' => 'Detail of a group (team in GIM) using the SCIM Protocol.

Official GitGuardian endpoint: GET /v1/scim/v2/Groups/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'gitguardian_scim_group_update' => [
                'class' => GitGuardianScimGroupUpdate::class,
                'name' => 'SCIM Group Update',
                'description' => 'Update a group (team in GIM) using the SCIM Protocol.

Official GitGuardian endpoint: PUT /v1/scim/v2/Groups/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_scim_group_partial_update' => [
                'class' => GitGuardianScimGroupPartialUpdate::class,
                'name' => 'SCIM Group Partial Update',
                'description' => 'Partially update a group (team in GIM) using the SCIM Protocol.

Official GitGuardian endpoint: PATCH /v1/scim/v2/Groups/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_scim_group_delete' => [
                'class' => GitGuardianScimGroupDelete::class,
                'name' => 'SCIM Group Delete',
                'description' => 'Delete a group (team in GIM) using the SCIM Protocol.

Official GitGuardian endpoint: DELETE /v1/scim/v2/Groups/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'gitguardian_scim_service_provider_config' => [
                'class' => GitGuardianScimServiceProviderConfig::class,
                'name' => 'SCIM Service Provider Config',
                'description' => 'List the SCIM specification features available on a service provider.

Official GitGuardian endpoint: GET /v1/scim/v2/ServiceProviderConfig.',
                'parameters' => [],
            ],
            'gitguardian_scim_resource_types_list' => [
                'class' => GitGuardianScimResourceTypesList::class,
                'name' => 'SCIM Resource Types List',
                'description' => 'List of Resource Types

Official GitGuardian endpoint: GET /v1/scim/v2/ResourceTypes.',
                'parameters' => [],
            ],
            'gitguardian_scim_resource_types_detail' => [
                'class' => GitGuardianScimResourceTypesDetail::class,
                'name' => 'SCIM Resource Types Detail',
                'description' => 'Detail of a Resource Types

Official GitGuardian endpoint: GET /v1/scim/v2/ResourceTypes/{name}.',
                'parameters' => [
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'name',
                    ],
                ],
            ],
            'gitguardian_scim_schema_list' => [
                'class' => GitGuardianScimSchemaList::class,
                'name' => 'SCIM Schema List',
                'description' => 'List of SCIM Schemas

Official GitGuardian endpoint: GET /v1/scim/v2/Schemas.',
                'parameters' => [],
            ],
            'gitguardian_scim_schema_detail' => [
                'class' => GitGuardianScimSchemaDetail::class,
                'name' => 'SCIM Schema Detail',
                'description' => 'Detail of a Schema

Official GitGuardian endpoint: GET /v1/scim/v2/Schemas/{name}.',
                'parameters' => [
                    'name' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'name',
                    ],
                ],
            ],
            'gitguardian_list_custom_tags' => [
                'class' => GitGuardianListCustomTags::class,
                'name' => 'List Custom Tags',
                'description' => 'List all existing custom tags.

Official GitGuardian endpoint: GET /v1/custom_tags.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination cursor.',
                    ],
                    'per_page' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of items to list per page.',
                    ],
                    'key' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'key',
                    ],
                ],
            ],
            'gitguardian_create_custom_tag' => [
                'class' => GitGuardianCreateCustomTag::class,
                'name' => 'Create Custom Tag',
                'description' => 'This endpoint allows you to create a custom tag.

Official GitGuardian endpoint: POST /v1/custom_tags.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_update_custom_tags_key' => [
                'class' => GitGuardianUpdateCustomTagsKey::class,
                'name' => 'Update Custom Tags Key',
                'description' => 'This endpoint allows you to update a key for all custom tags using it.

Official GitGuardian endpoint: PATCH /v1/custom_tags.',
                'parameters' => [
                    'old_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'old_key',
                    ],
                    'new_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'new_key',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_delete_custom_tags_key' => [
                'class' => GitGuardianDeleteCustomTagsKey::class,
                'name' => 'Delete Custom Tags Key',
                'description' => 'This endpoint allows you to delete all custom tags using the given key.

Official GitGuardian endpoint: DELETE /v1/custom_tags.',
                'parameters' => [
                    'key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'key',
                    ],
                ],
            ],
            'gitguardian_get_custom_tag' => [
                'class' => GitGuardianGetCustomTag::class,
                'name' => 'Get Custom Tag',
                'description' => 'This endpoint allows you to retrieve an existing custom tag.

Official GitGuardian endpoint: GET /v1/custom_tags/{custom_tag_id}.',
                'parameters' => [
                    'custom_tag_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the custom tag',
                    ],
                ],
            ],
            'gitguardian_update_custom_tag' => [
                'class' => GitGuardianUpdateCustomTag::class,
                'name' => 'Update Custom Tag',
                'description' => 'This endpoint allows you to update a specific custom tag. It replaces the entire custom tag (key and value). This does not impact other custom tags sharing the same key.

Official GitGuardian endpoint: PUT /v1/custom_tags/{custom_tag_id}.',
                'parameters' => [
                    'custom_tag_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the custom tag',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_partial_update_custom_tag' => [
                'class' => GitGuardianPartialUpdateCustomTag::class,
                'name' => 'Partial Update Custom Tag',
                'description' => 'This endpoint allows you to partially update a specific custom tag. It updates only the specified fields (key or value), leaving the other fields unchanged. This does not impact other custom tags sharing the same key.

Official GitGuardian endpoint: PATCH /v1/custom_tags/{custom_tag_id}.',
                'parameters' => [
                    'custom_tag_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the custom tag',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official GitGuardian OpenAPI schema.',
                    ],
                ],
            ],
            'gitguardian_delete_custom_tag' => [
                'class' => GitGuardianDeleteCustomTag::class,
                'name' => 'Delete Custom Tag',
                'description' => 'This endpoint allows you to delete a specific custom tag. This does not impact other custom tags sharing the same key.

Official GitGuardian endpoint: DELETE /v1/custom_tags/{custom_tag_id}.',
                'parameters' => [
                    'custom_tag_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The id of the custom tag',
                    ],
                ],
            ],
        ]; }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): GitGuardianService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GitGuardianService(apiKey: $creds->get('gitguardian', 'api_key', '', $account), baseUrl: $creds->get('gitguardian', 'url', 'https://api.gitguardian.com', $account));
        }

        return app(GitGuardianService::class);
    }

    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/gitguardian.md'; }
    public function isIntegration(): bool { return true; }
}
