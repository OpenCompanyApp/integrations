<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an inbox placement test.
 */
class InstantlyUpdateInboxPlacementTest implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_update_inbox_placement_test';
    }

    public function description(): string
    {
        return 'Update an inbox placement test.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Test ID'],
            'name' => ['type' => 'string', 'required' => false, 'description' => 'Test name'],
            'status' => ['type' => 'integer', 'required' => false, 'description' => 'Test status'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $body = []; foreach (['name','status'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $result = $this->service->updateInboxPlacementTest($args['id'], $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
