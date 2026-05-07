<?php

namespace OpenCompany\Integrations\HuggingFace\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HuggingFace\HuggingFaceService;

/**
 * Call a relative Hugging Face Hub API GET endpoint.
 *
 * Intended for official Hub endpoints that are not yet wrapped as first-class tools.
 */
class HuggingFaceApiGet implements Tool
{
    /**
     * @param  HuggingFaceService  $service  Hugging Face Hub API client.
     */
    public function __construct(
        private HuggingFaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_api_get';
    }

    public function description(): string
    {
        return 'Call a relative Hugging Face Hub API GET path, such as "/models-tags-by-type". Absolute URLs are rejected.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Hub API path, with or without leading slash.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /**
     * Execute a relative GET request against the Hub API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, params)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hugging Face integration is not configured.');
            }

            if (empty($args['path'])) {
                return ToolResult::error('path is required.');
            }

            return ToolResult::success($this->service->apiGet((string) $args['path'], is_array($args['params'] ?? null) ? $args['params'] : []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
