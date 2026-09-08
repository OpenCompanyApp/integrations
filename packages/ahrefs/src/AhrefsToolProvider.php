<?php

namespace OpenCompany\Integrations\Ahrefs;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsApiGet;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsGetBacklinksStats;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsGetDomainRating;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsGetLimitsAndUsage;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsGetMetrics;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsListBacklinks;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsListReferringDomains;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsListOrganicKeywords;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsListPages;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsListAnchors;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsListBrokenBacklinks;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsListLinkedDomains;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsListOrganicCompetitors;
use OpenCompany\Integrations\Ahrefs\Tools\AhrefsListPaidPages;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the Ahrefs integration provider and exposes API v3 tools.
 */
class AhrefsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
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
        return 'ahrefs';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Ahrefs',
            'description' => 'SEO analytics',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:ahrefs',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Ahrefs',
            'description' => 'SEO toolset for backlinks, keyword research, and competitive analysis',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'simple-icons:ahrefs',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.ahrefs.com/docs/api/reference/introduction',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Ahrefs API key',
                'hint' => 'Generate an API key in your Ahrefs account settings under "API"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.ahrefs.com',
                'hint' => 'Use <code>https://api.ahrefs.com</code> for the default Ahrefs API',
                'default' => 'https://api.ahrefs.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.ahrefs.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v3/subscription-info/limits-and-usage');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Ahrefs API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => 'Ahrefs API returned an error: '.($json['error'] ?? $response->body()),
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to Ahrefs API. Subscription: '.($json['limits_and_usage']['subscription'] ?? 'unknown').'.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'ahrefs_list_backlinks' => [
                'class' => AhrefsListBacklinks::class,
                'type' => 'read',
                'name' => 'List Backlinks',
                'description' => 'List backlinks pointing to a target.',
                'icon' => 'ph:link',
            ],
            'ahrefs_list_referring_domains' => [
                'class' => AhrefsListReferringDomains::class,
                'type' => 'read',
                'name' => 'List Referring Domains',
                'description' => 'List domains that link to a target.',
                'icon' => 'ph:globe',
            ],
            'ahrefs_list_organic_keywords' => [
                'class' => AhrefsListOrganicKeywords::class,
                'type' => 'read',
                'name' => 'List Organic Keywords',
                'description' => 'List organic keywords a target ranks for.',
                'icon' => 'ph:magnifying-glass',
            ],
            'ahrefs_list_pages' => [
                'class' => AhrefsListPages::class,
                'type' => 'read',
                'name' => 'List Pages',
                'description' => 'List top pages for a target.',
                'icon' => 'ph:file',
            ],
            'ahrefs_get_metrics' => [
                'class' => AhrefsGetMetrics::class,
                'type' => 'read',
                'name' => 'Get Metrics',
                'description' => 'Get Site Explorer overview metrics.',
                'icon' => 'ph:chart-line',
            ],
            'ahrefs_get_domain_rating' => [
                'class' => AhrefsGetDomainRating::class,
                'type' => 'read',
                'name' => 'Get Domain Rating',
                'description' => 'Get Domain Rating and Ahrefs Rank.',
                'icon' => 'ph:gauge',
            ],
            'ahrefs_get_backlinks_stats' => [
                'class' => AhrefsGetBacklinksStats::class,
                'type' => 'read',
                'name' => 'Get Backlinks Stats',
                'description' => 'Get backlink statistics for a target.',
                'icon' => 'ph:link',
            ],
            'ahrefs_list_broken_backlinks' => [
                'class' => AhrefsListBrokenBacklinks::class,
                'type' => 'read',
                'name' => 'List Broken Backlinks',
                'description' => 'List broken backlinks pointing to a target.',
                'icon' => 'ph:link-break',
            ],
            'ahrefs_list_organic_competitors' => [
                'class' => AhrefsListOrganicCompetitors::class,
                'type' => 'read',
                'name' => 'List Organic Competitors',
                'description' => 'List organic search competitors for a target.',
                'icon' => 'ph:users-three',
            ],
            'ahrefs_list_paid_pages' => [
                'class' => AhrefsListPaidPages::class,
                'type' => 'read',
                'name' => 'List Paid Pages',
                'description' => 'List pages ranking in paid search.',
                'icon' => 'ph:currency-dollar',
            ],
            'ahrefs_list_linked_domains' => [
                'class' => AhrefsListLinkedDomains::class,
                'type' => 'read',
                'name' => 'List Linked Domains',
                'description' => 'List domains linked from a target.',
                'icon' => 'ph:globe-hemisphere-east',
            ],
            'ahrefs_list_anchors' => [
                'class' => AhrefsListAnchors::class,
                'type' => 'read',
                'name' => 'List Anchors',
                'description' => 'List anchor texts used in backlinks to a target.',
                'icon' => 'ph:text-aa',
            ],
            'ahrefs_get_limits_and_usage' => [
                'class' => AhrefsGetLimitsAndUsage::class,
                'type' => 'read',
                'name' => 'Get Limits And Usage',
                'description' => 'Get API subscription limits and usage.',
                'icon' => 'ph:user',
            ],
            'ahrefs_api_get' => [
                'class' => AhrefsApiGet::class,
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call any Ahrefs API v3 GET endpoint.',
                'icon' => 'ph:terminal-window',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/ahrefs.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Ahrefs API URL', 'required' => false, 'default' => 'https://api.ahrefs.com'],
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

            $service = new AhrefsService(
                apiKey: $creds->get('ahrefs', 'api_key', '', $account),
                baseUrl: $creds->get('ahrefs', 'url', 'https://api.ahrefs.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(AhrefsService::class));
    }
}
