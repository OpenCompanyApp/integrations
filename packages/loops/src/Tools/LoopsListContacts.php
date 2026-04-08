<?php

namespace OpenCompany\Integrations\Loops\Tools;

use OpenCompany\Integrations\Loops\LoopsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LoopsListContacts implements Tool
{
    public function __construct(
        private LoopsService $service,
    ) {}

    public function name(): string
    {
        return 'loops_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts from Loops with pagination. Returns contact records including email, name, and custom properties.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of contacts to return (default: 50, max: 50).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of contacts to skip for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Loops integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listContacts($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
