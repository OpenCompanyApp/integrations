<?php

namespace OpenCompany\Integrations\Huggingface\Tools;

use OpenCompany\Integrations\Huggingface\HuggingfaceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a specific Hugging Face Space.
 *
 * Returns the Space card, metadata, SDK info, hardware, and runtime details.
 */
class HuggingfaceGetSpace implements Tool
{
    public function __construct(
        private HuggingfaceService $service,
    ) {}

    public function name(): string
    {
        return 'huggingface_get_space';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Hugging Face Space, including its SDK, hardware, runtime status, and settings.';
    }

    public function parameters(): array
    {
        return [
            'space_id' => ['type' => 'string', 'required' => true, 'description' => 'The Space ID (e.g. "stabilityai/stable-diffusion-3.5", "gradio/chatbot").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hugging Face integration is not configured.');
            }

            if (empty($args['space_id'])) {
                return ToolResult::error('space_id is required.');
            }

            $result = $this->service->getSpace($args['space_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
