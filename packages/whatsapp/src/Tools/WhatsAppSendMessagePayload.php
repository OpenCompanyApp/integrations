<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send an arbitrary WhatsApp message payload to the messages endpoint.
 *
 * Supports official Cloud API message types such as image, document, audio,
 * video, location, contacts, reaction, interactive, and template.
 */
class WhatsAppSendMessagePayload extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_send_message_payload';
    }

    public function description(): string
    {
        return 'Send any official WhatsApp Cloud API message payload to the configured phone number.';
    }

    public function parameters(): array
    {
        return [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Cloud API message payload without messaging_product.'],
        ];
    }

    /**
     * Send a raw message payload.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(function () use ($args): array {
            $payload = $this->arrayArg($args, 'payload');
            if ($payload === []) {
                throw new \InvalidArgumentException('payload is required.');
            }

            return $this->service->sendMessagePayload($payload);
        });
    }
}
