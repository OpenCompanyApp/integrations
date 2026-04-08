<?php

namespace OpenCompany\Integrations\KoFi\Tools;

use OpenCompany\Integrations\KoFi\KoFiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KoFiListSupporters implements Tool
{
    public function __construct(
        private KoFiService $service,
    ) {}

    public function name(): string
    {
        return 'ko-fi_list_supporters';
    }

    public function description(): string
    {
        return 'List all supporters who have donated or subscribed to your Ko-fi page. Returns supporter names, emails, and contribution history.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Number of results per page (default: 25).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ko-fi integration is not configured.');
            }

            $params = array_filter([
                'page' => $args['page'] ?? null,
                'limit' => $args['limit'] ?? null,
            ], fn($v) => $v !== null);

            $result = $this->service->listSupporters($params);

            $supporters = $result['supporters'] ?? $result['data'] ?? [];

            return ToolResult::success([
                'supporters' => $supporters,
                'totalCount' => count($supporters),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
