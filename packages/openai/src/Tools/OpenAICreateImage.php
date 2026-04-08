<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generate an image using DALL·E.
 *
 * Creates images from text prompts using DALL·E models.
 * Supports controlling size, quality, style, and response format.
 */
class OpenAICreateImage implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_create_image';
    }

    public function description(): string
    {
        return 'Generate an image from a text prompt using DALL·E.';
    }

    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'description' => 'Model ID (e.g., "dall-e-3", "dall-e-2"). Default: "dall-e-2".'],
            'prompt' => ['type' => 'string', 'required' => true, 'description' => 'Text description of the desired image.'],
            'n' => ['type' => 'integer', 'description' => 'Number of images to generate (1-10 for DALL·E 2, only 1 for DALL·E 3).'],
            'size' => ['type' => 'string', 'description' => 'Image size: "256x256", "512x512", "1024x1024", "1024x1792", "1792x1024".'],
            'quality' => ['type' => 'string', 'description' => 'Image quality: "standard" or "hd" (DALL·E 3 only).'],
            'style' => ['type' => 'string', 'description' => 'Image style: "vivid" or "natural" (DALL·E 3 only).'],
            'response_format' => ['type' => 'string', 'description' => 'Response format: "url" or "b64_json".'],
        ];
    }

    /**
     * Generate an image from a text prompt.
     *
     * @param  array<string, mixed>  $args  Tool arguments (model, prompt, n, size, etc.)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $prompt = $args['prompt'] ?? '';

            if (empty($prompt)) {
                return ToolResult::error('prompt is required.');
            }

            $data = ['prompt' => $prompt];

            if (isset($args['model'])) {
                $data['model'] = $args['model'];
            }
            if (isset($args['n'])) {
                $data['n'] = (int) $args['n'];
            }
            if (isset($args['size'])) {
                $data['size'] = $args['size'];
            }
            if (isset($args['quality'])) {
                $data['quality'] = $args['quality'];
            }
            if (isset($args['style'])) {
                $data['style'] = $args['style'];
            }
            if (isset($args['response_format'])) {
                $data['response_format'] = $args['response_format'];
            }

            $result = $this->service->createImage($data);

            return ToolResult::success([
                'created' => $result['created'] ?? 0,
                'data' => $result['data'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
