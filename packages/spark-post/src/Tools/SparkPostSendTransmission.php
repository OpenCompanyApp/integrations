<?php

namespace OpenCompany\Integrations\SparkPost\Tools;

use OpenCompany\Integrations\SparkPost\SparkPostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: SparkPostSendTransmission
 *
 * Sends an email transmission via SparkPost. Requires a "from" address,
 * subject, and at least one recipient. Supports HTML and/or plain text
 * content.
 */
class SparkPostSendTransmission implements Tool
{
    /**
     * @param  SparkPostService  $service  The SparkPost API service instance.
     */
    public function __construct(
        private SparkPostService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'spark_post_send_transmission';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'Send an email transmission via SparkPost. Provide sender address, subject, content (HTML and/or text), and a list of recipients.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'content' => [
                'type' => 'object',
                'required' => true,
                'description' => 'Email content object. Must include "from" (email address or object with "email" and "name") and "subject". Optionally include "html" and/or "text" for the email body.',
            ],
            'recipients' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of recipient objects. Each must have an "address" object with an "email" field (and optional "name"). Example: [{"address": {"email": "user@example.com", "name": "User"}}]',
            ],
        ];
    }

    /**
     * Execute the tool — send a transmission.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return ToolResult The transmission result with acceptance info.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SparkPost integration is not configured.');
            }

            $content = $args['content'] ?? [];
            $recipients = $args['recipients'] ?? [];

            if (empty($content)) {
                return ToolResult::error('The "content" parameter is required.');
            }

            if (empty($content['from'])) {
                return ToolResult::error('The "content.from" field is required — provide a sender email address.');
            }

            if (empty($content['subject'])) {
                return ToolResult::error('The "content.subject" field is required.');
            }

            if (empty($recipients)) {
                return ToolResult::error('The "recipients" parameter is required — provide at least one recipient.');
            }

            $payload = [
                'content' => $content,
                'recipients' => $recipients,
            ];

            $result = $this->service->sendTransmission($payload);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
