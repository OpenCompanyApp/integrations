<?php

namespace OpenCompany\Integrations\Pinterest\Tools;

use OpenCompany\Integrations\Pinterest\PinterestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single Pinterest board by ID.
 *
 * Retrieves full details for a specific board, including name,
 * description, privacy setting, and pin counts.
 */
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
        return 'Get details of a specific Pinterest board by its ID. Returns the board name, description, pin count, and privacy settings.';
    }

    public function parameters(): array
    {
        return [
            'boardId' => ['type' => 'string', 'required' => true, 'description' => 'The board ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinterest integration is not configured.');
            }

            $result = $this->service->getBoard($args['boardId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
