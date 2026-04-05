<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send an email through Mailgun.
 *
 * Supports to, from, subject, text, html body, cc, bcc, and tags.
 */
class MailgunSendEmail implements Tool
{
    /**
     * @param  MailgunService  $service  The Mailgun API client
     */
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_send_email';
    }

    public function description(): string
    {
        return 'Send an email through Mailgun. Requires to, from, and subject. Provide either text or html body.';
    }

    public function parameters(): array
    {
        return [
            'to'      => ['type' => 'string', 'required' => true, 'description' => 'Recipient email address (comma-separated for multiple).'],
            'from'    => ['type' => 'string', 'required' => true, 'description' => 'Sender email address.'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Email subject line.'],
            'text'    => ['type' => 'string', 'description' => 'Plain-text body of the email.'],
            'html'    => ['type' => 'string', 'description' => 'HTML body of the email.'],
            'cc'      => ['type' => 'string', 'description' => 'CC recipient(s), comma-separated.'],
            'bcc'     => ['type' => 'string', 'description' => 'BCC recipient(s), comma-separated.'],
            'tags'    => ['type' => 'string', 'description' => 'Comma-separated tags for tracking.'],
        ];
    }

    /**
     * Send an email through Mailgun.
     *
     * @param  array<string, mixed>  $args  Tool arguments (to, from, subject, text, html, cc, bcc, tags)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $to = $args['to'] ?? '';
            $from = $args['from'] ?? '';
            $subject = $args['subject'] ?? '';

            if (empty($to)) {
                return ToolResult::error('to is required.');
            }
            if (empty($from)) {
                return ToolResult::error('from is required.');
            }
            if (empty($subject)) {
                return ToolResult::error('subject is required.');
            }

            $data = [
                'to'      => $to,
                'from'    => $from,
                'subject' => $subject,
            ];

            if (! empty($args['text'])) {
                $data['text'] = $args['text'];
            }
            if (! empty($args['html'])) {
                $data['html'] = $args['html'];
            }
            if (! empty($args['cc'])) {
                $data['cc'] = $args['cc'];
            }
            if (! empty($args['bcc'])) {
                $data['bcc'] = $args['bcc'];
            }
            if (! empty($args['tags'])) {
                $tags = is_array($args['tags']) ? $args['tags'] : array_map('trim', explode(',', $args['tags']));
                $data['o:tag'] = $tags;
            }

            $result = $this->service->sendEmail($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
