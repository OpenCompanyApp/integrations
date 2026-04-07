<?php

namespace OpenCompany\Integrations\TogetherAi\Tools;

use OpenCompany\Integrations\TogetherAi\TogetherAiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List files uploaded to Together AI.
 *
 * Returns all files associated with the authenticated account,
 * including training data, validation data, and result files.
 */
class TogetherAiListFiles implements Tool
{
    public function __construct(
        private TogetherAiService $service,
    ) {}

    public function name(): string
    {
        return 'togetherai_list_files';
    }

    public function description(): string
    {
        return 'List all files uploaded to Together AI. Returns file IDs, filenames, sizes, and purposes (e.g. fine-tune training data, results).';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Together AI integration is not configured.');
            }

            $result = $this->service->listFiles();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
