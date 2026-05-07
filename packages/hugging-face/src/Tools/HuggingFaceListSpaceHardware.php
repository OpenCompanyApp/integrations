<?php

namespace OpenCompany\Integrations\HuggingFace\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\HuggingFace\HuggingFaceService;

/**
 * List Hugging Face Space hardware options.
 *
 * Returns the hardware identifiers and availability metadata exposed by the Hub.
 */
class HuggingFaceListSpaceHardware implements Tool
{
    /**
     * @param  HuggingFaceService  $service  Hugging Face Hub API client.
     */
    public function __construct(
        private HuggingFaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_list_space_hardware';
    }

    public function description(): string
    {
        return 'List Hugging Face Space hardware options for creating or upgrading Spaces.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch Space hardware options from the Hub.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hugging Face integration is not configured.');
            }

            return ToolResult::success($this->service->listSpaceHardware());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
