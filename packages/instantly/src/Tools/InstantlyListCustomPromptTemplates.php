<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List custom prompt templates.
 */
class InstantlyListCustomPromptTemplates implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_list_custom_prompt_templates';
    }

    public function description(): string
    {
        return 'List custom prompt templates.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Items per page'],
            'starting_after' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor'],
            'search' => ['type' => 'string', 'required' => false, 'description' => 'Search by name'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $params = []; foreach (['limit','starting_after','search'] as $k) if (isset($args[$k])) $params[$k] = $args[$k]; $result = $this->service->listCustomPromptTemplates($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
