<?php

namespace OpenCompany\Integrations\Exa\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Exa\ExaService;

/**
 * Generate a grounded answer using Exa search results.
 *
 * Returns an answer with citations and cost metadata from the Exa Answer API.
 */
class ExaAnswer implements Tool
{
    /**
     * @param  ExaService  $service  The Exa API client.
     */
    public function __construct(
        private ExaService $service,
    ) {}

    public function name(): string
    {
        return 'exa_answer';
    }

    public function description(): string
    {
        return 'Get a grounded answer to a question using Exa search results, including citations when returned by Exa.';
    }

    public function parameters(): array
    {
        return [
            'query' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Question or query to answer.',
            ],
            'text' => [
                'type' => 'boolean',
                'description' => 'Include full text content in search results used for the answer.',
            ],
            'stream' => [
                'type' => 'boolean',
                'description' => 'Whether to request streaming. Hosts usually should leave this false because tools return JSON.',
            ],
        ];
    }

    /**
     * Execute the Exa Answer request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Exa integration is not configured.');
            }

            $body = [
                'query' => $args['query'] ?? '',
            ];

            if ($body['query'] === '') {
                return ToolResult::error('query is required.');
            }

            if (isset($args['text'])) {
                $body['text'] = (bool) $args['text'];
            }

            if (isset($args['stream'])) {
                $body['stream'] = (bool) $args['stream'];
            }

            return ToolResult::success($this->service->answer($body));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
