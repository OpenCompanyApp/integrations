<?php

namespace OpenCompany\Integrations\Zapier\Tools;

use OpenCompany\Integrations\Zapier\ZapierService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List zap executions in Zapier with optional filters.
 */
class ZapierListExecutions implements Tool
{
    /**
     * @param  ZapierService  $service  The Zapier API client
     */
    public function __construct(
        private ZapierService $service,
    ) {}

    public function name(): string
    {
        return 'zapier_list_executions';
    }

    public function description(): string
    {
        return 'List zap executions in Zapier with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'zap_id' => ['type' => 'string',  'description' => 'Filter executions by zap ID.'],
            'limit'  => ['type' => 'integer', 'description' => 'Max number of executions to return.'],
            'page'   => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    /**
     * Retrieve a list of executions with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (zap_id, limit, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zapier integration is not configured.');
            }

            $params = [];

            if (isset($args['zap_id'])) {
                $params['zap_id'] = $args['zap_id'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $executions = $this->service->listExecutions($params);

            return ToolResult::success($executions);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
