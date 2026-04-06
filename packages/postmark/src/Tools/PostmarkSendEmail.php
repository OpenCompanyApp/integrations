<?php

namespace OpenCompany\Integrations\Postmark\Tools;

use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PostmarkSendEmail implements Tool
{
    public function __construct(
        private PostmarkService $service,
    ) {}

    public function name(): string
    {
        return 'postmark_send_email';
    }

    public function description(): string
    {
        return 'Send an email through Postmark. Supports HTML and/or plain text bodies. Optionally tag the email for analytics tracking.';
    }

    public function parameters(): array
    {
        return [
            'From' => ['type' => 'string', 'required' => true, 'description' => 'Sender email address (must be a verified sender signature). Example: "sender@example.com" or "Sender Name <sender@example.com>".'],
            'To' => ['type' => 'string', 'required' => true, 'description' => 'Recipient email address. Multiple recipients separated by commas. Example: "recipient@example.com" or "Name <recipient@example.com>".'],
            'Subject' => ['type' => 'string', 'required' => true, 'description' => 'Email subject line.'],
            'HtmlBody' => ['type' => 'string', 'description' => 'HTML email body. Provide this or TextBody (or both).'],
            'TextBody' => ['type' => 'string', 'description' => 'Plain text email body. Provide this or HtmlBody (or both).'],
            'Tag' => ['type' => 'string', 'description' => 'Tag for categorization and analytics (e.g., "welcome", "invoice").'],
            'Cc' => ['type' => 'string', 'description' => 'CC recipients (comma-separated).'],
            'Bcc' => ['type' => 'string', 'description' => 'BCC recipients (comma-separated).'],
            'ReplyTo' => ['type' => 'string', 'description' => 'Reply-to email address.'],
            'Headers' => ['type' => 'array', 'description' => 'Custom email headers as array of {"Name": "...", "Value": "..."} objects.'],
            'TrackOpens' => ['type' => 'boolean', 'description' => 'Enable open tracking (default: server setting).'],
            'TrackLinks' => ['type' => 'string', 'description' => 'Link tracking mode: "None", "HtmlAndText", "HtmlOnly", "TextOnly".'],
            'Attachments' => ['type' => 'array', 'description' => 'Array of attachments with Name, Content (base64), ContentType.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Postmark integration is not configured.');
            }

            if (empty($args['HtmlBody']) && empty($args['TextBody'])) {
                return ToolResult::error('At least one of HtmlBody or TextBody is required to send an email.');
            }

            $params = [
                'From' => $args['From'],
                'To' => $args['To'],
                'Subject' => $args['Subject'],
            ];

            // Optional body fields
            if (isset($args['HtmlBody'])) {
                $params['HtmlBody'] = $args['HtmlBody'];
            }
            if (isset($args['TextBody'])) {
                $params['TextBody'] = $args['TextBody'];
            }

            // Optional metadata
            if (isset($args['Tag'])) {
                $params['Tag'] = $args['Tag'];
            }
            if (isset($args['Cc'])) {
                $params['Cc'] = $args['Cc'];
            }
            if (isset($args['Bcc'])) {
                $params['Bcc'] = $args['Bcc'];
            }
            if (isset($args['ReplyTo'])) {
                $params['ReplyTo'] = $args['ReplyTo'];
            }
            if (isset($args['Headers'])) {
                $params['Headers'] = $args['Headers'];
            }

            // Optional tracking
            if (isset($args['TrackOpens'])) {
                $params['TrackOpens'] = (bool) $args['TrackOpens'];
            }
            if (isset($args['TrackLinks'])) {
                $params['TrackLinks'] = $args['TrackLinks'];
            }

            // Optional attachments
            if (isset($args['Attachments'])) {
                $params['Attachments'] = $args['Attachments'];
            }

            $result = $this->service->sendEmail($params);

            if (isset($result['ErrorCode']) && $result['ErrorCode'] !== 0) {
                return ToolResult::error("Postmark error ({$result['ErrorCode']}): " . ($result['Message'] ?? 'Unknown error'));
            }

            return ToolResult::success([
                'message' => 'Email sent successfully.',
                'message_id' => $result['MessageID'] ?? null,
                'submitted_at' => $result['SubmittedAt'] ?? null,
                'to' => $result['To'] ?? $args['To'],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
