<?php

namespace OpenCompany\Integrations\MakeCom\Tools;

use OpenCompany\Integrations\MakeCom\MakeComService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a single Make.com scenario execution (run).
 */
class MakeComGetExecution implements Tool
{
    /**
     * @param  MakeComService  $service  The Make.com API client
     */
    public function __construct(
        private MakeComService $service,
    ) {}

    public function name(): string
    {
        return 'make_com_get_execution';
    }

    public function description(): string
    {
        return <<<'MD'
        Get detailed information about a Make.com scenario execution (run) by ID,
        including status, duration, input/output for each module, and any errors.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Execution (run) ID.'],
        ];
    }

    /**
     * Retrieve a single Make.com execution by ID.
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

            $execution = $this->service->getExecution($id);

            return ToolResult::success($execution);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
