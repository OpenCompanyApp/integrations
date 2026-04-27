<?php

namespace OpenCompany\Integrations\Firecrawl;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlCrawl;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlExtract;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlGetCurrentUser;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlGetCrawlStatus;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlMap;
use OpenCompany\Integrations\Firecrawl\Tools\FirecrawlScrape;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
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

/**
     * The integration identifier.
     */
    public function appName(): string
    {
        return 'firecrawl';
    }

    /**
     * Short metadata for tool selection UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'scrape, crawl, map, extract',
            'description' => 'Web scraping & extraction',
            'icon' => 'ph:spider-web',
        ];
    }

    /**
     * Full integration metadata for the integrations catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Firecrawl',
            'description' => 'AI-powered web scraping, crawling, mapping, and structured data extraction',
            'icon' => 'ph:spider-web',
            'category' => 'ai',
            'badge' => 'verified',
            'docs_url' => 'https://docs.firecrawl.dev/',
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
                'placeholder' => 'https://api.firecrawl.dev/v1',
                'hint' => 'Use the default for Firecrawl Cloud, or your self-hosted instance URL',
                'default' => 'https://api.firecrawl.dev/v1',
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
        $baseUrl = rtrim($config['url'] ?? 'https://api.firecrawl.dev/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

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
                'message' => "Connected to Firecrawl API at {$baseUrl}.",
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
            'firecrawl_map' => [
                'class' => FirecrawlMap::class,
                'type' => 'read',
                'name' => 'Map URLs',
                'description' => 'Discover all URLs on a website.',
                'icon' => 'ph:tree-structure',
            ],
            'firecrawl_extract' => [
                'class' => FirecrawlExtract::class,
                'type' => 'read',
                'name' => 'Extract Data',
                'description' => 'Extract structured data from URLs using AI.',
                'icon' => 'ph:brain',
            ],
            'firecrawl_get_current_user' => [
                'class' => FirecrawlGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Current User',
                'description' => 'Get the authenticated user\'s account information.',
                'icon' => 'ph:user',
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
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.firecrawl.dev/v1'],
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
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new FirecrawlService(
                apiKey: $creds->get('firecrawl', 'api_key', '', $account),
                baseUrl: $creds->get('firecrawl', 'url', 'https://api.firecrawl.dev/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(FirecrawlService::class));
    }
}
