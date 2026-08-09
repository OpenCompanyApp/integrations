<?php

namespace OpenCompany\Integrations\Strava;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Strava\Tools\StravaApiDelete;
use OpenCompany\Integrations\Strava\Tools\StravaApiGet;
use OpenCompany\Integrations\Strava\Tools\StravaApiPost;
use OpenCompany\Integrations\Strava\Tools\StravaApiPut;
use OpenCompany\Integrations\Strava\Tools\StravaCreateActivity;
use OpenCompany\Integrations\Strava\Tools\StravaExploreSegments;
use OpenCompany\Integrations\Strava\Tools\StravaExportRoute;
use OpenCompany\Integrations\Strava\Tools\StravaGetActivity;
use OpenCompany\Integrations\Strava\Tools\StravaGetActivityStreams;
use OpenCompany\Integrations\Strava\Tools\StravaGetActivityZones;
use OpenCompany\Integrations\Strava\Tools\StravaGetAthlete;
use OpenCompany\Integrations\Strava\Tools\StravaGetAthleteStats;
use OpenCompany\Integrations\Strava\Tools\StravaGetAthleteZones;
use OpenCompany\Integrations\Strava\Tools\StravaGetClub;
use OpenCompany\Integrations\Strava\Tools\StravaGetCurrentUser;
use OpenCompany\Integrations\Strava\Tools\StravaGetRoute;
use OpenCompany\Integrations\Strava\Tools\StravaGetRouteStreams;
use OpenCompany\Integrations\Strava\Tools\StravaGetSegment;
use OpenCompany\Integrations\Strava\Tools\StravaGetSegmentEffort;
use OpenCompany\Integrations\Strava\Tools\StravaGetSegmentStreams;
use OpenCompany\Integrations\Strava\Tools\StravaGetUpload;
use OpenCompany\Integrations\Strava\Tools\StravaListActivities;
use OpenCompany\Integrations\Strava\Tools\StravaListActivityLaps;
use OpenCompany\Integrations\Strava\Tools\StravaListClubActivities;
use OpenCompany\Integrations\Strava\Tools\StravaListClubMembers;
use OpenCompany\Integrations\Strava\Tools\StravaListClubs;
use OpenCompany\Integrations\Strava\Tools\StravaListRoutes;
use OpenCompany\Integrations\Strava\Tools\StravaListSegmentEfforts;
use OpenCompany\Integrations\Strava\Tools\StravaListStarredSegments;
use OpenCompany\Integrations\Strava\Tools\StravaStarSegment;
use OpenCompany\Integrations\Strava\Tools\StravaUpdateActivity;
use OpenCompany\Integrations\Strava\Tools\StravaUploadActivity;

/**
 * Tool catalog and setup metadata for the Strava integration.
 *
 * Exposes athletes, activities, clubs, routes, streams, segments, uploads,
 * and generic relative API helpers.
 */
class StravaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    /**
     * The application name used for registration and credential resolution.
     */
    public function appName(): string
    {
        return 'strava';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Strava',
            'description' => 'Fitness activities, routes, clubs, and segments',
            'icon' => 'ph:bicycle',
            'logo' => 'simple-icons:strava',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Strava',
            'description' => 'Fitness activity platform for athletes, routes, clubs, streams, and segments',
            'icon' => 'ph:bicycle',
            'logo' => 'simple-icons:strava',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developers.strava.com/docs/reference/',
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
                'placeholder' => 'Enter your Strava access token',
                'hint' => 'Obtain an access token from your Strava API application settings at <a href="https://www.strava.com/settings/api" target="_blank">strava.com/settings/api</a>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://www.strava.com/api/v3',
                'hint' => 'The Strava API base URL. Change only if using a proxy or custom endpoint.',
                'default' => 'https://www.strava.com/api/v3',
            ],
        ];
    }

    /**
     * Test the connection to the Strava API using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://www.strava.com/api/v3', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/athlete');

            if ($response->successful()) {
                $athlete = $response->json();
                $name = trim(($athlete['firstname'] ?? '') . ' ' . ($athlete['lastname'] ?? ''));

                return [
                    'success' => true,
                    'message' => "Connected to Strava as {$name}.",
                ];
            }

            $error = $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Strava API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'strava_get_athlete' => [
                'class' => StravaGetAthlete::class,
                'type' => 'read',
                'name' => 'Get Athlete',
                'description' => 'Get the authenticated athlete profile.',
                'icon' => 'ph:user',
            ],
            'strava_get_current_user' => [
                'class' => StravaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Strava user profile.',
                'icon' => 'ph:user',
            ],
            'strava_get_athlete_stats' => [
                'class' => StravaGetAthleteStats::class,
                'type' => 'read',
                'name' => 'Get Athlete Stats',
                'description' => 'Get activity totals and recent stats for an athlete.',
                'icon' => 'ph:chart-line',
            ],
            'strava_get_athlete_zones' => [
                'class' => StravaGetAthleteZones::class,
                'type' => 'read',
                'name' => 'Get Athlete Zones',
                'description' => 'Get heart rate and power zones for the authenticated athlete.',
                'icon' => 'ph:heartbeat',
            ],
            'strava_list_activities' => [
                'class' => StravaListActivities::class,
                'type' => 'read',
                'name' => 'List Activities',
                'description' => 'List recent activities for the authenticated Strava athlete. Supports pagination and date filtering with before/after Unix timestamps.',
                'icon' => 'ph:list-bullets',
            ],
            'strava_get_activity' => [
                'class' => StravaGetActivity::class,
                'type' => 'read',
                'name' => 'Get Activity',
                'description' => 'Get detailed information about a specific Strava activity.',
                'icon' => 'ph:person-simple-run',
            ],
            'strava_create_activity' => [
                'class' => StravaCreateActivity::class,
                'type' => 'write',
                'name' => 'Create Activity',
                'description' => 'Create a manual activity on Strava.',
                'icon' => 'ph:plus-circle',
            ],
            'strava_update_activity' => [
                'class' => StravaUpdateActivity::class,
                'type' => 'write',
                'name' => 'Update Activity',
                'description' => 'Update editable fields on a Strava activity.',
                'icon' => 'ph:pencil-simple',
            ],
            'strava_get_activity_streams' => [
                'class' => StravaGetActivityStreams::class,
                'type' => 'read',
                'name' => 'Get Activity Streams',
                'description' => 'Get activity stream data such as time, distance, latlng, altitude, heart rate, or power.',
                'icon' => 'ph:wave-sine',
            ],
            'strava_list_activity_laps' => [
                'class' => StravaListActivityLaps::class,
                'type' => 'read',
                'name' => 'List Activity Laps',
                'description' => 'List laps for a Strava activity.',
                'icon' => 'ph:timer',
            ],
            'strava_get_activity_zones' => [
                'class' => StravaGetActivityZones::class,
                'type' => 'read',
                'name' => 'Get Activity Zones',
                'description' => 'Get heart rate and power zone distributions for an activity.',
                'icon' => 'ph:heartbeat',
            ],
            'strava_upload_activity' => [
                'class' => StravaUploadActivity::class,
                'type' => 'write',
                'name' => 'Upload Activity',
                'description' => 'Upload a FIT, TCX, or GPX activity file for asynchronous processing.',
                'icon' => 'ph:upload-simple',
            ],
            'strava_get_upload' => [
                'class' => StravaGetUpload::class,
                'type' => 'read',
                'name' => 'Get Upload',
                'description' => 'Get upload processing status.',
                'icon' => 'ph:cloud-check',
            ],
            'strava_list_clubs' => [
                'class' => StravaListClubs::class,
                'type' => 'read',
                'name' => 'List Clubs',
                'description' => 'List clubs the authenticated Strava athlete belongs to. Returns club names, member counts, and sport types.',
                'icon' => 'ph:users-three',
            ],
            'strava_get_club' => [
                'class' => StravaGetClub::class,
                'type' => 'read',
                'name' => 'Get Club',
                'description' => 'Get details for a Strava club.',
                'icon' => 'ph:users-three',
            ],
            'strava_list_club_activities' => [
                'class' => StravaListClubActivities::class,
                'type' => 'read',
                'name' => 'List Club Activities',
                'description' => 'List recent activities from members of a club.',
                'icon' => 'ph:list-bullets',
            ],
            'strava_list_club_members' => [
                'class' => StravaListClubMembers::class,
                'type' => 'read',
                'name' => 'List Club Members',
                'description' => 'List athletes who are members of a club.',
                'icon' => 'ph:users',
            ],
            'strava_list_routes' => [
                'class' => StravaListRoutes::class,
                'type' => 'read',
                'name' => 'List Routes',
                'description' => 'List routes for a Strava athlete.',
                'icon' => 'ph:map-trifold',
            ],
            'strava_get_route' => [
                'class' => StravaGetRoute::class,
                'type' => 'read',
                'name' => 'Get Route',
                'description' => 'Get a Strava route by ID.',
                'icon' => 'ph:map-pin',
            ],
            'strava_export_route' => [
                'class' => StravaExportRoute::class,
                'type' => 'read',
                'name' => 'Export Route',
                'description' => 'Export a Strava route as GPX or TCX.',
                'icon' => 'ph:download-simple',
            ],
            'strava_get_route_streams' => [
                'class' => StravaGetRouteStreams::class,
                'type' => 'read',
                'name' => 'Get Route Streams',
                'description' => 'Get coordinate and elevation streams for a Strava route.',
                'icon' => 'ph:wave-sine',
            ],
            'strava_list_starred_segments' => [
                'class' => StravaListStarredSegments::class,
                'type' => 'read',
                'name' => 'List Starred Segments',
                'description' => 'List starred segments for the authenticated athlete.',
                'icon' => 'ph:star',
            ],
            'strava_get_segment' => [
                'class' => StravaGetSegment::class,
                'type' => 'read',
                'name' => 'Get Segment',
                'description' => 'Get a Strava segment by ID.',
                'icon' => 'ph:flag',
            ],
            'strava_star_segment' => [
                'class' => StravaStarSegment::class,
                'type' => 'write',
                'name' => 'Star Segment',
                'description' => 'Star or unstar a Strava segment.',
                'icon' => 'ph:star',
            ],
            'strava_explore_segments' => [
                'class' => StravaExploreSegments::class,
                'type' => 'read',
                'name' => 'Explore Segments',
                'description' => 'Explore top Strava segments in a bounding box.',
                'icon' => 'ph:map-pin-area',
            ],
            'strava_list_segment_efforts' => [
                'class' => StravaListSegmentEfforts::class,
                'type' => 'read',
                'name' => 'List Segment Efforts',
                'description' => 'List efforts for the authenticated athlete on a segment.',
                'icon' => 'ph:list-bullets',
            ],
            'strava_get_segment_effort' => [
                'class' => StravaGetSegmentEffort::class,
                'type' => 'read',
                'name' => 'Get Segment Effort',
                'description' => 'Get a Strava segment effort by ID.',
                'icon' => 'ph:gauge',
            ],
            'strava_get_segment_streams' => [
                'class' => StravaGetSegmentStreams::class,
                'type' => 'read',
                'name' => 'Get Segment Streams',
                'description' => 'Get stream data for a Strava segment.',
                'icon' => 'ph:wave-sine',
            ],
            'strava_api_get' => [
                'class' => StravaApiGet::class,
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call a relative Strava API GET endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'strava_api_post' => [
                'class' => StravaApiPost::class,
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call a relative Strava API POST endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'strava_api_put' => [
                'class' => StravaApiPut::class,
                'type' => 'write',
                'name' => 'API PUT',
                'description' => 'Call a relative Strava API PUT endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'strava_api_delete' => [
                'class' => StravaApiDelete::class,
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call a relative Strava API DELETE endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
        ];
    }


    /**
     * Path to the JavaScript API reference documentation.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/strava.md';
    }

    /**
     * Credential fields used for account setup.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://www.strava.com/api/v3'],
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
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the StravaService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): StravaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new StravaService(
                accessToken: $creds->get('strava', 'access_token', '', $account),
                baseUrl: $creds->get('strava', 'url', 'https://www.strava.com/api/v3', $account),
            );
        }

        return app(StravaService::class);
    }
}
