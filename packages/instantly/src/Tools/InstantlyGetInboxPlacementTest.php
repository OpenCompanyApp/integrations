<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get an inbox placement test by ID.
 */
class InstantlyGetInboxPlacementTest implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_get_inbox_placement_test';
    }

    public function description(): string
    {
        return 'Get an inbox placement test by ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Test ID'],
            'with_metadata' => ['type' => 'boolean', 'required' => false, 'description' => 'Include metadata'],
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

            $params = []; if (isset($args['with_metadata'])) $params['with_metadata'] = $args['with_metadata']; $result = $this->service->getInboxPlacementTest($args['id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
