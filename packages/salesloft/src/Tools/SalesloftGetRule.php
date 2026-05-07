<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\Integrations\Salesloft\SalesloftService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one legacy Salesloft automation rule.
 */
class SalesloftGetRule implements Tool
{
    public function __construct(
        private SalesloftService $service,
    ) {}

    public function name(): string
    {
        return 'salesloft_get_rule';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific automation rule in Salesloft by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The rule ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Salesloft integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Rule ID is required.');
            }

            $result = $this->service->getRule($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
