<?php

namespace OpenCompany\Integrations\Typesense\Tools;

use OpenCompany\Integrations\Typesense\TypesenseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TypesenseListCollections implements Tool
{
    public function __construct(
        private TypesenseService $service,
    ) {}

    public function name(): string
    {
        return 'typesense_list_collections';
    }

    public function description(): string
    {
        return 'List all collections in the Typesense search instance. Returns collection names, document counts, and schema details.';
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

            $result = $this->service->listCollections();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
