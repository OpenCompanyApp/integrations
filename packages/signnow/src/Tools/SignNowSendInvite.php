<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\Integrations\SignNow\SignNowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a SignNow signing invite.
 */
class SignNowSendInvite implements Tool
{
    /**
     * @param SignNowService $service The SignNow API service instance
     */
    public function __construct(
        private SignNowService $service,
    ) {}

    /**
     * Unique tool identifier.
     */
    public function name(): string
    {
        return 'signnow_send_invite';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Send a signing invitation for a SignNow document. The recipient will receive an email with a link to review and sign the document.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique document identifier to send an invite for.'],
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Recipient email address for the signing invite.'],
            'from' => ['type' => 'string', 'required' => true, 'description' => 'Sender email address (must be the authenticated user email).'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Email subject line for the signing invitation.'],
            'message' => ['type' => 'string', 'description' => 'Optional custom message body for the invitation email.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official invite fields.'],
        ];
    }

    /**
     * Execute the send invite tool call.
     *
     * @param array<string, mixed> $args Tool arguments
     * @return ToolResult The result confirming the invite was sent or error
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SignNow integration is not configured.');
            }

            if (empty($args['document_id'])) {
                return ToolResult::error('document_id is required.');
            }
            if (empty($args['to'])) {
                return ToolResult::error('to (recipient email) is required.');
            }
            if (empty($args['from'])) {
                return ToolResult::error('from (sender email) is required.');
            }
            if (empty($args['subject'])) {
                return ToolResult::error('subject is required.');
            }

            $result = $this->service->sendInvite(
                $args['document_id'],
                $args['to'],
                $args['from'],
                $args['subject'],
                $args['message'] ?? null,
                is_array($args['payload'] ?? null) ? $args['payload'] : [],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
