<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a custom prompt template.
 */
class InstantlyUpdateCustomPromptTemplate implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_update_custom_prompt_template';
    }

    public function description(): string
    {
        return 'Update a custom prompt template.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Template ID'],
            'name' => ['type' => 'string', 'required' => false, 'description' => 'Name'],
            'prompt' => ['type' => 'string', 'required' => false, 'description' => 'Prompt text'],
            'category' => ['type' => 'integer', 'required' => false, 'description' => 'Category'],
            'is_public' => ['type' => 'boolean', 'required' => false, 'description' => 'Public'],
            'description' => ['type' => 'string', 'required' => false, 'description' => 'Description'],
            'model_version' => ['type' => 'string', 'required' => false, 'description' => 'Model version'],
            'template_type' => ['type' => 'string', 'required' => false, 'description' => 'Type'],
            'from_shared' => ['type' => 'boolean', 'required' => false, 'description' => 'From shared'],
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

            $body = []; foreach (['name','prompt','description','model_version','template_type'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; foreach (['category'] as $k) if (isset($args[$k])) $body[$k] = (int)$args[$k]; foreach (['is_public','from_shared'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $result = $this->service->updateCustomPromptTemplate($args['id'], $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
