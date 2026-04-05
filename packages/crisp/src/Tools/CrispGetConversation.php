<?php

namespace OpenCompany\Integrations\Crisp\Tools;

use OpenCompany\Integrations\Crisp\CrispService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * CrispGetConversation — retrieve a single conversation with its messages.
 *
 * Returns the full conversation thread including message history,
 * participant details, and metadata.
 */
class CrispGetConversation implements Tool
{
    public function __construct(
        private CrispService $service,
    ) {}

    public function name(): string
    {
        return 'crisp_get_conversation';
    }

    public function description(): string
    {
        return 'Get details and messages of a specific Crisp conversation. Returns the full message thread including sender info, timestamps, and message content.';
    }

    public function parameters(): array
    {
        return [
            'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'The conversation session ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Crisp integration is not configured.');
            }

            if (empty($args['conversation_id'])) {
                return ToolResult::error('conversation_id is required.');
            }

            $result = $this->service->getConversation($args['conversation_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
