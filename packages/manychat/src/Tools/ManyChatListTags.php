<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

use OpenCompany\Integrations\ManyChat\ManyChatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all tags in the ManyChat account.
 *
 * Returns all available tags that can be applied to subscribers
 * for segmentation and automation triggers.
 */
class ManyChatListTags implements Tool
{
    public function __construct(
        private ManyChatService $service,
    ) {}

    public function name(): string
    {
        return 'manychat_list_tags';
    }

    public function description(): string
    {
        return 'List all tags in your ManyChat account. Tags are used to segment subscribers and trigger automations.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ManyChat integration is not configured.');
            }

            $result = $this->service->listTags();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
