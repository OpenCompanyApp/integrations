<?php

namespace OpenCompany\Integrations\Exa\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Exa\ExaService;

/**
 * Find web pages similar to a given URL using Exa AI.
 *
 * Accepts a URL and returns a list of semantically similar pages.
 * Useful for discovering related content, competitors, or alternative resources.
 */
class ExaFindSimilar implements Tool
{
    /**
     * @param  ExaService  $service  The Exa API client.
     */
    public function __construct(
        private ExaService $service,
    ) {}

    public function name(): string
    {
        return 'exa_find_similar';
    }

    public function description(): string
    {
        return 'Find web pages similar to a given URL. Useful for discovering related content, competitors, or alternative resources. Returns a list of similar pages with titles, URLs, and scores.';
    }

    public function parameters(): array
    {
        return [
            'url' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The URL to find similar pages for (e.g., "https://example.com/article").',
            ],
            'num_results' => [
                'type' => 'integer',
                'description' => 'Number of similar pages to return (default: 10, max: 100).',
            ],
            'exclude_source_domain' => [
                'type' => 'boolean',
                'description' => 'Exclude results from the same domain as the source URL.',
            ],
            'include_domains' => [
                'type' => 'array',
                'description' => 'Domains to include.',
                'items' => ['type' => 'string'],
            ],
            'exclude_domains' => [
                'type' => 'array',
                'description' => 'Domains to exclude.',
                'items' => ['type' => 'string'],
            ],
        ];
    }

    /**
     * Execute the find-similar query.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Exa integration is not configured.');
            }

            $url = $args['url'] ?? '';
            if (empty($url)) {
                return ToolResult::error('URL is required.');
            }

            $body = [
                'url' => $url,
            ];

            if (isset($args['num_results'])) {
                $body['numResults'] = (int) $args['num_results'];
            }

            if (isset($args['exclude_source_domain'])) {
                $body['excludeSourceDomain'] = (bool) $args['exclude_source_domain'];
            }

            if (isset($args['include_domains'])) {
                $body['includeDomains'] = $args['include_domains'];
            }

            if (isset($args['exclude_domains'])) {
                $body['excludeDomains'] = $args['exclude_domains'];
            }

            $result = $this->service->findSimilar($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
