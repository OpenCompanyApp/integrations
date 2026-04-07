<?php

namespace OpenCompany\Integrations\MakeCom\Tools;

use OpenCompany\Integrations\MakeCom\MakeComService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a single Make.com scenario.
 */
class MakeComGetScenario implements Tool
{
    /**
     * @param  MakeComService  $service  The Make.com API client
     */
    public function __construct(
        private MakeComService $service,
    ) {}

    public function name(): string
    {
        return 'make_com_get_scenario';
    }

    public function description(): string
    {
        return <<<'MD'
        Get detailed information about a Make.com scenario by ID,
        including its blueprint, scheduling, and status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Scenario ID.'],
        ];
    }

    /**
     * Retrieve a single Make.com scenario by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Make.com integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $scenario = $this->service->getScenario($id);

            return ToolResult::success($scenario);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
