<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve an Intercom conversation by ID.
 *
 * Returns the full conversation including its message parts and metadata.
 */
class IntercomGetConversation implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_get_conversation';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve an Intercom conversation by its ID.
        Returns the full conversation including message parts, contacts, and metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Intercom conversation ID.'],
        ];
    }

    /**
     * Retrieve an Intercom conversation by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (conversation_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $id = $args['conversation_id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('conversation_id is required.');
            }

            $result = $this->service->getConversation($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
