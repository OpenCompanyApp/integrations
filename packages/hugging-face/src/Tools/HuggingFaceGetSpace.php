<?php

namespace OpenCompany\Integrations\HuggingFace\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HuggingFace\HuggingFaceService;

/**
 * Get detailed information about a Hugging Face Space.
 *
 * Returns Hub metadata, SDK/runtime details, hardware state, and file siblings when available.
 */
class HuggingFaceGetSpace implements Tool
{
    /**
     * @param  HuggingFaceService  $service  Hugging Face Hub API client.
     */
    public function __construct(
        private HuggingFaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_get_space';
    }

    public function description(): string
    {
        return 'Get detailed information about a Hugging Face Space, including SDK, runtime, tags, likes, and files.';
    }

    public function parameters(): array
    {
        return [
            'space_id' => ['type' => 'string', 'required' => true, 'description' => 'Space ID, for example "organization/space-name".'],
        ];
    }

    /**
     * Fetch Space details from the Hub.
     *
     * @param  array<string, mixed>  $args  Tool arguments (space_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hugging Face integration is not configured.');
            }

            if (empty($args['space_id'])) {
                return ToolResult::error('space_id is required.');
            }

            return ToolResult::success($this->service->getSpace((string) $args['space_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
