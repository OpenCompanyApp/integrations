<?php

namespace OpenCompany\Integrations\Hootsuite\Tools;

use OpenCompany\Integrations\Hootsuite\HootsuiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create (schedule) a new message in Hootsuite.
 *
 * Schedules a social media message to be posted at a specified time
 * to one or more social profiles.
 */
class HootsuiteCreateMessage implements Tool
{
    public function __construct(
        private HootsuiteService $service,
    ) {}

    public function name(): string
    {
        return 'hootsuite_create_message';
    }

    public function description(): string
    {
        return 'Schedule a new social media message in Hootsuite. Provide the text content, target social profile IDs, and the scheduled send time.';
    }

    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The message text content to post.'],
            'socialProfileIds' => ['type' => 'array', 'required' => true, 'description' => 'Array of social profile IDs to publish the message to.'],
            'scheduledSendTime' => ['type' => 'string', 'required' => true, 'description' => 'ISO 8601 timestamp for when the message should be sent (e.g., "2025-02-01T09:00:00Z").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hootsuite integration is not configured.');
            }

            if (empty($args['socialProfileIds'])) {
                return ToolResult::error('At least one socialProfileId is required.');
            }

            $result = $this->service->createMessage(
                text: $args['text'],
                socialProfileIds: $args['socialProfileIds'],
                scheduledSendTime: $args['scheduledSendTime'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
