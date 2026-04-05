<?php

namespace OpenCompany\Integrations\Pinterest\Tools;

use OpenCompany\Integrations\Pinterest\PinterestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PinterestListBoards implements Tool
{
    public function __construct(
        private PinterestService $service,
    ) {}

    public function name(): string
    {
        return 'pinterest_list_boards';
    }

    public function description(): string
    {
        return 'List all boards for the authenticated Pinterest user. Returns board names, descriptions, and IDs you can use to list or create pins.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of boards to return (default: 25, max: 250).'],
            'bookmark' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the bookmark from a previous response to get the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinterest integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $result = $this->service->listBoards($limit, $args['bookmark'] ?? null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
