<?php

namespace OpenCompany\Integrations\SproutSocial\Tools;

use OpenCompany\Integrations\SproutSocial\SproutSocialService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single message by ID in Sprout Social.
 *
 * Retrieves full details for a specific message or conversation,
 * including sender, content, attachments, and metadata.
 */
class SproutSocialGetMessage implements Tool
{
    public function __construct(
        private SproutSocialService $service,
    ) {}

    public function name(): string
    {
        return 'sproutsocial_get_message';
    }

    public function description(): string
    {
        return 'Get details of a specific message in Sprout Social by its ID. Returns sender info, message content, attachments, and conversation metadata.';
    }

    public function parameters(): array
    {
        return [
            'messageId' => ['type' => 'string', 'required' => true, 'description' => 'The message ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sprout Social integration is not configured.');
            }

            $result = $this->service->getMessage($args['messageId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
