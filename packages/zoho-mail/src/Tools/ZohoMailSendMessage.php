<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\Integrations\ZohoMail\ZohoMailService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to send a new email message via Zoho Mail.
 *
 * Supports to, cc, bcc recipients, HTML or plain text content,
 * subject line, and in-reply-to for threading.
 *
 * @see https://www.zoho.com/mail/help/api/sendmail.html
 */
class ZohoMailSendMessage implements Tool
{
    /**
     * Create a new ZohoMailSendMessage tool instance.
     *
     * @param ZohoMailService $service The Zoho Mail service for API communication
     */
    public function __construct(
        private ZohoMailService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'zohomail_send_message';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Send a new email message via Zoho Mail. Supports to, cc, bcc, subject, and HTML or plain text content.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'accountId' => ['type' => 'string', 'required' => true, 'description' => 'The Zoho Mail account ID to send from.'],
            'toAddress' => ['type' => 'string', 'required' => true, 'description' => 'Recipient email address(es), comma-separated.'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Email subject line.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'Email body content (HTML or plain text).'],
            'ccAddress' => ['type' => 'string', 'description' => 'CC recipients, comma-separated.'],
            'bccAddress' => ['type' => 'string', 'description' => 'BCC recipients, comma-separated.'],
            'inReplyTo' => ['type' => 'string', 'description' => 'Message ID to reply to (for threading).'],
            'mailFormat' => ['type' => 'string', 'description' => 'Format of the content: "html" or "plaintext" (default: "html").'],
        ];
    }

    /**
     * Execute the send message tool.
     *
     * @param array<string, mixed> $args Tool arguments
     *
     * @return ToolResult The result confirming send or error
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Mail integration is not configured.');
            }

            $accountId = $args['accountId'] ?? '';
            if (empty($accountId)) {
                return ToolResult::error('accountId is required.');
            }

            $toAddress = $args['toAddress'] ?? '';
            $subject = $args['subject'] ?? '';
            $content = $args['content'] ?? '';

            if (empty($toAddress)) {
                return ToolResult::error('toAddress is required.');
            }
            if (empty($subject)) {
                return ToolResult::error('subject is required.');
            }
            if (empty($content)) {
                return ToolResult::error('content is required.');
            }

            $data = [
                'toAddress' => $toAddress,
                'subject' => $subject,
                'content' => $content,
            ];

            if (isset($args['ccAddress'])) {
                $data['ccAddress'] = $args['ccAddress'];
            }
            if (isset($args['bccAddress'])) {
                $data['bccAddress'] = $args['bccAddress'];
            }
            if (isset($args['inReplyTo'])) {
                $data['inReplyTo'] = $args['inReplyTo'];
            }
            if (isset($args['mailFormat'])) {
                $data['mailFormat'] = $args['mailFormat'];
            }

            $result = $this->service->sendMessage($accountId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
