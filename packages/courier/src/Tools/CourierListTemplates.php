<?php

namespace OpenCompany\Integrations\Courier\Tools;

use OpenCompany\Integrations\Courier\CourierService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CourierListTemplates implements Tool
{
    public function __construct(
        private CourierService $service,
    ) {}

    public function name(): string
    {
        return 'courier_list_templates';
    }

    public function description(): string
    {
        return 'List notification templates from Courier with cursor-based pagination. Returns template IDs, names, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of templates to return (default: 20, max: 200).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor — pass the cursor from a previous response to fetch the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Courier integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : null;
            $cursor = $args['cursor'] ?? null;

            $result = $this->service->listTemplates($limit, $cursor);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
