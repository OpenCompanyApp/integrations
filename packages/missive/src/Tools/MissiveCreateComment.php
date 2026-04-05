<?php

namespace OpenCompany\Integrations\Missive\Tools;

use OpenCompany\Integrations\Missive\MissiveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: missive_create_comment
 *
 * Add a comment to a Missive conversation.
 */
class MissiveCreateComment implements Tool
{
    /**
     * @param  MissiveService  $service  The Missive API service instance.
     */
    public function __construct(
        private MissiveService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'missive_create_comment';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a comment on a Missive conversation. Use this to add internal notes or replies.';
    }

    /**
     * Define the accepted parameters.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'The UUID of the conversation to comment on.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'The comment body text. Supports Markdown.'],
            'assignees' => ['type' => 'array', 'description' => 'List of user IDs or emails to assign the comment to.'],
        ];
    }

    /**
     * Execute the tool — create a comment on a Missive conversation.
     *
     * @param  array<string, mixed>  $args  The input parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Missive integration is not configured.');
            }

            $conversationId = $args['conversation_id'] ?? '';
            $body = $args['body'] ?? '';

            if (empty($conversationId)) {
                return ToolResult::error('Conversation ID is required.');
            }
            if (empty($body)) {
                return ToolResult::error('Comment body is required.');
            }

            $data = [
                'conversation_id' => $conversationId,
                'body' => $body,
            ];

            if (isset($args['assignees'])) {
                $data['assignees'] = $args['assignees'];
            }

            $result = $this->service->createComment($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
