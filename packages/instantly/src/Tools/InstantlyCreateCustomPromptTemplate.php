<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new custom prompt template for AI enrichment.
 */
class InstantlyCreateCustomPromptTemplate implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_custom_prompt_template';
    }

    public function description(): string
    {
        return 'Create a new custom prompt template for AI enrichment.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Template name'],
            'prompt' => ['type' => 'string', 'required' => true, 'description' => 'Prompt text with {{property}} placeholders'],
            'category' => ['type' => 'integer', 'required' => true, 'description' => '1=Copywriting,2=Cleaning,3=Sales,4=Marketing,5=Other,6=Personalization'],
            'is_public' => ['type' => 'boolean', 'required' => true, 'description' => 'Public visibility'],
            'description' => ['type' => 'string', 'required' => false, 'description' => 'Description'],
            'model_version' => ['type' => 'string', 'required' => false, 'description' => 'Model version'],
            'template_type' => ['type' => 'string', 'required' => false, 'description' => 'custom or public'],
            'from_shared' => ['type' => 'boolean', 'required' => false, 'description' => 'Cloned from shared'],
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

            $body = ['name' => $args['name'], 'prompt' => $args['prompt'], 'category' => (int)$args['category'], 'is_public' => $args['is_public']]; foreach (['description','model_version','template_type','from_shared'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $result = $this->service->createCustomPromptTemplate($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
