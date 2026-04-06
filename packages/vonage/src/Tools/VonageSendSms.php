<?php

namespace OpenCompany\Integrations\Vonage\Tools;

use OpenCompany\Integrations\Vonage\VonageService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VonageSendSms implements Tool
{
    /**
     * Create a new VonageSendSms tool instance.
     */
    public function __construct(
        private VonageService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'vonage_send_sms';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Send an SMS message via Vonage. Provide sender, recipient, and message text. The recipient number must be in E.164 format (e.g., 14155552671).';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'from' => ['type' => 'string', 'required' => true, 'description' => 'Sender ID or phone number (e.g., "VonageAPI" or a purchased number).'],
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Recipient phone number in E.164 format (e.g., "14155552671").'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The SMS message body text.'],
            'type' => ['type' => 'string', 'description' => 'Message type: "text" (default), "unicode", or "binary".'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vonage integration is not configured.');
            }

            $from = $args['from'];
            $to = $args['to'];
            $text = $args['text'];

            $extra = [];
            if (isset($args['type'])) {
                $extra['type'] = $args['type'];
            }

            $result = $this->service->sendSms($from, $to, $text, $extra);

            $messages = $result['messages'] ?? [];

            if (!empty($messages) && ($messages[0]['status'] ?? '1') !== '0') {
                $errorText = $messages[0]['error-text'] ?? 'Unknown error';

                return ToolResult::error("SMS failed: {$errorText}");
            }

            return ToolResult::success([
                'message_count' => count($messages),
                'messages' => array_map(function (array $msg): array {
                    return [
                        'to' => $msg['to'] ?? null,
                        'message_id' => $msg['message-id'] ?? null,
                        'status' => $msg['status'] ?? null,
                        'remaining_balance' => $msg['remaining-balance'] ?? null,
                    ];
                }, $messages),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
