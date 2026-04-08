<?php

namespace OpenCompany\Integrations\Fal\Tools;

use OpenCompany\Integrations\Fal\FalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List available fal.ai models.
 *
 * Returns a list of models available on the fal.ai platform with their
 * IDs, descriptions, and supported capabilities.
 */
class FalListModels implements Tool
{
    public function __construct(
        private FalService $service,
    ) {}

    public function name(): string
    {
        return 'fal_list_models';
    }

    public function description(): string
    {
        return 'List available fal.ai models. Returns model IDs, descriptions, and capabilities.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('fal.ai integration is not configured.');
            }

            $result = $this->service->listModels();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
