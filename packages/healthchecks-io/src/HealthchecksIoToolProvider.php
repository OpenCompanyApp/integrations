<?php

namespace OpenCompany\Integrations\HealthchecksIo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoListChecks;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoGetCheck;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoCreateCheck;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoUpdateCheck;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoPauseCheck;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoResumeCheck;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoDeleteCheck;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoListPings;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoGetPingBody;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoListFlips;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoListChannels;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoListBadges;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoGetStatus;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoPingSuccessUuid;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoPingStartUuid;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoPingFailUuid;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoPingLogUuid;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoPingExitStatusUuid;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoPingSuccessSlug;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoPingStartSlug;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoPingFailSlug;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoPingLogSlug;
use OpenCompany\Integrations\HealthchecksIo\Tools\HealthchecksIoPingExitStatusSlug;

/**
 * Tool catalog and configuration metadata for Healthchecks.io.
 *
 * Exposes Management API v3 and Pinging API operations as endpoint-specific
 * tools and resolves account-specific API keys for multi-account hosts.
 */
class HealthchecksIoToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'api_key', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => [], 'notes' => ['Management API v3 uses X-Api-Key. Pinging API UUID URLs do not require an API key.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'healthchecks-io'; }
    public function appMeta(): array { return ['label' => 'Healthchecks.io', 'description' => 'Cron checks, pings, flips, badges, integrations, and service status', 'icon' => 'ph:pulse', 'logo' => 'ph:pulse']; }
    public function integrationMeta(): array { return ['name' => 'Healthchecks.io', 'description' => 'Manage Healthchecks.io checks, pings, status flips, integrations/channels, badges, service status, and send success/start/failure/log/exit-status ping signals.', 'icon' => 'ph:pulse', 'logo' => 'ph:pulse', 'category' => 'analytics', 'badge' => 'verified', 'docs_url' => 'https://healthchecks.io/docs/api/']; }
    public function configSchema(): array { return [['key' => 'api_key', 'type' => 'secret', 'label' => 'Project API Key', 'placeholder' => 'Healthchecks.io project API key', 'hint' => 'Sent as X-Api-Key for Management API v3 calls.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'Management API Base URL', 'placeholder' => 'https://healthchecks.io/api/v3', 'default' => 'https://healthchecks.io/api/v3'], ['key' => 'ping_url', 'type' => 'url', 'label' => 'Pinging API Base URL', 'placeholder' => 'https://hc-ping.com', 'default' => 'https://hc-ping.com']]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://healthchecks.io/api/v3'), '/');
        if ($apiKey === '') { return ['success' => false, 'error' => 'Healthchecks.io API key is required.']; }

        try {
            $response = Http::withHeaders(['X-Api-Key' => $apiKey, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl . '/status/');
            if (!$response->successful()) { return ['success' => false, 'error' => 'Healthchecks.io API returned HTTP ' . $response->status() . '.']; }
            return ['success' => true, 'message' => 'Connected to Healthchecks.io at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array { return ['api_key' => 'nullable|string', 'url' => 'nullable|url', 'ping_url' => 'nullable|url']; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function tools(): array { return [
            'healthchecks_io_list_checks' => [
                'class' => HealthchecksIoListChecks::class,
                'name' => 'List Checks',
                'description' => 'List existing checks

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/checks/.',
                'parameters' => [
                    'slug' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'slug query parameter',
                    ],
                    'tag' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'tag query parameter',
                    ],
                ],
            ],
            'healthchecks_io_get_check' => [
                'class' => HealthchecksIoGetCheck::class,
                'name' => 'Get Check',
                'description' => 'Get a single check by UUID or unique key

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/checks/{check_id}.',
                'parameters' => [
                    'check_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'check id path parameter',
                    ],
                ],
            ],
            'healthchecks_io_create_check' => [
                'class' => HealthchecksIoCreateCheck::class,
                'name' => 'Create Check',
                'description' => 'Create a new check

Official Healthchecks.io endpoint: POST https://healthchecks.io/api/v3/checks/.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official Healthchecks.io Management API parameters.',
                    ],
                ],
            ],
            'healthchecks_io_update_check' => [
                'class' => HealthchecksIoUpdateCheck::class,
                'name' => 'Update Check',
                'description' => 'Update an existing check

Official Healthchecks.io endpoint: POST https://healthchecks.io/api/v3/checks/{uuid}.',
                'parameters' => [
                    'uuid' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'uuid path parameter',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'JSON request body matching the official Healthchecks.io Management API parameters.',
                    ],
                ],
            ],
            'healthchecks_io_pause_check' => [
                'class' => HealthchecksIoPauseCheck::class,
                'name' => 'Pause Check',
                'description' => 'Pause monitoring of a check

Official Healthchecks.io endpoint: POST https://healthchecks.io/api/v3/checks/{uuid}/pause.',
                'parameters' => [
                    'uuid' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'uuid path parameter',
                    ],
                ],
            ],
            'healthchecks_io_resume_check' => [
                'class' => HealthchecksIoResumeCheck::class,
                'name' => 'Resume Check',
                'description' => 'Resume monitoring of a check

Official Healthchecks.io endpoint: POST https://healthchecks.io/api/v3/checks/{uuid}/resume.',
                'parameters' => [
                    'uuid' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'uuid path parameter',
                    ],
                ],
            ],
            'healthchecks_io_delete_check' => [
                'class' => HealthchecksIoDeleteCheck::class,
                'name' => 'Delete Check',
                'description' => 'Delete a check

Official Healthchecks.io endpoint: DELETE https://healthchecks.io/api/v3/checks/{uuid}.',
                'parameters' => [
                    'uuid' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'uuid path parameter',
                    ],
                ],
            ],
            'healthchecks_io_list_pings' => [
                'class' => HealthchecksIoListPings::class,
                'name' => 'List Pings',
                'description' => 'List a check\'s logged pings

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/checks/{uuid}/pings/.',
                'parameters' => [
                    'uuid' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'uuid path parameter',
                    ],
                ],
            ],
            'healthchecks_io_get_ping_body' => [
                'class' => HealthchecksIoGetPingBody::class,
                'name' => 'Get Ping Body',
                'description' => 'Get a ping\'s logged body

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/checks/{uuid}/pings/{n}/body.',
                'parameters' => [
                    'uuid' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'uuid path parameter',
                    ],
                    'n' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'n path parameter',
                    ],
                ],
            ],
            'healthchecks_io_list_flips' => [
                'class' => HealthchecksIoListFlips::class,
                'name' => 'List Flips',
                'description' => 'List a check\'s status changes

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/checks/{check_id}/flips/.',
                'parameters' => [
                    'check_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'check id path parameter',
                    ],
                    'seconds' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'seconds query parameter',
                    ],
                    'start' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'start query parameter',
                    ],
                    'end' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'end query parameter',
                    ],
                ],
            ],
            'healthchecks_io_list_channels' => [
                'class' => HealthchecksIoListChannels::class,
                'name' => 'List Channels',
                'description' => 'List existing integrations/channels

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/channels/.',
                'parameters' => [],
            ],
            'healthchecks_io_list_badges' => [
                'class' => HealthchecksIoListBadges::class,
                'name' => 'List Badges',
                'description' => 'List project\'s badges

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/badges/.',
                'parameters' => [],
            ],
            'healthchecks_io_get_status' => [
                'class' => HealthchecksIoGetStatus::class,
                'name' => 'Get Status',
                'description' => 'Check Healthchecks.io database connectivity

Official Healthchecks.io endpoint: GET https://healthchecks.io/api/v3/status/.',
                'parameters' => [],
            ],
            'healthchecks_io_ping_success_uuid' => [
                'class' => HealthchecksIoPingSuccessUuid::class,
                'name' => 'Ping Success UUID',
                'description' => 'Send a success uuid ping signal

Official Healthchecks.io endpoint: POST https://hc-ping.com/{uuid}.',
                'parameters' => [
                    'uuid' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'uuid path parameter',
                    ],
                    'rid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'rid query parameter',
                    ],
                    'http_method' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Ping request method: HEAD, GET, or POST. Defaults to POST.',
                        'enum' => ['HEAD', 'GET', 'POST'],
                    ],
                    'body_text' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional diagnostic text body for POST ping requests.',
                    ],
                ],
            ],
            'healthchecks_io_ping_start_uuid' => [
                'class' => HealthchecksIoPingStartUuid::class,
                'name' => 'Ping Start UUID',
                'description' => 'Send a start uuid ping signal

Official Healthchecks.io endpoint: POST https://hc-ping.com/{uuid}/start.',
                'parameters' => [
                    'uuid' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'uuid path parameter',
                    ],
                    'rid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'rid query parameter',
                    ],
                    'http_method' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Ping request method: HEAD, GET, or POST. Defaults to POST.',
                        'enum' => ['HEAD', 'GET', 'POST'],
                    ],
                    'body_text' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional diagnostic text body for POST ping requests.',
                    ],
                ],
            ],
            'healthchecks_io_ping_fail_uuid' => [
                'class' => HealthchecksIoPingFailUuid::class,
                'name' => 'Ping Fail UUID',
                'description' => 'Send a fail uuid ping signal

Official Healthchecks.io endpoint: POST https://hc-ping.com/{uuid}/fail.',
                'parameters' => [
                    'uuid' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'uuid path parameter',
                    ],
                    'rid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'rid query parameter',
                    ],
                    'http_method' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Ping request method: HEAD, GET, or POST. Defaults to POST.',
                        'enum' => ['HEAD', 'GET', 'POST'],
                    ],
                    'body_text' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional diagnostic text body for POST ping requests.',
                    ],
                ],
            ],
            'healthchecks_io_ping_log_uuid' => [
                'class' => HealthchecksIoPingLogUuid::class,
                'name' => 'Ping Log UUID',
                'description' => 'Send a log uuid ping signal

Official Healthchecks.io endpoint: POST https://hc-ping.com/{uuid}/log.',
                'parameters' => [
                    'uuid' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'uuid path parameter',
                    ],
                    'rid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'rid query parameter',
                    ],
                    'http_method' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Ping request method: HEAD, GET, or POST. Defaults to POST.',
                        'enum' => ['HEAD', 'GET', 'POST'],
                    ],
                    'body_text' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional diagnostic text body for POST ping requests.',
                    ],
                ],
            ],
            'healthchecks_io_ping_exit_status_uuid' => [
                'class' => HealthchecksIoPingExitStatusUuid::class,
                'name' => 'Ping Exit Status UUID',
                'description' => 'Send a exit status uuid ping signal

Official Healthchecks.io endpoint: POST https://hc-ping.com/{uuid}/{exit_status}.',
                'parameters' => [
                    'uuid' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'uuid path parameter',
                    ],
                    'exit_status' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'exit status path parameter',
                    ],
                    'rid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'rid query parameter',
                    ],
                    'http_method' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Ping request method: HEAD, GET, or POST. Defaults to POST.',
                        'enum' => ['HEAD', 'GET', 'POST'],
                    ],
                    'body_text' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional diagnostic text body for POST ping requests.',
                    ],
                ],
            ],
            'healthchecks_io_ping_success_slug' => [
                'class' => HealthchecksIoPingSuccessSlug::class,
                'name' => 'Ping Success Slug',
                'description' => 'Send a success slug ping signal

Official Healthchecks.io endpoint: POST https://hc-ping.com/{ping_key}/{slug}.',
                'parameters' => [
                    'ping_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ping key path parameter',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'slug path parameter',
                    ],
                    'rid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'rid query parameter',
                    ],
                    'create' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'create query parameter',
                    ],
                    'http_method' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Ping request method: HEAD, GET, or POST. Defaults to POST.',
                        'enum' => ['HEAD', 'GET', 'POST'],
                    ],
                    'body_text' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional diagnostic text body for POST ping requests.',
                    ],
                ],
            ],
            'healthchecks_io_ping_start_slug' => [
                'class' => HealthchecksIoPingStartSlug::class,
                'name' => 'Ping Start Slug',
                'description' => 'Send a start slug ping signal

Official Healthchecks.io endpoint: POST https://hc-ping.com/{ping_key}/{slug}/start.',
                'parameters' => [
                    'ping_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ping key path parameter',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'slug path parameter',
                    ],
                    'rid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'rid query parameter',
                    ],
                    'create' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'create query parameter',
                    ],
                    'http_method' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Ping request method: HEAD, GET, or POST. Defaults to POST.',
                        'enum' => ['HEAD', 'GET', 'POST'],
                    ],
                    'body_text' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional diagnostic text body for POST ping requests.',
                    ],
                ],
            ],
            'healthchecks_io_ping_fail_slug' => [
                'class' => HealthchecksIoPingFailSlug::class,
                'name' => 'Ping Fail Slug',
                'description' => 'Send a fail slug ping signal

Official Healthchecks.io endpoint: POST https://hc-ping.com/{ping_key}/{slug}/fail.',
                'parameters' => [
                    'ping_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ping key path parameter',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'slug path parameter',
                    ],
                    'rid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'rid query parameter',
                    ],
                    'create' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'create query parameter',
                    ],
                    'http_method' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Ping request method: HEAD, GET, or POST. Defaults to POST.',
                        'enum' => ['HEAD', 'GET', 'POST'],
                    ],
                    'body_text' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional diagnostic text body for POST ping requests.',
                    ],
                ],
            ],
            'healthchecks_io_ping_log_slug' => [
                'class' => HealthchecksIoPingLogSlug::class,
                'name' => 'Ping Log Slug',
                'description' => 'Send a log slug ping signal

Official Healthchecks.io endpoint: POST https://hc-ping.com/{ping_key}/{slug}/log.',
                'parameters' => [
                    'ping_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ping key path parameter',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'slug path parameter',
                    ],
                    'rid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'rid query parameter',
                    ],
                    'create' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'create query parameter',
                    ],
                    'http_method' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Ping request method: HEAD, GET, or POST. Defaults to POST.',
                        'enum' => ['HEAD', 'GET', 'POST'],
                    ],
                    'body_text' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional diagnostic text body for POST ping requests.',
                    ],
                ],
            ],
            'healthchecks_io_ping_exit_status_slug' => [
                'class' => HealthchecksIoPingExitStatusSlug::class,
                'name' => 'Ping Exit Status Slug',
                'description' => 'Send a exit status slug ping signal

Official Healthchecks.io endpoint: POST https://hc-ping.com/{ping_key}/{slug}/{exit_status}.',
                'parameters' => [
                    'ping_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ping key path parameter',
                    ],
                    'slug' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'slug path parameter',
                    ],
                    'exit_status' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'exit status path parameter',
                    ],
                    'rid' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'rid query parameter',
                    ],
                    'create' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'create query parameter',
                    ],
                    'http_method' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Ping request method: HEAD, GET, or POST. Defaults to POST.',
                        'enum' => ['HEAD', 'GET', 'POST'],
                    ],
                    'body_text' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional diagnostic text body for POST ping requests.',
                    ],
                ],
            ],
        ]; }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): HealthchecksIoService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new HealthchecksIoService(apiKey: $creds->get('healthchecks-io', 'api_key', '', $account), baseUrl: $creds->get('healthchecks-io', 'url', 'https://healthchecks.io/api/v3', $account), pingBaseUrl: $creds->get('healthchecks-io', 'ping_url', 'https://hc-ping.com', $account));
        }

        return app(HealthchecksIoService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/healthchecks-io.md'; }
    public function isIntegration(): bool { return true; }
}
