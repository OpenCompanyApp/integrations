<?php

namespace OpenCompany\Integrations\Exa\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Exa\ExaService;

/**
 * Retrieve full contents for a list of Exa document IDs.
 *
 * Given one or more document IDs (obtained from search or findSimilar),
 * retrieves the full text content and optional highlights.
 */
class ExaGetContents implements Tool
{
    /**
     * @param  ExaService  $service  The Exa API client.
     */
    public function __construct(
        private ExaService $service,
    ) {}

    public function name(): string
    {
        return 'exa_get_contents';
    }

    public function description(): string
    {
        return 'Retrieve full page contents, summaries, highlights, and metadata for URLs or Exa document IDs.';
    }

    public function parameters(): array
    {
        return [
            'urls' => [
                'type' => 'array',
                'items' => ['type' => 'string'],
                'description' => 'List of URLs to retrieve contents for. Preferred for the current Exa Contents API.',
            ],
            'ids' => [
                'type' => 'array',
                'items' => ['type' => 'string'],
                'description' => 'List of Exa document IDs from search results. Backward-compatible alternative to urls.',
            ],
            'text' => [
                'type' => 'boolean',
                'description' => 'Include full page text in the response (default: true).',
            ],
            'highlights' => [
                'type' => 'object',
                'properties' => [
                    'query' => [
                        'type' => 'string',
                        'description' => 'Query to generate highlights for. Pass the original search query for best results.',
                    ],
                    'num_sentences' => [
                        'type' => 'integer',
                        'description' => 'Number of highlight sentences to return per result (default: 3).',
                    ],
                ],
                'description' => 'Highlight configuration for extracting key passages from the content.',
            ],
            'summary' => [
                'type' => 'object',
                'description' => 'Summary configuration for LLM-generated page summaries.',
            ],
            'livecrawl' => [
                'type' => 'string',
                'enum' => ['never', 'fallback', 'preferred', 'always'],
                'description' => 'Deprecated livecrawl preference. Prefer max_age_hours when possible.',
            ],
            'max_age_hours' => [
                'type' => 'integer',
                'description' => 'Maximum cached content age in hours. 0 always livecrawls; -1 always uses cache.',
            ],
            'subpages' => [
                'type' => 'integer',
                'description' => 'Number of linked subpages to crawl.',
            ],
            'subpage_target' => [
                'type' => 'string',
                'description' => 'Term used to target specific subpages.',
            ],
        ];
    }

    /**
     * Execute the get-contents request.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Exa integration is not configured.');
            }

            $urls = $args['urls'] ?? [];
            $ids = $args['ids'] ?? [];

            if (empty($urls) && empty($ids)) {
                return ToolResult::error('At least one URL or document ID is required.');
            }

            $body = [];

            if (!empty($urls)) {
                $body['urls'] = (array) $urls;
            }

            if (!empty($ids)) {
                $body['ids'] = (array) $ids;
            }

            if (isset($args['text'])) {
                $body['text'] = (bool) $args['text'];
            }

            if (isset($args['highlights']) && is_array($args['highlights'])) {
                $body['highlights'] = $args['highlights'];
            }

            if (isset($args['summary']) && is_array($args['summary'])) {
                $body['summary'] = $args['summary'];
            }

            if (isset($args['livecrawl'])) {
                $body['livecrawl'] = $args['livecrawl'];
            }

            if (isset($args['max_age_hours'])) {
                $body['maxAgeHours'] = (int) $args['max_age_hours'];
            }

            if (isset($args['subpages'])) {
                $body['subpages'] = (int) $args['subpages'];
            }

            if (isset($args['subpage_target'])) {
                $body['subpageTarget'] = $args['subpage_target'];
            }

            $result = $this->service->getContents($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
