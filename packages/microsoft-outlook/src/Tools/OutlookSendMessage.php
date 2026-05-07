<?php

namespace OpenCompany\Integrations\MicrosoftOutlook\Tools;

use OpenCompany\Integrations\MicrosoftOutlook\OutlookService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: outlook_send_message
 *
 * Sends an email message via the Microsoft Graph /sendMail endpoint.
 */
class OutlookSendMessage implements Tool
{
    /**
     * @param  OutlookService  $service  The Outlook API service instance.
     */
    public function __construct(
        private OutlookService $service,
    ) {}

    /**
     * Machine-name of the tool.
     */
    public function name(): string
    {
        return 'outlook_send_message';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Send an email message via Outlook. Specify recipients, subject, and body. Supports HTML and plain-text bodies, CC, BCC, and reply-to addresses.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'to' => [
                'type'        => 'array',
                'required'    => true,
                'description' => 'Array of recipient email addresses, e.g. ["alice@example.com", "bob@example.com"].',
            ],
            'subject' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'The email subject line.',
            ],
            'body' => [
                'type'        => 'string',
                'required'    => true,
                'description' => 'The email body content.',
            ],
            'content_type' => [
                'type'        => 'string',
                'description' => 'Body content type: "HTML" (default) or "Text".',
            ],
            'cc' => [
                'type'        => 'array',
                'description' => 'Array of CC email addresses.',
            ],
            'bcc' => [
                'type'        => 'array',
                'description' => 'Array of BCC email addresses.',
            ],
            'reply_to' => [
                'type'        => 'array',
                'description' => 'Array of reply-to email addresses.',
            ],
        ];
    }

    /**
     * Execute the tool: send an email message.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft Outlook integration is not configured.');
            }

            foreach (['to', 'subject', 'body'] as $field) {
                if (empty($args[$field])) {
                    return ToolResult::error("{$field} is required.");
                }
            }

            if (!is_array($args['to'])) {
                return ToolResult::error('to must be an array of email addresses.');
            }

            $contentType = $args['content_type'] ?? 'HTML';

            if (!in_array($contentType, ['HTML', 'Text'], true)) {
                return ToolResult::error('content_type must be "HTML" or "Text".');
            }

            /** @var array<int, string> $toAddresses */
            $toAddresses = $args['to'];

            $message = [
                'subject' => $args['subject'],
                'body'    => [
                    'contentType' => $contentType,
                    'content'     => $args['body'],
                ],
                'toRecipients' => $this->formatAddresses($toAddresses),
            ];

            if (isset($args['cc'])) {
                if (!is_array($args['cc'])) {
                    return ToolResult::error('cc must be an array of email addresses.');
                }

                /** @var array<int, string> $ccAddresses */
                $ccAddresses = $args['cc'];
                $message['ccRecipients'] = $this->formatAddresses($ccAddresses);
            }

            if (isset($args['bcc'])) {
                if (!is_array($args['bcc'])) {
                    return ToolResult::error('bcc must be an array of email addresses.');
                }

                /** @var array<int, string> $bccAddresses */
                $bccAddresses = $args['bcc'];
                $message['bccRecipients'] = $this->formatAddresses($bccAddresses);
            }

            if (isset($args['reply_to'])) {
                if (!is_array($args['reply_to'])) {
                    return ToolResult::error('reply_to must be an array of email addresses.');
                }

                /** @var array<int, string> $replyToAddresses */
                $replyToAddresses = $args['reply_to'];
                $message['replyTo'] = $this->formatAddresses($replyToAddresses);
            }

            $payload = [
                'message'         => $message,
                'saveToSentItems' => true,
            ];

            $this->service->sendMessage($payload);

            return ToolResult::success('Message sent successfully.');
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format an array of email addresses into Graph API recipient objects.
     *
     * @param  array<int, string>  $addresses
     * @return array<int, array{emailAddress: array{address: string}}>
     */
    private function formatAddresses(array $addresses): array
    {
        return array_map(fn (string $email) => [
            'emailAddress' => ['address' => $email],
        ], $addresses);
    }
}
