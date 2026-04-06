<?php

namespace OpenCompany\Integrations\AddEvent\Tools;

use OpenCompany\Integrations\AddEvent\AddEventService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all event categories from AddEvent.
 *
 * Returns the full list of categories that can be used to organize events.
 * Use category IDs when creating or filtering events.
 */
class AddEventListCategories implements Tool
{
    public function __construct(
        private AddEventService $service,
    ) {}

    public function name(): string
    {
        return 'addevent_list_categories';
    }

    public function description(): string
    {
        return 'List all event categories in AddEvent. Use category IDs to organize and filter events.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AddEvent integration is not configured.');
            }

            $result = $this->service->listCategories();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
