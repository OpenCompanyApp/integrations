<?php

namespace OpenCompany\Integrations\ClickSend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ClickSend\ClickSendService;

/**
 * Send one or more voice messages via ClickSend.
 *
 * Each message requires a recipient phone number and body text.
 * Optional parameters include voice type and language selection.
 */
class ClickSendSendVoice implements Tool
{
    /**
     * @param  ClickSendService  $service  The ClickSend API client
     */
    public function __construct(
        private ClickSendService $service,
    ) {}

    public function name(): string
    {
        return 'clicksend_send_voice';
    }

    public function description(): string
    {
        return 'Send one or more voice messages via ClickSend. Each message requires a "to" phone number and "body" text.';
    }

    public function parameters(): array
    {
        return [
            'messages' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of voice message objects. Each object must have "to" (phone number) and "body" (text). Optional: "voice" (voice type), "lang" (language code).',
            ],
        ];
    }

    /**
     * Send voice messages via ClickSend.
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

            $result = $this->service->sendVoice($messages);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
