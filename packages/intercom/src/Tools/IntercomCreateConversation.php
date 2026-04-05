<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new conversation in Intercom.
 *
 * Creates a conversation initiated by a user with an initial message body.
 */
class IntercomCreateConversation implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_create_conversation';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new conversation in Intercom.
        Requires a user_id (Intercom contact ID) and a message body.
        Returns the created conversation with its ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'Intercom contact ID (user) to create the conversation for.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'Initial message body for the conversation.'],
        ];
    }

    /**
     * Create a new Intercom conversation for a user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_id, body)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $userId = $args['user_id'] ?? '';
            if (empty($userId)) {
                return ToolResult::error('user_id is required.');
            }

            $body = $args['body'] ?? '';
            if (empty($body)) {
                return ToolResult::error('body is required.');
            }

            $result = $this->service->createConversation([
                'from' => ['type' => 'user', 'id' => $userId],
                'body' => $body,
            ]);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'created_at' => $result['created_at'] ?? '',
                'updated_at' => $result['updated_at'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
