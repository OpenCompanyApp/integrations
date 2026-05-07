<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

use OpenCompany\Integrations\Anthropic\AnthropicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List messages in the Anthropic conversation history.
 *
 * Sends a GET request to /messages with optional query parameters
 * for filtering and pagination. Returns a paginated list of message
 * resources.
 *
 * @see https://docs.anthropic.com/en/api/list-messages
 */
class AnthropicListMessages implements Tool
{
    /**
     * @param  AnthropicService  $service  The Anthropic service instance.
     */
    public function __construct(
        private AnthropicService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'anthropic_list_messages';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List messages in the Anthropic conversation history. Returns paginated message resources with optional filtering by model, date, and ID.';
    }

    /**
     * Parameter schema for the list messages request.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'description' => 'Filter messages by model ID (e.g., "claude-sonnet-4-20250514").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of messages to return per page (default: 20, max: 1000).'],
            'before_id' => ['type' => 'string', 'description' => 'Message ID used for cursor-based pagination - return messages before this ID.'],
            'after_id' => ['type' => 'string', 'description' => 'Message ID used for cursor-based pagination - return messages after this ID.'],
        ];
    }

    /**
     * Execute the list messages request.
     *
     * @param  array  $args  The query parameters.
     * @return ToolResult The paginated list of messages or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Anthropic integration is not configured.');
            }

            $params = [];

            $optionalKeys = ['model', 'limit', 'before_id', 'after_id'];

            foreach ($optionalKeys as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listMessages($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
