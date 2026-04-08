<?php

namespace OpenCompany\Integrations\Front\Tools;

use OpenCompany\Integrations\Front\FrontService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FrontCreateMessage implements Tool
{
    public function __construct(
        private FrontService $service,
    ) {}

    public function name(): string
    {
        return 'front_create_message';
    }

    public function description(): string
    {
        return 'Create and send a new message through Front. Supports sending emails, tweets, and other channel messages. The message is sent on behalf of the authenticated user or a specified sender.';
    }

    public function parameters(): array
    {
        return [
            'to' => ['type' => 'array', 'required' => true, 'description' => 'List of recipients. Each entry should have "handle" (email address or handle) and optionally "name". Example: [{"handle": "user@example.com", "name": "John Doe"}].'],
            'subject' => ['type' => 'string', 'description' => 'Message subject line (required for email messages).'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'Message body content in HTML or plain text.'],
            'from' => ['type' => 'string', 'description' => 'Sender alias or email address. If omitted, uses the default sender for the channel.'],
            'channel_id' => ['type' => 'string', 'description' => 'The channel ID to send the message through. Required for non-email channels.'],
            'inbox_id' => ['type' => 'string', 'description' => 'The inbox ID to create the message in. If omitted, Front auto-selects based on the channel.'],
            'cc' => ['type' => 'array', 'description' => 'CC recipients. Same format as "to".'],
            'bcc' => ['type' => 'array', 'description' => 'BCC recipients. Same format as "to".'],
            'attachments' => ['type' => 'array', 'description' => 'List of attachments. Each entry should have "filename", "content_type", and "data" (base64-encoded).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Front integration is not configured.');
            }

            if (empty($args['to'])) {
                return ToolResult::error('At least one recipient ("to") is required.');
            }

            if (empty($args['body'])) {
                return ToolResult::error('Message body is required.');
            }

            $data = [];

            // Recipients
            $data['to'] = $args['to'];

            // Subject
            if (isset($args['subject'])) {
                $data['subject'] = $args['subject'];
            }

            // Body
            $data['body'] = $args['body'];

            // Optional fields
            if (isset($args['from'])) {
                $data['from'] = $args['from'];
            }
            if (isset($args['channel_id'])) {
                $data['channel_id'] = $args['channel_id'];
            }
            if (isset($args['inbox_id'])) {
                $data['inbox_id'] = $args['inbox_id'];
            }
            if (isset($args['cc'])) {
                $data['cc'] = $args['cc'];
            }
            if (isset($args['bcc'])) {
                $data['bcc'] = $args['bcc'];
            }
            if (isset($args['attachments'])) {
                $data['attachments'] = $args['attachments'];
            }

            $result = $this->service->createMessage($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
