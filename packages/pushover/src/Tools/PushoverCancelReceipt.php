<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Cancel retries for an active Pushover emergency receipt.
 */
class PushoverCancelReceipt implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_cancel_receipt';
    }

    public function description(): string
    {
        return 'Cancel retry notifications for an active emergency-priority message receipt.';
    }

    public function parameters(): array
    {
        return [
            'receipt' => ['type' => 'string', 'required' => true, 'description' => 'Receipt ID returned when sending an emergency-priority message.'],
        ];
    }

    /**
     * Cancel retry notifications for one emergency receipt.
     *
     * @param  array<string, mixed>  $args  Tool arguments (receipt).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            $receipt = $args['receipt'] ?? '';
            if ($receipt === '') {
                return ToolResult::error('receipt is required.');
            }

            return ToolResult::success($this->service->cancelReceipt($receipt));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
