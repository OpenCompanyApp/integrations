<?php

namespace OpenCompany\Integrations\Paperspace\Tools;

use OpenCompany\Integrations\Paperspace\PaperspaceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PaperspaceGetMachine implements Tool
{
    public function __construct(
        private PaperspaceService $service,
    ) {}

    public function name(): string
    {
        return 'paperspace_get_machine';
    }

    public function description(): string
    {
        return 'Get details for a specific Paperspace machine by ID. Returns full machine information including specs, state, and network configuration.';
    }

    public function parameters(): array
    {
        return [
            'machine_id' => ['type' => 'string', 'required' => true, 'description' => 'The machine ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Paperspace integration is not configured.');
            }

            $result = $this->service->getMachine((string) $args['machine_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
