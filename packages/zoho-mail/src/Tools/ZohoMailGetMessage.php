<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\Integrations\ZohoMail\ZohoMailService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single email message by ID from Zoho Mail.
 *
 * Returns the full message details including body content, headers,
 * sender, recipients, and attachments.
 *
 * @see https://www.zoho.com/mail/help/api/getmessage.html
 */
class ZohoMailGetMessage implements Tool
{
    /**
     * Create a new ZohoMailGetMessage tool instance.
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
        return 'zohomail_get_message';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'Get a single email message from Zoho Mail by ID. Returns full message content, headers, and attachment info.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'accountId' => ['type' => 'string', 'required' => true, 'description' => 'The Zoho Mail account ID.'],
            'messageId' => ['type' => 'string', 'required' => true, 'description' => 'The message ID to retrieve.'],
        ];
    }

    /**
     * Execute the get message tool.
     *
     * @param array<string, mixed> $args Tool arguments
     *
     * @return ToolResult The result containing the message or error
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Mail integration is not configured.');
            }

            $accountId = $args['accountId'] ?? '';
            $messageId = $args['messageId'] ?? '';

            if (empty($accountId)) {
                return ToolResult::error('accountId is required.');
            }
            if (empty($messageId)) {
                return ToolResult::error('messageId is required.');
            }

            $result = $this->service->getMessage($accountId, $messageId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
