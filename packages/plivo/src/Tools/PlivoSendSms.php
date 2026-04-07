<?php

namespace OpenCompany\Integrations\Plivo\Tools;

use OpenCompany\Integrations\Plivo\PlivoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for sending SMS messages via the Plivo API.
 *
 * Accepts a source number, one or more destination numbers, and the message text.
 * Returns the message UUID upon successful dispatch.
 *
 * @see https://www.plivo.com/docs/sms/api/message#send-a-message
 */
class PlivoSendSms implements Tool
{
    /**
     * Create a new PlivoSendSms tool instance.
     *
     * @param  PlivoService  $service  The Plivo API service instance.
     */
    public function __construct(
        private PlivoService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'plivo_send_sms';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Send an SMS message via Plivo. Specify a source phone number (must be a Plivo number), one or more destination numbers, and the message text. Returns the message UUID and details.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'src' => ['type' => 'string', 'required' => true, 'description' => 'The source phone number (must be a Plivo-hosted number, e.g., "+14155552671").'],
            'dst' => ['type' => 'string', 'required' => true, 'description' => 'Destination phone number(s). Use a single number or multiple numbers separated by "<" (e.g., "+14155552671" or "+14155552671<+14155552672").'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'The SMS message text content.'],
            'type' => ['type' => 'string', 'description' => 'Message type: "sms" (default) or "mms".'],
            'url' => ['type' => 'string', 'description' => 'Webhook URL to receive delivery status callbacks.'],
            'log' => ['type' => 'boolean', 'description' => 'Whether to log the message in Plivo (default: true).'],
        ];
    }

    /**
     * Execute the send SMS tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments containing source, destination, and text.
     * @return ToolResult The result containing the message UUID or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plivo integration is not configured.');
            }

            $data = [
                'src' => $args['src'],
                'dst' => $args['dst'],
                'text' => $args['text'],
            ];

            if (isset($args['type'])) {
                $data['type'] = $args['type'];
            }
            if (isset($args['url'])) {
                $data['url'] = $args['url'];
            }
            if (isset($args['log'])) {
                $data['log'] = $args['log'];
            }

            $result = $this->service->sendMessage($data);

            return ToolResult::success([
                'message' => 'SMS sent successfully.',
                'message_uuid' => $result['message_uuid'] ?? $result['message_uuids'] ?? null,
                'api_id' => $result['api_id'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
