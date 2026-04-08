<?php

namespace OpenCompany\Integrations\Pinterest\Tools;

use OpenCompany\Integrations\Pinterest\PinterestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List boards for the authenticated Pinterest user.
 *
 * Retrieves boards with optional pagination via bookmark cursor
 * and configurable page size.
 */
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
        return 'List boards for the authenticated Pinterest user. Supports pagination with bookmark cursor and page size. Returns board IDs, names, descriptions, and pin counts.';
    }

    public function parameters(): array
    {
        return [
            'bookmark' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
            'pageSize' => ['type' => 'integer', 'description' => 'Number of boards to return per page (max 250).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinterest integration is not configured.');
            }

            $result = $this->service->listBoards(
                bookmark: $args['bookmark'] ?? null,
                pageSize: isset($args['pageSize']) ? (int) $args['pageSize'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
