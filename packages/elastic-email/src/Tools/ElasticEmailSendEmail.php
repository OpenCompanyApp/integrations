<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

use OpenCompany\Integrations\ElasticEmail\ElasticEmailService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a transactional email through Elastic Email.
 */
class ElasticEmailSendEmail implements Tool
{
    /**
     * @param  ElasticEmailService  $service  Elastic Email API client.
     */
    public function __construct(
        private ElasticEmailService $service,
    ) {}

    public function name(): string
    {
        return 'elasticemail_send_email';
    }

    public function description(): string
    {
        return 'Send a transactional email via Elastic Email. Provide the recipient address, subject, and HTML body.';
    }

    public function parameters(): array
    {
        return [
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Recipient email address. For multiple recipients, separate with semicolons.'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Email subject line.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'HTML body content of the email.'],
            'from' => ['type' => 'string', 'description' => 'Sender email address (must be a verified sender in your Elastic Email account).'],
            'from_name' => ['type' => 'string', 'description' => 'Display name for the sender.'],
            'reply_to' => ['type' => 'string', 'description' => 'Reply-to email address.'],
            'cc' => ['type' => 'string', 'description' => 'CC recipients, separated by semicolons.'],
            'bcc' => ['type' => 'string', 'description' => 'BCC recipients, separated by semicolons.'],
        ];
    }

    /**
     * Execute the transactional email send.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Elastic Email integration is not configured.');
            }

            $options = [];
            foreach (['from', 'from_name', 'reply_to', 'cc', 'bcc'] as $key) {
                if (isset($args[$key])) {
                    $options[$key] = $args[$key];
                }
            }

            $result = $this->service->sendEmail(
                $args['to'],
                $args['subject'],
                $args['body'],
                $options,
            );

            return ToolResult::success([
                'message' => 'Email sent successfully.',
                'data' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
