<?php

namespace OpenCompany\Integrations\Pinterest\Tools;

use OpenCompany\Integrations\Pinterest\PinterestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PinterestCreateBoard implements Tool
{
    public function __construct(
        private PinterestService $service,
    ) {}

    public function name(): string
    {
        return 'pinterest_create_board';
    }

    public function description(): string
    {
        return 'Create a new board on Pinterest. Boards are collections of pins organized around a theme.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the board (max 180 characters).'],
            'description' => ['type' => 'string', 'description' => 'An optional description for the board (max 1500 characters).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinterest integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('name is required.');
            }

            $result = $this->service->createBoard(
                $args['name'],
                $args['description'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
