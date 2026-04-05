<?php

namespace OpenCompany\Integrations\Copper\Tools;

use OpenCompany\Integrations\Copper\CopperService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CopperGetCompany implements Tool
{
    public function __construct(
        private CopperService $service,
    ) {}

    public function name(): string
    {
        return 'copper_get_company';
    }

    public function description(): string
    {
        return 'Get details of a specific company in Copper CRM by ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Copper company ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Copper integration is not configured.');
            }

            $result = $this->service->getCompany((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
