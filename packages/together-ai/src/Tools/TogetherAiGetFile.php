<?php

namespace OpenCompany\Integrations\TogetherAi\Tools;

use OpenCompany\Integrations\TogetherAi\TogetherAiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific file on Together AI.
 *
 * Returns metadata about the file including its name, size,
 * purpose, and creation timestamp.
 */
class TogetherAiGetFile implements Tool
{
    public function __construct(
        private TogetherAiService $service,
    ) {}

    public function name(): string
    {
        return 'togetherai_get_file';
    }

    public function description(): string
    {
        return 'Get details of a specific file on Together AI. Returns file metadata including name, size, purpose, and creation date.';
    }

    public function parameters(): array
    {
        return [
            'file_id' => ['type' => 'string', 'required' => true, 'description' => 'The file ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Together AI integration is not configured.');
            }

            if (empty($args['file_id'])) {
                return ToolResult::error('file_id is required.');
            }

            $result = $this->service->getFile($args['file_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
