<?php

namespace OpenCompany\Integrations\Postmark\Tools;

use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get outbound delivery statistics for the Postmark server.
 *
 * Returns sent, bounced, spam complaint, tracked, opened, and clicked counters.
 */
class PostmarkGetDeliveryStats implements Tool
{
    /**
     * @param  PostmarkService  $service  The Postmark API client
     */
    public function __construct(
        private PostmarkService $service,
    ) {}

    public function name(): string
    {
        return 'postmark_get_delivery_stats';
    }

    public function description(): string
    {
        return 'Get email delivery statistics for your Postmark server, including counts of sent, bounced, and spam complaints.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get delivery statistics for the configured server.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Postmark integration is not configured.');
            }

            $result = $this->service->getDeliveryStats();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
