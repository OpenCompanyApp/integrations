<?php

namespace OpenCompany\Integrations\Ashby\Tools;

use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List candidates from Ashby.
 */
class AshbyListCandidates implements Tool
{
    public function __construct(
        private AshbyService $service,
    ) {}

    public function name(): string
    {
        return 'ashby_list_candidates';
    }

    public function description(): string
    {
        return 'List candidates from Ashby with cursor pagination and sync tokens. Use ashby_search_candidates for name or email lookups.';
    }

    public function parameters(): array
    {
        return [
            'createdAfter' => ['type' => 'integer', 'description' => 'Return candidates created after this Unix epoch timestamp in milliseconds.'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
            'syncToken' => ['type' => 'string', 'description' => 'Incremental sync token.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of candidates to return (max/default 100).'],
        ];
    }

    /**
     * List candidates.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ashby integration is not configured.');
            }

            $body = [];

            if (isset($args['createdAfter'])) {
                $body['createdAfter'] = (int) $args['createdAfter'];
            }
            if (isset($args['cursor'])) {
                $body['cursor'] = $args['cursor'];
            }
            if (isset($args['syncToken'])) {
                $body['syncToken'] = $args['syncToken'];
            }
            if (isset($args['limit'])) {
                $body['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listCandidates($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
