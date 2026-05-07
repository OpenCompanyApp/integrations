<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\Integrations\Salesloft\SalesloftService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List legacy Salesloft automation rules.
 */
class SalesloftListRules implements Tool
{
    public function __construct(
        private SalesloftService $service,
    ) {}

    public function name(): string
    {
        return 'salesloft_list_rules';
    }

    public function description(): string
    {
        return 'List automation rules from Salesloft. Returns rules with their IDs, names, conditions, and actions.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of rules to return per page (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Salesloft integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listRules($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
