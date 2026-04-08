<?php

namespace OpenCompany\Integrations\SproutSocial\Tools;

use OpenCompany\Integrations\SproutSocial\SproutSocialService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List inbox messages in Sprout Social.
 *
 * Returns a list of messages and conversations from the
 * Sprout Social Smart Inbox with optional pagination.
 */
class SproutSocialListMessages implements Tool
{
    public function __construct(
        private SproutSocialService $service,
    ) {}

    public function name(): string
    {
        return 'sproutsocial_list_messages';
    }

    public function description(): string
    {
        return 'List inbox messages and conversations in Sprout Social. Returns message IDs, sender info, and content snippets with pagination support.';
    }

    public function parameters(): array
    {
        return [
            'count' => ['type' => 'integer', 'description' => 'Number of messages to return per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sprout Social integration is not configured.');
            }

            $result = $this->service->listMessages(
                count: $args['count'] ?? null,
                page: $args['page'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
