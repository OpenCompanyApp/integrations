<?php

namespace OpenCompany\Integrations\Postmark\Tools;

use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send an email through Postmark.
 *
 * Supports To, From, Subject, TextBody, HtmlBody, Cc, Bcc, Tag, and ReplyTo.
 */
class PostmarkSendEmail implements Tool
{
    /**
     * @param  PostmarkService  $service  The Postmark API client
     */
    public function __construct(
        private PostmarkService $service,
    ) {}

    public function name(): string
    {
        return 'postmark_send_email';
    }

    public function description(): string
    {
        return 'Send an email through Postmark. Requires To, From, and Subject. Provide either TextBody or HtmlBody.';
    }

    public function parameters(): array
    {
        return [
            'To'        => ['type' => 'string', 'required' => true, 'description' => 'Recipient email address.'],
            'From'      => ['type' => 'string', 'required' => true, 'description' => 'Sender email address (must be a verified sender signature).'],
            'Subject'   => ['type' => 'string', 'required' => true, 'description' => 'Email subject line.'],
            'TextBody'  => ['type' => 'string', 'description' => 'Plain-text body of the email.'],
            'HtmlBody'  => ['type' => 'string', 'description' => 'HTML body of the email.'],
            'Cc'        => ['type' => 'string', 'description' => 'CC recipient(s), comma-separated.'],
            'Bcc'       => ['type' => 'string', 'description' => 'BCC recipient(s), comma-separated.'],
            'Tag'       => ['type' => 'string', 'description' => 'Tag for categorization and tracking.'],
            'ReplyTo'   => ['type' => 'string', 'description' => 'Reply-To email address.'],
        ];
    }

    /**
     * Send an email through Postmark.
     *
     * @param  array<string, mixed>  $args  Tool arguments (To, From, Subject, TextBody, HtmlBody, Cc, Bcc, Tag, ReplyTo)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Postmark integration is not configured.');
            }

            $to = $args['To'] ?? '';
            $from = $args['From'] ?? '';
            $subject = $args['Subject'] ?? '';

            if (empty($to)) {
                return ToolResult::error('To is required.');
            }
            if (empty($from)) {
                return ToolResult::error('From is required.');
            }
            if (empty($subject)) {
                return ToolResult::error('Subject is required.');
            }

            $data = [
                'To'      => $to,
                'From'    => $from,
                'Subject' => $subject,
            ];

            if (! empty($args['TextBody'])) {
                $data['TextBody'] = $args['TextBody'];
            }
            if (! empty($args['HtmlBody'])) {
                $data['HtmlBody'] = $args['HtmlBody'];
            }
            if (! empty($args['Cc'])) {
                $data['Cc'] = $args['Cc'];
            }
            if (! empty($args['Bcc'])) {
                $data['Bcc'] = $args['Bcc'];
            }
            if (! empty($args['Tag'])) {
                $data['Tag'] = $args['Tag'];
            }
            if (! empty($args['ReplyTo'])) {
                $data['ReplyTo'] = $args['ReplyTo'];
            }

            $result = $this->service->sendEmail($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
