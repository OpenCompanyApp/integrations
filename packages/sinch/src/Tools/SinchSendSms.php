<?php

namespace OpenCompany\Integrations\Sinch\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Sinch\SinchService;

/**
 * Send an SMS message to one or more recipients via Sinch.
 *
 * Accepts a single recipient or an array of recipients,
 * a sender phone number, and the message body.
 */
class SinchSendSms implements Tool
{
    /**
     * @param  SinchService  $service  The Sinch API client
     */
    public function __construct(
        private SinchService $service,
    ) {}

    public function name(): string
    {
        return 'sinch_send_sms';
    }

    public function description(): string
    {
        return 'Send an SMS message to one or more recipients via Sinch. Requires sender phone number, recipient(s), and message body.';
    }

    public function parameters(): array
    {
        return [
            'from' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Sender phone number or alphanumeric sender ID (E.164 format for numbers).',
            ],
            'to' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of recipient phone numbers in E.164 format (e.g. ["+1234567890"]).',
            ],
            'body' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The SMS message body text.',
            ],
            'delivery_report' => [
                'type' => 'string',
                'description' => 'Delivery report type: "none", "summary", or "full" (default "none").',
            ],
            'expire_at' => [
                'type' => 'string',
                'description' => 'Message expiration time in ISO 8601 format.',
            ],
            'send_at' => [
                'type' => 'string',
                'description' => 'Scheduled send time in ISO 8601 format.',
            ],
        ];
    }

    /**
     * Send an SMS via Sinch.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Sinch integration is not configured.');
            }

            $from = $args['from'] ?? '';
            $to = $args['to'] ?? [];
            $body = $args['body'] ?? '';

            if (empty($from)) {
                return ToolResult::error('from is required.');
            }
            if (empty($to)) {
                return ToolResult::error('to is required and must be a non-empty array of phone numbers.');
            }
            if (empty($body)) {
                return ToolResult::error('body is required.');
            }

            $data = [
                'from' => $from,
                'to' => is_array($to) ? $to : [$to],
                'body' => $body,
            ];

            if (isset($args['delivery_report'])) {
                $data['delivery_report'] = $args['delivery_report'];
            }
            if (isset($args['expire_at'])) {
                $data['expire_at'] = $args['expire_at'];
            }
            if (isset($args['send_at'])) {
                $data['send_at'] = $args['send_at'];
            }

            $result = $this->service->sendSms($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
