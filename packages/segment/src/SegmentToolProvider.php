<?php

namespace OpenCompany\Integrations\Segment;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Segment\Tools\SegmentIdentify;
use OpenCompany\Integrations\Segment\Tools\SegmentTrack;
use OpenCompany\Integrations\Segment\Tools\SegmentPage;
use OpenCompany\Integrations\Segment\Tools\SegmentGroup;
use OpenCompany\Integrations\Segment\Tools\SegmentGetWorkspace;
use OpenCompany\Integrations\Segment\Tools\SegmentListSources;
use OpenCompany\Integrations\Segment\Tools\SegmentGetSource;
use OpenCompany\Integrations\Segment\Tools\SegmentGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class SegmentToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
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
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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
        return 'segment';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'identify, track, page, group, workspace, sources',
            'description' => 'Customer data platform',
            'icon' => 'ph:flow-arrow',
            'logo' => 'simple-icons:segment',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Segment',
            'description' => 'Customer data platform for event tracking, user identification, and data routing',
            'icon' => 'ph:flow-arrow',
            'logo' => 'simple-icons:segment',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://segment.com/docs/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'write_key',
                'type' => 'secret',
                'label' => 'Write Key',
                'placeholder' => 'Enter your Segment write key',
                'hint' => 'Find your write key in the Segment dashboard under your source settings',
                'required' => true,
            ],
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Segment API token',
                'hint' => 'Required for workspace and source management. Generate a Personal Access Token in Segment settings.',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.segment.io/v1',
                'hint' => 'Use <code>https://api.segment.io/v1</code> for the default Segment API, or a custom URL for regional endpoints',
                'default' => 'https://api.segment.io/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $writeKey = $config['write_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.segment.io/v1', '/');

        if (empty($writeKey)) {
            return ['success' => false, 'error' => 'No write key provided'];
        }

        try {
            $response = Http::withBasicAuth($writeKey, '')
                ->timeout(10)
                ->post($baseUrl . '/identify', [
                    'userId' => '__connection_test__',
                    'traits' => ['_test' => true],
                ]);

            $json = $response->json();

            if ($json === null && !$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Could not reach Segment API at {$baseUrl}. Check the URL and write key.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Segment API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'write_key' => 'nullable|string',
            'api_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'segment_identify' => [
                'class' => SegmentIdentify::class,
                'type' => 'write',
                'name' => 'Identify User',
                'description' => 'Identify a user with traits in Segment.',
                'icon' => 'ph:identification-badge',
            ],
            'segment_track' => [
                'class' => SegmentTrack::class,
                'type' => 'write',
                'name' => 'Track Event',
                'description' => 'Track a custom event for a user.',
                'icon' => 'ph:lightning',
            ],
            'segment_page' => [
                'class' => SegmentPage::class,
                'type' => 'write',
                'name' => 'Page View',
                'description' => 'Record a page view event.',
                'icon' => 'ph:browser',
            ],
            'segment_group' => [
                'class' => SegmentGroup::class,
                'type' => 'write',
                'name' => 'Group',
                'description' => 'Associate a user with a group.',
                'icon' => 'ph:users-three',
            ],
            'segment_get_workspace' => [
                'class' => SegmentGetWorkspace::class,
                'type' => 'read',
                'name' => 'Get Workspace',
                'description' => 'Get details of a Segment workspace.',
                'icon' => 'ph:buildings',
            ],
            'segment_list_sources' => [
                'class' => SegmentListSources::class,
                'type' => 'read',
                'name' => 'List Sources',
                'description' => 'List sources in a Segment workspace.',
                'icon' => 'ph:list-dashes',
            ],
            'segment_get_source' => [
                'class' => SegmentGetSource::class,
                'type' => 'read',
                'name' => 'Get Source',
                'description' => 'Get details of a Segment source.',
                'icon' => 'ph:database',
            ],
            'segment_get_current_user' => [
                'class' => SegmentGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Segment user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/segment.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'write_key', 'type' => 'secret', 'label' => 'Write Key', 'required' => true],
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.segment.io/v1'],
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

            $service = new SegmentService(
                writeKey: $creds->get('segment', 'write_key', '', $account),
                apiToken: $creds->get('segment', 'api_token', '', $account),
                baseUrl: $creds->get('segment', 'url', 'https://api.segment.io/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(SegmentService::class));
    }
}
