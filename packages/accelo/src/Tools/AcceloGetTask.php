<?php

namespace OpenCompany\Integrations\Accelo\Tools;

use OpenCompany\Integrations\Accelo\AcceloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get an Accelo task.
 *
 * Retrieves a single task by its ID from Accelo.
 */
class AcceloGetTask implements Tool
{
    /**
     * @param  AcceloService  $service  The Accelo API client.
     */
    public function __construct(
        private AcceloService $service,
    ) {}

    public function name(): string
    {
        return 'accelo_get_task';
    }

    public function description(): string
    {
        return 'Get details of a specific task in Accelo by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Accelo task ID.'],
        ];
    }

    /**
     * Get an Accelo task.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Accelo integration is not configured.');
            }

            $taskId = (int) $args['id'];
            $result = $this->service->getTask($taskId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
