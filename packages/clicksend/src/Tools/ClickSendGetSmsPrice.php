<?php

namespace OpenCompany\Integrations\ClickSend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ClickSend\ClickSendService;

/**
 * Get pricing for SMS messages before sending via ClickSend.
 *
 * Accepts the same message format as send SMS and returns
 * the estimated cost without actually sending messages.
 */
class ClickSendGetSmsPrice implements Tool
{
    /**
     * @param  ClickSendService  $service  The ClickSend API client
     */
    public function __construct(
        private ClickSendService $service,
    ) {}

    public function name(): string
    {
        return 'clicksend_get_sms_price';
    }

    public function description(): string
    {
        return 'Get pricing for SMS messages before sending. Uses the same message format as send SMS but returns cost estimates only.';
    }

    public function parameters(): array
    {
        return [
            'messages' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of message objects. Each object must have "to" (phone number) and "body" (text). Optional: "from" (sender ID).',
            ],
        ];
    }

    /**
     * Get SMS pricing from ClickSend.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing 'messages' array
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickSend integration is not configured.');
            }

            $messages = $args['messages'] ?? [];

            if (empty($messages)) {
                return ToolResult::error('messages is required and must be a non-empty array.');
            }

            $result = $this->service->getSmsPrice($messages);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
