<?php

namespace OpenCompany\Integrations\Apify\Tools;

use OpenCompany\Integrations\Apify\ApifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List actors available to the authenticated Apify user.
 *
 * Returns a paginated list of actors owned by or shared with the user.
 */
class ApifyListActors implements Tool
{
    public function __construct(
        private ApifyService $service,
    ) {}

    public function name(): string
    {
        return 'apify_list_actors';
    }

    public function description(): string
    {
        return 'List Apify actors available to the authenticated user. Returns actor names, IDs, descriptions, and versions. Supports pagination with offset and limit.';
    }

    public function parameters(): array
    {
        return [
            'offset' => ['type' => 'integer', 'description' => 'Number of actors to skip (default: 0).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of actors to return (default: 20, max: 1000).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apify integration is not configured.');
            }

            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;

            $result = $this->service->listActors($offset, $limit);

            $data = $result['data'] ?? $result;
            $items = $data['items'] ?? $data;

            $actors = array_map(function (array $actor): array {
                return [
                    'id' => $actor['id'] ?? null,
                    'username' => $actor['username'] ?? null,
                    'name' => $actor['name'] ?? null,
                    'fullName' => ($actor['username'] ?? '') . '/' . ($actor['name'] ?? ''),
                    'description' => $actor['description'] ?? null,
                    'versions' => $actor['versions'] ?? null,
                    'defaultRunOptions' => $actor['defaultRunOptions'] ?? null,
                ];
            }, is_array($items) ? $items : []);

            return ToolResult::success([
                'actors' => $actors,
                'total' => $data['total'] ?? count($actors),
                'offset' => $offset,
                'count' => count($actors),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
