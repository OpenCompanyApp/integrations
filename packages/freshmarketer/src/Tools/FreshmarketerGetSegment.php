<?php

namespace OpenCompany\Integrations\Freshmarketer\Tools;

use OpenCompany\Integrations\Freshmarketer\FreshmarketerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FreshmarketerGetSegment — retrieve details for a single segment.
 *
 * Calls GET /api/v1/segments/{id} to fetch full segment details.
 */
class FreshmarketerGetSegment implements Tool
{
    public function __construct(
        private FreshmarketerService $service,
    ) {}

    public function name(): string
    {
        return 'freshmarketer_get_segment';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific contact segment by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The segment ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshmarketer integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('Segment ID is required.');
            }

            $result = $this->service->getSegment($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
