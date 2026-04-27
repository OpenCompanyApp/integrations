<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Instantly\InstantlyService;

/**
 * Send a preview/test email from a connected email account.
 *
 * The message is sent without creating an email entity in Unibox.
 */
class InstantlySendTestEmail implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_send_test_email';
    }

    public function description(): string
    {
        return 'Send a preview/test email from a connected email account without creating an Unibox email.';
    }

    public function parameters(): array
    {
        return [
            'eaccount' => ['type' => 'string', 'required' => true, 'description' => 'Connected sender email account'],
            'to_address_email_list' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated recipient email addresses'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Test email subject'],
            'html' => ['type' => 'string', 'required' => true, 'description' => 'HTML body of the test email'],
            'text' => ['type' => 'string', 'required' => false, 'description' => 'Optional text body'],
        ];
    }

    /**
     * Send a test email.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $body = ['html' => $args['html']];
            if (isset($args['text'])) {
                $body['text'] = $args['text'];
            }

            $result = $this->service->sendTestEmail([
                'eaccount' => $args['eaccount'],
                'to_address_email_list' => $args['to_address_email_list'],
                'subject' => $args['subject'],
                'body' => $body,
            ]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
