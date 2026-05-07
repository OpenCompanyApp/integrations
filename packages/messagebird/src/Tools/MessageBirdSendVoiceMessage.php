<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * Send a MessageBird voice message.
 *
 * Transforms text into a voice call message for one or more recipients.
 */
class MessageBirdSendVoiceMessage implements Tool
{
    /**
     * @param  MessageBirdService  $service  The MessageBird REST API client
     */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string
    {
        return 'messagebird_send_voice_message';
    }

    public function description(): string
    {
        return 'Send a MessageBird text-to-speech voice message.';
    }

    public function parameters(): array
    {
        return [
            'originator' => ['type' => 'string', 'required' => true, 'description' => 'Sender phone number.'],
            'recipients' => ['type' => 'array', 'required' => true, 'description' => 'Recipient phone numbers or contact IDs.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'Voice message text.'],
            'options' => ['type' => 'object', 'description' => 'Optional voice settings such as language, voice, repeat, ifMachine, machineTimeout, scheduledDatetime.'],
        ];
    }

    /**
     * Send a voice message.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->sendVoiceMessage(
                (string) ($args['originator'] ?? ''),
                $args['recipients'] ?? [],
                (string) ($args['body'] ?? ''),
                $args['options'] ?? [],
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
