<?php

namespace OpenCompany\Integrations\Exa\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Exa\ExaService;

/**
 * Combined search and content retrieval in a single call.
 *
 * Performs a neural search query and immediately retrieves the full page
 * contents for all results. Supports all search parameters plus text and
 * highlight options for content retrieval.
 */
class ExaSearchAndContents implements Tool
{
    /**
     * @param  ExaService  $service  The Exa API client.
     */
    public function __construct(
        private ExaService $service,
    ) {}

    public function name(): string
    {
        return 'exa_search_and_contents';
    }

    public function description(): string
    {
        return 'Search the web and retrieve full page contents in one call. Combines search and content retrieval into a single request for efficiency. Returns results with both metadata and full text content.';
    }

    public function parameters(): array
    {
        return [
            'query' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Natural language search query.',
            ],
            'num_results' => [
                'type' => 'integer',
                'description' => 'Number of results to return (default: 10, max: 100).',
            ],
            'use_autoprompt' => [
                'type' => 'boolean',
                'description' => 'Let Exa automatically optimize your query (default: true).',
            ],
            'type' => [
                'type' => 'string',
                'enum' => ['auto', 'instant', 'fast', 'deep-lite', 'deep', 'deep-reasoning', 'keyword', 'neural'],
                'description' => 'Search type. Current options include auto, instant, fast, deep-lite, deep, deep-reasoning, keyword, and neural.',
            ],
            'category' => [
                'type' => 'string',
                'enum' => ['company', 'research paper', 'news', 'github', 'tweet', 'movie', 'song', 'personal site', 'or pdf'],
                'description' => 'Filter results to a specific category of content.',
            ],
            'start_published_date' => [
                'type' => 'string',
                'description' => 'Only return results published after this date (ISO 8601, e.g., "2024-01-01T00:00:00Z").',
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
                        'description' => 'Query to generate highlights for.',
                    ],
                    'num_sentences' => [
                        'type' => 'integer',
                        'description' => 'Number of highlight sentences per result (default: 3).',
                    ],
                ],
                'description' => 'Highlight configuration for extracting key passages.',
            ],
            'summary' => [
                'type' => 'object',
                'description' => 'Summary configuration for LLM-generated summaries.',
            ],
            'max_age_hours' => [
                'type' => 'integer',
                'description' => 'Maximum cached content age in hours for returned contents.',
            ],
            'output_schema' => [
                'type' => 'object',
                'description' => 'Optional JSON schema for structured output with deep search types.',
            ],
        ];
    }

    /**
     * Execute the combined search-and-contents request.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Exa integration is not configured.');
            }

            $body = [
                'query' => $args['query'],
            ];

            // Search parameters
            if (isset($args['num_results'])) {
                $body['numResults'] = (int) $args['num_results'];
            }

            if (isset($args['use_autoprompt'])) {
                $body['useAutoprompt'] = (bool) $args['use_autoprompt'];
            }

            if (isset($args['type'])) {
                $body['type'] = $args['type'];
            }

            if (isset($args['category'])) {
                $body['category'] = $args['category'];
            }

            if (isset($args['start_published_date'])) {
                $body['startPublishedDate'] = $args['start_published_date'];
            }

            $contents = [];
            if (isset($args['text'])) {
                $contents['text'] = (bool) $args['text'];
            }

            if (isset($args['highlights']) && is_array($args['highlights'])) {
                $contents['highlights'] = $args['highlights'];
            }

            if (isset($args['summary']) && is_array($args['summary'])) {
                $contents['summary'] = $args['summary'];
            }

            if (isset($args['max_age_hours'])) {
                $contents['maxAgeHours'] = (int) $args['max_age_hours'];
            }

            if ($contents !== []) {
                $body['contents'] = $contents;
            }

            if (isset($args['output_schema']) && is_array($args['output_schema'])) {
                $body['outputSchema'] = $args['output_schema'];
            }

            $result = $this->service->search($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
