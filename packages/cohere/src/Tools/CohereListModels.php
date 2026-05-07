<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Cohere models available to the account.
 *
 * Supports pagination and endpoint/default filtering from the v1 Models API.
 */
class CohereListModels extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_list_models';
    }

    public function description(): string
    {
        return 'List Cohere models with optional pagination and endpoint/default filters.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'number', 'description' => 'Maximum models per page. Range: 1-1000. Default: 20.'],
            'page_token' => ['type' => 'string', 'description' => 'Token from next_page_token in a previous response.'],
            'endpoint' => ['type' => 'string', 'description' => 'Only return models compatible with this endpoint.'],
            'default_only' => ['type' => 'boolean', 'description' => 'Only return default models for the endpoint. Valid only when endpoint is provided.'],
        ];
    }

    /**
     * Execute the Cohere List Models API call.
     *
     * @param  array<string, mixed>  $args  Query parameters for model listing.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            return ToolResult::success($this->service->listModels($this->only($args, [
                'page_size',
                'page_token',
                'endpoint',
                'default_only',
            ])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
