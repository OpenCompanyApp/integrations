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
    public function __construct(
        private ExaService $service,
    ) {}

    public function name(): string
    {
        return 'exa_get_contents';
    }

    public function description(): string
    {
        return 'Retrieve the full text contents and optional highlights for a list of Exa document IDs. Use this after a search or findSimilar call to get the actual page content.';
    }

    public function parameters(): array
    {
        return [
            'ids' => [
                'type' => 'array',
                'required' => true,
                'items' => ['type' => 'string'],
                'description' => 'List of Exa document IDs to retrieve contents for.',
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

            $ids = $args['ids'] ?? [];
            if (empty($ids)) {
                return ToolResult::error('At least one document ID is required.');
            }

            $body = [
                'ids' => (array) $ids,
            ];

            if (isset($args['text'])) {
                $body['text'] = (bool) $args['text'];
            }

            if (isset($args['highlights']) && is_array($args['highlights'])) {
                $body['highlights'] = $args['highlights'];
            }

            $result = $this->service->getContents($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
