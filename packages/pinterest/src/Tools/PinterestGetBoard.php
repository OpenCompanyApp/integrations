<?php

namespace OpenCompany\Integrations\Pinterest\Tools;

use OpenCompany\Integrations\Pinterest\PinterestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PinterestGetBoard implements Tool
{
    public function __construct(
        private PinterestService $service,
    ) {}

    public function name(): string
    {
        return 'pinterest_get_board';
    }

    public function description(): string
    {
        return 'Get details for a specific Pinterest board, including its name, description, pin count, and privacy settings.';
    }

    public function parameters(): array
    {
        return [
            'board_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the board.'],
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

            $result = $this->service->getBoard($args['board_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
