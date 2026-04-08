<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\Integrations\Capsule\CapsuleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * CapsuleGetOpportunity — retrieve a single sales opportunity by ID.
 *
 * Returns full opportunity details including associated party,
 * value, milestone, and custom field data.
 */
class CapsuleGetOpportunity implements Tool
{
    public function __construct(
        private CapsuleService $service,
    ) {}

    public function name(): string
    {
        return 'capsule_get_opportunity';
    }

    public function description(): string
    {
        return 'Retrieve a single sales opportunity from Capsule CRM by ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The opportunity ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Capsule CRM integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getOpportunity((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
