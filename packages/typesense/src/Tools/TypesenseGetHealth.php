<?php

namespace OpenCompany\Integrations\Typesense\Tools;

use OpenCompany\Integrations\Typesense\TypesenseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TypesenseGetHealth implements Tool
{
    public function __construct(
        private TypesenseService $service,
    ) {}

    public function name(): string
    {
        return 'typesense_get_health';
    }

    public function description(): string
    {
        return 'Check the health status of the Typesense search instance. Returns whether the service is reachable and healthy.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typesense integration is not configured.');
            }

            $result = $this->service->getHealth();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
