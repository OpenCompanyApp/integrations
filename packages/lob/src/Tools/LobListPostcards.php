<?php

namespace OpenCompany\Integrations\Lob\Tools;

use OpenCompany\Integrations\Lob\LobService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LobListPostcards implements Tool
{
    public function __construct(
        private LobService $service,
    ) {}

    public function name(): string
    {
        return 'lob_list_postcards';
    }

    public function description(): string
    {
        return 'List postcards with pagination. Returns a page of postcard objects sorted by creation date (newest first).';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page (default: 10, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of results to skip for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lob integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listPostcards($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
