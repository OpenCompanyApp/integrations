<?php

namespace OpenCompany\Integrations\Postmark\Tools;

use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List servers in the Postmark account.
 *
 * Supports pagination via count and offset parameters and filtering by name.
 * Note: This requires a Server API token with appropriate permissions.
 */
class PostmarkListServers implements Tool
{
    /**
     * @param  PostmarkService  $service  The Postmark API client
     */
    public function __construct(
        private PostmarkService $service,
    ) {}

    public function name(): string
    {
        return 'postmark_list_servers';
    }

    public function description(): string
    {
        return 'List servers in the Postmark account. Supports filtering by name and pagination.';
    }

    public function parameters(): array
    {
        return [
            'count'  => ['type' => 'integer', 'description' => 'Number of servers to return per page (default 100, max 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of servers to skip for pagination.'],
            'name'   => ['type' => 'string', 'description' => 'Filter by server name.'],
        ];
    }

    /**
     * List servers in the Postmark account.
     *
     * @param  array<string, mixed>  $args  Tool arguments (count, offset, name)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Postmark integration is not configured.');
            }

            $params = [];

            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (! empty($args['name'])) {
                $params['name'] = $args['name'];
            }

            $result = $this->service->listServers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
