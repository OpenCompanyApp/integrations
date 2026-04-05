<?php

namespace OpenCompany\Integrations\Pinterest\Tools;

use OpenCompany\Integrations\Pinterest\PinterestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PinterestListPins implements Tool
{
    public function __construct(
        private PinterestService $service,
    ) {}

    public function name(): string
    {
        return 'pinterest_list_pins';
    }

    public function description(): string
    {
        return 'List pins on a specific Pinterest board. Returns pin titles, descriptions, images, and links.';
    }

    public function parameters(): array
    {
        return [
            'board_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the board.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of pins to return (default: 25, max: 250).'],
            'bookmark' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the bookmark from a previous response to get the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinterest integration is not configured.');
            }

            if (empty($args['board_id'])) {
                return ToolResult::error('board_id is required.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $result = $this->service->listPins($args['board_id'], $limit, $args['bookmark'] ?? null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
