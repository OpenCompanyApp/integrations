<?php

namespace OpenCompany\Integrations\Ifttt\Tools;

use OpenCompany\Integrations\Ifttt\IftttService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List connections in IFTTT with optional filters.
 */
class IftttListConnections implements Tool
{
    /**
     * @param  IftttService  $service  The IFTTT API client
     */
    public function __construct(
        private IftttService $service,
    ) {}

    public function name(): string
    {
        return 'ifttt_list_connections';
    }

    public function description(): string
    {
        return 'List connections in IFTTT with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Max number of connections to return.'],
            'page'  => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    /**
     * Retrieve a list of connections with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('IFTTT integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $connections = $this->service->listConnections($params);

            return ToolResult::success($connections);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
