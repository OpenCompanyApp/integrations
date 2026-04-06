<?php

namespace OpenCompany\Integrations\Keap\Tools;

use OpenCompany\Integrations\Keap\KeapService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all tags available in Keap.
 *
 * Tags are used to categorize contacts and trigger automations.
 * Returns a list of all tags with their IDs and names.
 */
class KeapListTags implements Tool
{
    public function __construct(
        private KeapService $service,
    ) {}

    public function name(): string
    {
        return 'keap_list_tags';
    }

    public function description(): string
    {
        return 'List all tags in Keap. Tags are used to categorize contacts and trigger automations.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Keap integration is not configured.');
            }

            $result = $this->service->listTags();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
