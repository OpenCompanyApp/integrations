<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all OpenAI assistants.
 *
 * Returns a paginated list of assistants available to the authenticated user.
 */
class OpenAIListAssistants implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_list_assistants';
    }

    public function description(): string
    {
        return 'List all OpenAI assistants available to the authenticated user.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of assistants to return (default 20, max 100).'],
        ];
    }

    /**
     * List assistants with optional limit.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listAssistants($params);

            return ToolResult::success([
                'object' => $result['object'] ?? '',
                'data' => $result['data'] ?? [],
                'first_id' => $result['first_id'] ?? null,
                'last_id' => $result['last_id'] ?? null,
                'has_more' => $result['has_more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
