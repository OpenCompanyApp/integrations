<?php

namespace OpenCompany\Integrations\Rollbar\Tools;

use OpenCompany\Integrations\Rollbar\RollbarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list deploys in the Rollbar account.
 *
 * Returns a paginated list of deploys with optional filtering
 * by environment.
 *
 * @see https://docs.rollbar.com/docs/list-all-deploys
 */
class RollbarListDeploys implements Tool
{
    /**
     * Create a new RollbarListDeploys tool instance.
     */
    public function __construct(
        private RollbarService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'rollbar_list_deploys';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List recent deploys across your Rollbar account, optionally filtered by environment.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'environment' => ['type' => 'string', 'description' => 'Filter by environment name (e.g., production, staging).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of deploys to return (default: 20).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array  $args  Tool arguments (environment, limit, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Rollbar integration is not configured.');
            }

            $environment = $args['environment'] ?? null;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listDeploys(
                environment: $environment,
                limit: $limit,
                page: $page,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
