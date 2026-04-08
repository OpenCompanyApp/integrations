<?php

namespace OpenCompany\Integrations\HelpScout\Tools;

use OpenCompany\Integrations\HelpScout\HelpScoutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HelpScoutCreateConversation implements Tool
{
    /**
     * @param  HelpScoutService  $service  The HelpScout API service instance.
     */
    public function __construct(
        private HelpScoutService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'helpscout_create_conversation';
    }

    /**
     * A description of what the tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'Create a new conversation in HelpScout. Requires a subject, customer, mailbox, and at least one thread (message or note).';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'The conversation subject line.'],
            'mailbox_id' => ['type' => 'integer', 'required' => true, 'description' => 'The mailbox ID to create the conversation in.'],
            'customer_id' => ['type' => 'integer', 'description' => 'The customer ID. Required unless customer_email is provided.'],
            'customer_email' => ['type' => 'string', 'description' => 'Customer email address. Used if customer_id is not provided.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'The content of the first message in the conversation.'],
            'type' => ['type' => 'string', 'description' => 'Conversation type: "email" (default) or "chat".'],
            'status' => ['type' => 'string', 'description' => 'Initial status: "open" (default), "pending", or "closed".'],
            'assignee_id' => ['type' => 'integer', 'description' => 'User ID to assign the conversation to.'],
            'tags' => ['type' => 'array', 'description' => 'Array of tag names to apply.'],
            'cc' => ['type' => 'array', 'description' => 'Array of email addresses to CC.'],
            'bcc' => ['type' => 'array', 'description' => 'Array of email addresses to BCC.'],
        ];
    }

    /**
     * Execute the tool call.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('HelpScout integration is not configured.');
            }

            $customer = [];
            if (isset($args['customer_id'])) {
                $customer['id'] = (int) $args['customer_id'];
            } elseif (isset($args['customer_email'])) {
                $customer['email'] = $args['customer_email'];
            } else {
                return ToolResult::error('Either customer_id or customer_email is required.');
            }

            $data = [
                'subject' => $args['subject'],
                'mailboxId' => (int) $args['mailbox_id'],
                'customer' => $customer,
                'threads' => [
                    [
                        'type' => 'customer',
                        'text' => $args['body'],
                        'customer' => $customer,
                    ],
                ],
            ];

            if (isset($args['type'])) {
                $data['type'] = $args['type'];
            }
            if (isset($args['status'])) {
                $data['status'] = $args['status'];
            }
            if (isset($args['assignee_id'])) {
                $data['assignee'] = ['id' => (int) $args['assignee_id']];
            }
            if (isset($args['tags'])) {
                $data['tags'] = $args['tags'];
            }
            if (isset($args['cc'])) {
                $data['cc'] = array_map(fn ($email) => ['email' => $email], $args['cc']);
            }
            if (isset($args['bcc'])) {
                $data['bcc'] = array_map(fn ($email) => ['email' => $email], $args['bcc']);
            }

            $result = $this->service->createConversation($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
