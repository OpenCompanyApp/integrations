<?php

namespace OpenCompany\Integrations\Firecrawl;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlActivity;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlAgent;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlBatchScrape;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlCancelAgent;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlCancelBatchScrape;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlCancelCrawl;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlCrawl;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlCreateBrowser;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlCreditUsage;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlDeleteBrowser;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlExecuteBrowser;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlExtract;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlGetActiveCrawls;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlGetAgentStatus;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlGetBatchScrapeErrors;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlGetBatchScrapeStatus;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlGetCrawlErrors;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlGetCrawlStatus;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlGetExtractStatus;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlHistoricalCreditUsage;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlHistoricalTokenUsage;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlListBrowsers;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlMap;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlPreviewCrawlParams;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlQueueStatus;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlScrape;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlSearch;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlTokenUsage;

/**
 * Tool provider for the Firecrawl integration.
 *
 * Defines Firecrawl v2 catalog metadata, credentials, multi-account resolution, and tool classes.
 */
class FirecrawlToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
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
        return 'firecrawl';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Firecrawl',
            'description' => 'Web scraping, crawling, search, extraction, browser sessions, and usage metrics.',
            'icon' => 'ph:spider-web',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Firecrawl',
            'description' => 'Firecrawl v2 web scraping, crawling, search, extraction, agent tasks, browser sessions, and team usage APIs.',
            'icon' => 'ph:spider-web',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.firecrawl.dev/api-reference/v2-introduction',
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
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Firecrawl API key',
                'hint' => 'Find your API key in the <a href="https://www.firecrawl.dev/account" target="_blank">Firecrawl dashboard</a>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.firecrawl.dev/v2',
                'hint' => 'Use the default Firecrawl v2 URL, or your self-hosted v2 instance URL',
                'default' => 'https://api.firecrawl.dev/v2',
            ],
        ];
    }

    /**
     * Test the connection using the provided configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.firecrawl.dev/v2', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/team/credit-usage');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Firecrawl API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Authentication failed: {$error}",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Firecrawl v2 API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Registered tools and their metadata.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'firecrawl_scrape' => [
                'class' => FirecrawlScrape::class,
                'type' => 'read',
                'name' => 'Scrape URL',
                'description' => 'Scrape a single URL and extract its content.',
                'icon' => 'ph:browser',
            ],
            'firecrawl_search' => [
                'class' => FirecrawlSearch::class,
                'type' => 'read',
                'name' => 'Search',
                'description' => 'Search the web and optionally scrape result pages.',
                'icon' => 'ph:magnifying-glass',
            ],
            'firecrawl_crawl' => [
                'class' => FirecrawlCrawl::class,
                'type' => 'read',
                'name' => 'Crawl Website',
                'description' => 'Start a crawl job to scrape all pages from a URL.',
                'icon' => 'ph:spider-web',
            ],
            'firecrawl_get_crawl_status' => [
                'class' => FirecrawlGetCrawlStatus::class,
                'type' => 'read',
                'name' => 'Crawl Status',
                'description' => 'Check the status and retrieve results of a crawl job.',
                'icon' => 'ph:spinner',
            ],
            'firecrawl_cancel_crawl' => [
                'class' => FirecrawlCancelCrawl::class,
                'type' => 'write',
                'name' => 'Cancel Crawl',
                'description' => 'Cancel a running crawl job.',
                'icon' => 'ph:x-circle',
            ],
            'firecrawl_get_crawl_errors' => [
                'class' => FirecrawlGetCrawlErrors::class,
                'type' => 'read',
                'name' => 'Crawl Errors',
                'description' => 'List failed pages for a crawl job.',
                'icon' => 'ph:warning-circle',
            ],
            'firecrawl_get_active_crawls' => [
                'class' => FirecrawlGetActiveCrawls::class,
                'type' => 'read',
                'name' => 'Active Crawls',
                'description' => 'List active crawl jobs for the team.',
                'icon' => 'ph:activity',
            ],
            'firecrawl_preview_crawl_params' => [
                'class' => FirecrawlPreviewCrawlParams::class,
                'type' => 'read',
                'name' => 'Preview Crawl Params',
                'description' => 'Preview crawl parameters generated from natural language.',
                'icon' => 'ph:sliders-horizontal',
            ],
            'firecrawl_map' => [
                'class' => FirecrawlMap::class,
                'type' => 'read',
                'name' => 'Map URLs',
                'description' => 'Discover all URLs on a website.',
                'icon' => 'ph:tree-structure',
            ],
            'firecrawl_batch_scrape' => [
                'class' => FirecrawlBatchScrape::class,
                'type' => 'read',
                'name' => 'Batch Scrape',
                'description' => 'Start a batch scrape job for multiple URLs.',
                'icon' => 'ph:stack',
            ],
            'firecrawl_get_batch_scrape_status' => [
                'class' => FirecrawlGetBatchScrapeStatus::class,
                'type' => 'read',
                'name' => 'Batch Scrape Status',
                'description' => 'Check status and retrieve results for a batch scrape job.',
                'icon' => 'ph:spinner',
            ],
            'firecrawl_cancel_batch_scrape' => [
                'class' => FirecrawlCancelBatchScrape::class,
                'type' => 'write',
                'name' => 'Cancel Batch Scrape',
                'description' => 'Cancel a running batch scrape job.',
                'icon' => 'ph:x-circle',
            ],
            'firecrawl_get_batch_scrape_errors' => [
                'class' => FirecrawlGetBatchScrapeErrors::class,
                'type' => 'read',
                'name' => 'Batch Scrape Errors',
                'description' => 'List failed URLs for a batch scrape job.',
                'icon' => 'ph:warning',
            ],
            'firecrawl_extract' => [
                'class' => FirecrawlExtract::class,
                'type' => 'read',
                'name' => 'Extract Data',
                'description' => 'Extract structured data from URLs using AI.',
                'icon' => 'ph:brain',
            ],
            'firecrawl_get_extract_status' => [
                'class' => FirecrawlGetExtractStatus::class,
                'type' => 'read',
                'name' => 'Extract Status',
                'description' => 'Check status and retrieve results for an extract job.',
                'icon' => 'ph:clock',
            ],
            'firecrawl_agent' => [
                'class' => FirecrawlAgent::class,
                'type' => 'read',
                'name' => 'Agent Task',
                'description' => 'Start an agentic data extraction task.',
                'icon' => 'ph:robot',
            ],
            'firecrawl_get_agent_status' => [
                'class' => FirecrawlGetAgentStatus::class,
                'type' => 'read',
                'name' => 'Agent Status',
                'description' => 'Check status and retrieve results for an agent job.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            'firecrawl_cancel_agent' => [
                'class' => FirecrawlCancelAgent::class,
                'type' => 'write',
                'name' => 'Cancel Agent',
                'description' => 'Cancel a running agent job.',
                'icon' => 'ph:x',
            ],
            'firecrawl_create_browser' => [
                'class' => FirecrawlCreateBrowser::class,
                'type' => 'write',
                'name' => 'Create Browser',
                'description' => 'Create an interactive browser session.',
                'icon' => 'ph:browser',
            ],
            'firecrawl_list_browsers' => [
                'class' => FirecrawlListBrowsers::class,
                'type' => 'read',
                'name' => 'List Browsers',
                'description' => 'List browser sessions.',
                'icon' => 'ph:browsers',
            ],
            'firecrawl_execute_browser' => [
                'class' => FirecrawlExecuteBrowser::class,
                'type' => 'write',
                'name' => 'Execute Browser',
                'description' => 'Execute code or a prompt in a browser session.',
                'icon' => 'ph:terminal-window',
            ],
            'firecrawl_delete_browser' => [
                'class' => FirecrawlDeleteBrowser::class,
                'type' => 'write',
                'name' => 'Delete Browser',
                'description' => 'Delete a browser session.',
                'icon' => 'ph:trash',
            ],
            'firecrawl_credit_usage' => [
                'class' => FirecrawlCreditUsage::class,
                'type' => 'read',
                'name' => 'Credit Usage',
                'description' => 'Get remaining team credits.',
                'icon' => 'ph:coins',
            ],
            'firecrawl_historical_credit_usage' => [
                'class' => FirecrawlHistoricalCreditUsage::class,
                'type' => 'read',
                'name' => 'Historical Credit Usage',
                'description' => 'Get historical team credit usage.',
                'icon' => 'ph:chart-line',
            ],
            'firecrawl_token_usage' => [
                'class' => FirecrawlTokenUsage::class,
                'type' => 'read',
                'name' => 'Token Usage',
                'description' => 'Get remaining extract tokens.',
                'icon' => 'ph:currency-circle-dollar',
            ],
            'firecrawl_historical_token_usage' => [
                'class' => FirecrawlHistoricalTokenUsage::class,
                'type' => 'read',
                'name' => 'Historical Token Usage',
                'description' => 'Get historical extract token usage.',
                'icon' => 'ph:chart-bar',
            ],
            'firecrawl_queue_status' => [
                'class' => FirecrawlQueueStatus::class,
                'type' => 'read',
                'name' => 'Queue Status',
                'description' => 'Get scrape queue metrics.',
                'icon' => 'ph:queue',
            ],
            'firecrawl_activity' => [
                'class' => FirecrawlActivity::class,
                'type' => 'read',
                'name' => 'Activity',
                'description' => 'List recent API activity.',
                'icon' => 'ph:list-magnifying-glass',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/firecrawl.md';
    }

    /**
     * Credential fields for account setup.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.firecrawl.dev/v2'],
        ];
    }

    /**
     * Confirm this is a full integration (not just a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Firecrawl service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool execution context.
     */
    private function resolveService(array $context = []): FirecrawlService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new FirecrawlService(
                apiKey: $creds->get('firecrawl', 'api_key', '', $account),
                baseUrl: $creds->get('firecrawl', 'url', 'https://api.firecrawl.dev/v2', $account),
            );
        }

        return app(FirecrawlService::class);
    }
}
