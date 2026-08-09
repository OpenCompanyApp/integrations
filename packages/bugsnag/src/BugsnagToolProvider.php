<?php

namespace OpenCompany\Integrations\Bugsnag;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagApiDelete;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagApiGet;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagApiPatch;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagApiPost;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagCreateOrganizationEventDataRequest;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagCreateProjectEventDataRequest;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagDeleteError;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagGetCollaborator;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagGetCurrentUser;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagGetError;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagGetEvent;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagGetOrganizationEventDataRequest;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagGetProject;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagGetProjectEventDataRequest;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagGetProjectRelease;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagGetProjectTrend;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagGetTeam;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListCollaborators;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListErrorEvents;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListErrors;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListOrganizationProjects;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListOrganizations;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListPivotValues;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListProjectEvents;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListProjectReleases;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListProjects;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListTeams;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagNotifyBuild;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagNotifyError;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagReportSession;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagUpdateError;

/**
 * Tool provider for Bugsnag APIs.
 *
 * Registers tools for Data Access API v2, error reporting, build tracking,
 * session tracking, privacy exports, pivots, trends, and raw API access.
 */
class BugsnagToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_token',
                'legacy_auth_type' => 'api_token',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
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
        return 'bugsnag';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Bugsnag',
            'description' => 'Error monitoring and release stability',
            'icon' => 'ph:bug',
            'logo' => 'simple-icons:bugsnag',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Bugsnag',
            'description' => 'Error monitoring, data access, release tracking, sessions, trends, pivots, and privacy exports.',
            'icon' => 'ph:bug',
            'logo' => 'simple-icons:bugsnag',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.bugsnag.com/api/',
        ];
    }

    public function configSchema(): array
    {
        return [[
            'key' => 'api_token',
            'type' => 'secret',
            'label' => 'API Token',
            'placeholder' => 'Enter your Bugsnag API token',
            'hint' => 'Generate a personal API token in Bugsnag account settings.',
            'required' => true,
        ]];
    }

    /**
     * Test Bugsnag credentials with the user endpoint.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = (string) ($config['api_token'] ?? '');

        if ($apiToken === '') {
            return ['success' => false, 'error' => 'API token is required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'token ' . $apiToken,
                'X-Version' => '2',
            ])->acceptJson()->asJson()->timeout(10)->get('https://api.bugsnag.com/user');

            if ($response->failed()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();

                return ['success' => false, 'error' => is_string($error) ? $error : json_encode($error)];
            }

            $body = $response->json() ?? [];
            $name = trim((string) ($body['name'] ?? $body['email'] ?? $body['id'] ?? 'Bugsnag'));

            return ['success' => true, 'message' => "Connected to Bugsnag as {$name}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_token' => 'nullable|string'];
    }

    public function tools(): array
    {
        return [            'bugsnag_api_get' => [
                'class' => BugsnagApiGet::class,
                'type' => 'read',
                'name' => 'Api Get',
                'description' => 'Call any Bugsnag Data Access API GET endpoint with query parameters.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_api_post' => [
                'class' => BugsnagApiPost::class,
                'type' => 'write',
                'name' => 'Api Post',
                'description' => 'Call any Bugsnag Data Access API POST endpoint with a JSON payload.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_api_patch' => [
                'class' => BugsnagApiPatch::class,
                'type' => 'write',
                'name' => 'Api Patch',
                'description' => 'Call any Bugsnag Data Access API PATCH endpoint with a JSON payload.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_api_delete' => [
                'class' => BugsnagApiDelete::class,
                'type' => 'write',
                'name' => 'Api Delete',
                'description' => 'Call any Bugsnag Data Access API DELETE endpoint with query parameters.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_get_current_user' => [
                'class' => BugsnagGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Bugsnag user.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_list_organizations' => [
                'class' => BugsnagListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List Bugsnag organizations for the authenticated user.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_list_organization_projects' => [
                'class' => BugsnagListOrganizationProjects::class,
                'type' => 'read',
                'name' => 'List Organization Projects',
                'description' => 'List projects for a Bugsnag organization.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_list_projects' => [
                'class' => BugsnagListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List Bugsnag projects visible to the authenticated user.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_get_project' => [
                'class' => BugsnagGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details for a Bugsnag project.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_list_collaborators' => [
                'class' => BugsnagListCollaborators::class,
                'type' => 'read',
                'name' => 'List Collaborators',
                'description' => 'List collaborators for a Bugsnag organization.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_get_collaborator' => [
                'class' => BugsnagGetCollaborator::class,
                'type' => 'read',
                'name' => 'Get Collaborator',
                'description' => 'Get one Bugsnag collaborator.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_list_teams' => [
                'class' => BugsnagListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List Bugsnag teams for an organization.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_get_team' => [
                'class' => BugsnagGetTeam::class,
                'type' => 'read',
                'name' => 'Get Team',
                'description' => 'Get one Bugsnag team.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_list_errors' => [
                'class' => BugsnagListErrors::class,
                'type' => 'read',
                'name' => 'List Errors',
                'description' => 'List errors for a Bugsnag project.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_get_error' => [
                'class' => BugsnagGetError::class,
                'type' => 'read',
                'name' => 'Get Error',
                'description' => 'Get details for a Bugsnag error.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_update_error' => [
                'class' => BugsnagUpdateError::class,
                'type' => 'write',
                'name' => 'Update Error',
                'description' => 'Update a Bugsnag error status or assignment.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_delete_error' => [
                'class' => BugsnagDeleteError::class,
                'type' => 'write',
                'name' => 'Delete Error',
                'description' => 'Delete a Bugsnag error.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_list_error_events' => [
                'class' => BugsnagListErrorEvents::class,
                'type' => 'read',
                'name' => 'List Error Events',
                'description' => 'List events for a specific Bugsnag error.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_list_project_events' => [
                'class' => BugsnagListProjectEvents::class,
                'type' => 'read',
                'name' => 'List Project Events',
                'description' => 'List events for a Bugsnag project.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_get_event' => [
                'class' => BugsnagGetEvent::class,
                'type' => 'read',
                'name' => 'Get Event',
                'description' => 'Get details for a Bugsnag event.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_get_project_trend' => [
                'class' => BugsnagGetProjectTrend::class,
                'type' => 'read',
                'name' => 'Get Project Trend',
                'description' => 'Get time-series trend data for a Bugsnag project.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_list_pivot_values' => [
                'class' => BugsnagListPivotValues::class,
                'type' => 'read',
                'name' => 'List Pivot Values',
                'description' => 'List Bugsnag pivot values for an error.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_list_project_releases' => [
                'class' => BugsnagListProjectReleases::class,
                'type' => 'read',
                'name' => 'List Project Releases',
                'description' => 'List releases for a Bugsnag project.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_get_project_release' => [
                'class' => BugsnagGetProjectRelease::class,
                'type' => 'read',
                'name' => 'Get Project Release',
                'description' => 'Get a Bugsnag project release.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_create_organization_event_data_request' => [
                'class' => BugsnagCreateOrganizationEventDataRequest::class,
                'type' => 'write',
                'name' => 'Create Organization Event Data Request',
                'description' => 'Create an organization-wide event data request for privacy workflows.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_get_organization_event_data_request' => [
                'class' => BugsnagGetOrganizationEventDataRequest::class,
                'type' => 'read',
                'name' => 'Get Organization Event Data Request',
                'description' => 'Get organization event data request status.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_create_project_event_data_request' => [
                'class' => BugsnagCreateProjectEventDataRequest::class,
                'type' => 'write',
                'name' => 'Create Project Event Data Request',
                'description' => 'Create a project event data request for privacy workflows.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_get_project_event_data_request' => [
                'class' => BugsnagGetProjectEventDataRequest::class,
                'type' => 'read',
                'name' => 'Get Project Event Data Request',
                'description' => 'Get project event data request status.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_notify_error' => [
                'class' => BugsnagNotifyError::class,
                'type' => 'write',
                'name' => 'Notify Error',
                'description' => 'Report an error event to the Bugsnag Error Reporting API.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_notify_build' => [
                'class' => BugsnagNotifyBuild::class,
                'type' => 'write',
                'name' => 'Notify Build',
                'description' => 'Notify Bugsnag of a build or release.',
                'icon' => 'ph:bug',
            ],
            'bugsnag_report_session' => [
                'class' => BugsnagReportSession::class,
                'type' => 'write',
                'name' => 'Report Session',
                'description' => 'Report a session to the Bugsnag Session Tracking API.',
                'icon' => 'ph:bug',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/bugsnag.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
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
     * Resolve the Bugsnag service for default or account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): BugsnagService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BugsnagService(
                apiToken: $creds->get('bugsnag', 'api_token', '', $account),
            );
        }

        return app(BugsnagService::class);
    }
}