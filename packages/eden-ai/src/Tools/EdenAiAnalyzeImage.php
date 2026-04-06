<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

use OpenCompany\Integrations\EdenAi\EdenAiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Analyze images using AI models through Eden AI.
 *
 * Sends an image analysis request to one or more AI providers via the
 * Eden AI aggregation API. Supports features like object detection,
 * explicit content detection, and scene description.
 */
class EdenAiAnalyzeImage implements Tool
{
    public function __construct(
        private EdenAiService $service,
    ) {}

    public function name(): string
    {
        return 'edenai_analyze_image';
    }

    public function description(): string
    {
        return 'Analyze images using AI models via Eden AI. Supports object detection, explicit content detection, scene description, and more. Provide an image as a URL or base64-encoded string.';
    }

    public function parameters(): array
    {
        return [
            'providers' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated list of AI providers (e.g., "google", "amazon", "microsoft").'],
            'image_url' => ['type' => 'string', 'description' => 'URL of the image to analyze. Use this OR image_base64, not both.'],
            'image_base64' => ['type' => 'string', 'description' => 'Base64-encoded image data. Use this OR image_url, not both.'],
            'features' => ['type' => 'array', 'description' => 'Analysis features to request (e.g., ["explicit_content", "object_detection", "scene_classification"]).'],
            'fallback_providers' => ['type' => 'string', 'description' => 'Comma-separated list of fallback providers if the primary fails.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Eden AI integration is not configured.');
            }

            $body = [
                'providers' => $args['providers'],
            ];

            if (isset($args['image_url'])) {
                $body['file_url'] = $args['image_url'];
            } elseif (isset($args['image_base64'])) {
                $body['base64_image'] = $args['image_base64'];
            } else {
                return ToolResult::error('Either "image_url" or "image_base64" is required.');
            }

            if (isset($args['features'])) {
                $body['features'] = $args['features'];
            }

            if (isset($args['fallback_providers'])) {
                $body['fallback_providers'] = $args['fallback_providers'];
            }

            $result = $this->service->analyzeImage($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
