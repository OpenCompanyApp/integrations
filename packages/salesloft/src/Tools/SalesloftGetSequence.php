<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\Integrations\Salesloft\SalesloftService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one legacy Salesloft call sequence.
 */
class SalesloftGetSequence implements Tool
{
    public function __construct(
        private SalesloftService $service,
    ) {}

    public function name(): string
    {
        return 'salesloft_get_sequence';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific call sequence in Salesloft by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The sequence ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Salesloft integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Sequence ID is required.');
            }

            $result = $this->service->getSequence($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
