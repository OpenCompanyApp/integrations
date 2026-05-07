<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

use OpenCompany\Integrations\MailerSend\MailerSendService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send an email through the MailerSend Email API.
 *
 * Supports the core send endpoint plus common optional fields such as template
 * IDs, personalization, tags, reply-to, CC/BCC, and scheduled sending.
 */
class MailerSendSendEmail implements Tool
{
    /**
     * Create a new MailerSendSendEmail tool instance.
     *
     *   MailerSendService  $service  The MailerSend API client.
     */
    public function __construct(
        private MailerSendService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'mailer_send_send_email';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Send an email through the MailerSend API. Requires a sender (from), one or more recipients (to), and a subject. Optionally provide HTML and/or plain text content.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'from' => [
                'type' => 'object',
                'required' => true,
                'description' => 'Sender object with "email" (required) and "name" (required) keys, e.g. {"email": "noreply@example.com", "name": "Acme Corp"}.',
            ],
            'to' => [
                'type' => 'array',
                'required' => true,
                'description' => 'Array of recipient objects, each with "email" (required) and optional "name" keys, e.g. [{"email": "user@example.com", "name": "John"}].',
            ],
            'subject' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The email subject line.',
            ],
            'html' => [
                'type' => 'string',
                'description' => 'HTML body content for the email.',
            ],
            'text' => [
                'type' => 'string',
                'description' => 'Plain text body content for the email.',
            ],
            'template_id' => [
                'type' => 'string',
                'description' => 'Optional MailerSend template ID.',
            ],
            'personalization' => [
                'type' => 'array',
                'description' => 'Optional personalization objects.',
                'items' => ['type' => 'object'],
            ],
            'tags' => [
                'type' => 'array',
                'description' => 'Optional message tags.',
                'items' => ['type' => 'string'],
            ],
            'reply_to' => [
                'type' => 'object',
                'description' => 'Optional reply-to object with email and name.',
            ],
            'cc' => [
                'type' => 'array',
                'description' => 'Optional CC recipient objects.',
                'items' => ['type' => 'object'],
            ],
            'bcc' => [
                'type' => 'array',
                'description' => 'Optional BCC recipient objects.',
                'items' => ['type' => 'object'],
            ],
            'attachments' => [
                'type' => 'array',
                'description' => 'Optional MailerSend attachment objects.',
                'items' => ['type' => 'object'],
            ],
            'send_at' => [
                'type' => 'integer',
                'description' => 'Optional Unix timestamp for scheduled sending.',
            ],
            'in_reply_to' => [
                'type' => 'string',
                'description' => 'Optional Message-ID this email replies to.',
            ],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MailerSend integration is not configured.');
            }

            $from = $args['from'] ?? [];
            $to = $args['to'] ?? [];
            $subject = $args['subject'] ?? '';

            if (empty($from) || !is_array($from) || empty($from['email'] ?? '')) {
                return ToolResult::error('The "from" parameter is required and must include an "email" key.');
            }

            if (empty($to) || !is_array($to)) {
                return ToolResult::error('The "to" parameter is required and must be a non-empty array of recipient objects.');
            }

            if (empty($subject)) {
                return ToolResult::error('The "subject" parameter is required.');
            }

            // Ensure "from" has a name fallback
            if (empty($from['name'])) {
                $from['name'] = $from['email'];
            }

            // Ensure each "to" entry has a name fallback
            $to = array_map(function (array $recipient): array {
                if (empty($recipient['name'])) {
                    $recipient['name'] = $recipient['email'];
                }
                return $recipient;
            }, $to);

            $html = $args['html'] ?? null;
            $text = $args['text'] ?? null;
            $options = [];

            foreach (['template_id', 'personalization', 'tags', 'reply_to', 'cc', 'bcc', 'attachments', 'send_at', 'in_reply_to'] as $field) {
                if (array_key_exists($field, $args) && $args[$field] !== null && $args[$field] !== '') {
                    $options[$field] = $args[$field];
                }
            }

            $result = $this->service->sendEmail($from, $to, $subject, $html, $text, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
