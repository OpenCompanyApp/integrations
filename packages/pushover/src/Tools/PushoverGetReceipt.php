<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Get acknowledgement and retry details for a Pushover emergency receipt.
 */
class PushoverGetReceipt implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_get_receipt';
    }

    public function description(): string
    {
        return 'Get acknowledgement state, callback data, and retry status for an emergency-priority message receipt.';
    }

    public function parameters(): array
    {
        return [
            'receipt' => ['type' => 'string', 'required' => true, 'description' => 'Receipt ID returned when sending an emergency-priority message.'],
        ];
    }

    /**
     * Get a Pushover emergency receipt.
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

            return ToolResult::success($this->service->getReceipt($receipt));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
