<?php

namespace OpenCompany\Integrations\Pinterest\Tools;

use OpenCompany\Integrations\Pinterest\PinterestService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List pins for the authenticated Pinterest user.
 *
 * Retrieves pins with optional pagination via bookmark cursor
 * and configurable page size.
 */
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
        return 'List pins for the authenticated Pinterest user. Supports pagination with bookmark cursor and page size. Returns pin IDs, titles, descriptions, and media.';
    }

    public function parameters(): array
    {
        return [
            'bookmark' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
            'pageSize' => ['type' => 'integer', 'description' => 'Number of pins to return per page (max 250).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pinterest integration is not configured.');
            }

            $result = $this->service->listPins(
                bookmark: $args['bookmark'] ?? null,
                pageSize: isset($args['pageSize']) ? (int) $args['pageSize'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
