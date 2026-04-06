<?php

namespace OpenCompany\Integrations\Front\Tools;

use OpenCompany\Integrations\Front\FrontService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FrontListContacts implements Tool
{
    public function __construct(
        private FrontService $service,
    ) {}

    public function name(): string
    {
        return 'front_list_contacts';
    }

    public function description(): string
    {
        return 'List and search contacts in Front. Search by name, email, or other identifiers. Returns paginated contact details.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of contacts per page (max 100).'],
            'q' => ['type' => 'string', 'description' => 'Search query to filter contacts by name, email, or other identifiers.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Front integration is not configured.');
            }

            $result = $this->service->listContacts(
                page: isset($args['page']) ? (int) $args['page'] : null,
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                q: $args['q'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
