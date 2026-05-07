<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Cancel all active Pushover emergency receipts with a shared tag.
 */
class PushoverCancelReceiptsByTag implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_cancel_receipts_by_tag';
    }

    public function description(): string
    {
        return 'Cancel retry notifications for active emergency-priority messages that were sent with a matching tag.';
    }

    public function parameters(): array
    {
        return [
            'tag' => ['type' => 'string', 'required' => true, 'description' => 'Emergency message tag to cancel.'],
        ];
    }

    /**
     * Cancel emergency retries by tag.
     *
     * @param  array<string, mixed>  $args  Tool arguments (tag).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            $tag = $args['tag'] ?? '';
            if ($tag === '') {
                return ToolResult::error('tag is required.');
            }

            return ToolResult::success($this->service->cancelReceiptsByTag($tag));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
