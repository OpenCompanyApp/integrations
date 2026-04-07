<?php

namespace OpenCompany\Integrations\Replicate\Tools;

use OpenCompany\Integrations\Replicate\ReplicateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List available Replicate models.
 *
 * Returns a list of public models with their owner, name, description,
 * and latest version information. Use this to discover models for
 * creating predictions.
 */
class ReplicateListModels implements Tool
{
    public function __construct(
        private ReplicateService $service,
    ) {}

    public function name(): string
    {
        return 'replicate_list_models';
    }

    public function description(): string
    {
        return 'List available Replicate models. Returns model names, owners, descriptions, and latest version IDs.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Replicate integration is not configured.');
            }

            $result = $this->service->listModels();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
