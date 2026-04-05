<?php

namespace OpenCompany\Integrations\Ashby\Tools;

use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

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
        return 'List candidates from Ashby. Returns candidate profiles with contact info, tags, and source. Supports filtering by name, email, tags, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'description' => 'Filter by candidate name (partial match).'],
            'email' => ['type' => 'string', 'description' => 'Filter by candidate email address.'],
            'tags' => ['type' => 'array', 'description' => 'Filter by candidate tags.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of candidates to return per page (default: 50, max: 200).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of results to skip for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ashby integration is not configured.');
            }

            $body = [];

            if (isset($args['name'])) {
                $body['name'] = $args['name'];
            }
            if (isset($args['email'])) {
                $body['email'] = $args['email'];
            }
            if (isset($args['tags'])) {
                $body['tags'] = $args['tags'];
            }
            if (isset($args['limit'])) {
                $body['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $body['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listCandidates($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
