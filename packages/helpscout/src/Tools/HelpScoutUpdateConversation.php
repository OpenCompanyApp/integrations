<?php

namespace OpenCompany\Integrations\HelpScout\Tools;

use OpenCompany\Integrations\HelpScout\HelpScoutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class HelpScoutUpdateConversation implements Tool
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
        return 'helpscout_update_conversation';
    }

    /**
     * A description of what the tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'Update an existing HelpScout conversation. Change status, assignee, tags, subject, or other fields.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The conversation ID to update.'],
            'status' => ['type' => 'string', 'description' => 'New status: "open", "closed", "pending", or "spam".'],
            'subject' => ['type' => 'string', 'description' => 'Updated subject line.'],
            'assignee_id' => ['type' => 'integer', 'description' => 'User ID to assign. Use 0 to unassign.'],
            'mailbox_id' => ['type' => 'integer', 'description' => 'Move to a different mailbox.'],
            'tags' => ['type' => 'array', 'description' => 'Replace all tags (array of strings).'],
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

            $id = (int) $args['id'];
            $data = [];

            if (isset($args['status'])) {
                $data['status'] = $args['status'];
            }
            if (isset($args['subject'])) {
                $data['subject'] = $args['subject'];
            }
            if (isset($args['assignee_id'])) {
                $data['assignee'] = ['id' => (int) $args['assignee_id']];
            }
            if (isset($args['mailbox_id'])) {
                $data['mailboxId'] = (int) $args['mailbox_id'];
            }
            if (isset($args['tags'])) {
                $data['tags'] = $args['tags'];
            }

            if (empty($data)) {
                return ToolResult::error('No fields to update. Provide at least one of: status, subject, assignee_id, mailbox_id, tags.');
            }

            $this->service->updateConversation($id, $data);

            return ToolResult::success([
                'id' => $id,
                'updated' => true,
                'fields' => array_keys($data),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
