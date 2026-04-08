<?php

namespace OpenCompany\Integrations\Postmark\Tools;

use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific outbound message in Postmark.
 *
 * Returns message info including recipients, subject, status, and timestamps.
 */
class PostmarkGetMessage implements Tool
{
    /**
     * @param  PostmarkService  $service  The Postmark API client
     */
    public function __construct(
        private PostmarkService $service,
    ) {}

    public function name(): string
    {
        return 'postmark_get_message';
    }

    public function description(): string
    {
        return 'Get details for a specific Postmark outbound message including body, recipients, and delivery status.';
    }

    public function parameters(): array
    {
        return [
            'message_id' => ['type' => 'string', 'required' => true, 'description' => 'The Postmark message ID to look up.'],
        ];
    }

    /**
     * Get details for a specific Postmark message.
     *
     * @param  array<string, mixed>  $args  Tool arguments (message_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Postmark integration is not configured.');
            }

            $messageId = $args['message_id'] ?? '';

            if (empty($messageId)) {
                return ToolResult::error('message_id is required.');
            }

            $result = $this->service->getMessage($messageId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
