<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

use OpenCompany\Integrations\AmazonSes\AmazonSesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AmazonSesSendEmail implements Tool
{
    public function __construct(
        private AmazonSesService $service,
    ) {}

    public function name(): string
    {
        return 'amazonses_send_email';
    }

    public function description(): string
    {
        return 'Send an email via Amazon SES. Specify the sender, recipient(s), subject, and body (HTML and/or plain text). Optionally reference a template or add reply-to addresses.';
    }

    public function parameters(): array
    {
        return [
            'from_email_address' => ['type' => 'string', 'required' => true, 'description' => 'The sender email address (must be verified in SES). e.g., "sender@example.com" or "Sender Name <sender@example.com>".'],
            'destination' => ['type' => 'object', 'required' => true, 'description' => 'Recipient addresses. Object with "ToAddresses" (array), "CcAddresses" (array, optional), and "BccAddresses" (array, optional).'],
            'subject' => ['type' => 'string', 'description' => 'The email subject line. Required unless using a template.'],
            'html_body' => ['type' => 'string', 'description' => 'HTML content of the email body.'],
            'text_body' => ['type' => 'string', 'description' => 'Plain text content of the email body.'],
            'template_name' => ['type' => 'string', 'description' => 'Name of an existing SES email template to use. If provided, subject/html_body/text_body are ignored.'],
            'template_data' => ['type' => 'object', 'description' => 'Key-value pairs to substitute into the template placeholders.'],
            'reply_to_addresses' => ['type' => 'array', 'description' => 'List of email addresses for reply-to.'],
            'configuration_set_name' => ['type' => 'string', 'description' => 'The SES configuration set to associate with this email for tracking and analytics.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amazon SES integration is not configured.');
            }

            $body = [
                'FromEmailAddress' => $args['from_email_address'],
                'Destination' => $args['destination'],
            ];

            // Build email content
            $content = [];

            if (isset($args['template_name'])) {
                $content['Template'] = [
                    'TemplateName' => $args['template_name'],
                ];
                if (isset($args['template_data'])) {
                    $content['Template']['TemplateData'] = is_string($args['template_data'])
                        ? $args['template_data']
                        : json_encode($args['template_data']);
                }
            } else {
                $simple = [];
                if (isset($args['subject'])) {
                    $simple['Subject'] = ['Data' => $args['subject']];
                }
                if (isset($args['html_body'])) {
                    $simple['Body']['Html'] = ['Data' => $args['html_body']];
                }
                if (isset($args['text_body'])) {
                    $simple['Body']['Text'] = ['Data' => $args['text_body']];
                }
                $content['Simple'] = $simple;
            }

            $body['Content'] = $content;

            if (isset($args['reply_to_addresses'])) {
                $body['ReplyToAddresses'] = $args['reply_to_addresses'];
            }

            if (isset($args['configuration_set_name'])) {
                $body['ConfigurationSetName'] = $args['configuration_set_name'];
            }

            $result = $this->service->sendEmail($body);

            return ToolResult::success([
                'message' => 'Email sent successfully.',
                'message_id' => $result['MessageId'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
