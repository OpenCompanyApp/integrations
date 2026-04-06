<?php

namespace OpenCompany\Integrations\Keap\Tools;

use OpenCompany\Integrations\Keap\KeapService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single Keap opportunity by its ID.
 *
 * Returns full opportunity details including associated contact,
 * pipeline stage, monetary value, and notes.
 */
class KeapGetOpportunity implements Tool
{
    public function __construct(
        private KeapService $service,
    ) {}

    public function name(): string
    {
        return 'keap_get_opportunity';
    }

    public function description(): string
    {
        return 'Retrieve a single Keap sales opportunity by ID. Returns full details including contact, stage, value, and notes.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Keap opportunity ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Keap integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('Opportunity ID is required.');
            }

            $result = $this->service->getOpportunity($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
