<?php

namespace OpenCompany\Integrations\Bannerbear\Tools;

use OpenCompany\Integrations\Bannerbear\BannerbearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BannerbearCreateImage implements Tool
{
    public function __construct(
        private BannerbearService $service,
    ) {}

    public function name(): string
    {
        return 'bannerbear_create_image';
    }

    public function description(): string
    {
        return 'Generate an image from a Bannerbear template. Provide a template ID and an array of modifications to customize text, images, colors, and other layers. The image is generated asynchronously — use get_image to check status and retrieve the final URL.';
    }

    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'The template UID (e.g., "01H8XYZ..."). Use list_templates to find available templates.'],
            'modifications' => ['type' => 'array', 'required' => true, 'description' => 'Array of modification objects. Each object has a "name" (layer name) and one of: "text" (string), "image_url" (URL), "color" (hex), or "barcode" (string). Example: [{"name": "title", "text": "Hello World"}, {"name": "photo", "image_url": "https://example.com/img.jpg"}].'],
            'width' => ['type' => 'integer', 'description' => 'Override the template width in pixels.'],
            'height' => ['type' => 'integer', 'description' => 'Override the template height in pixels.'],
            'transparent' => ['type' => 'boolean', 'description' => 'Render with a transparent background (PNG only).'],
            'metadata' => ['type' => 'string', 'description' => 'Custom metadata string to attach to the image (max 500 chars).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bannerbear integration is not configured.');
            }

            $modifications = $args['modifications'];

            if (is_string($modifications)) {
                $modifications = json_decode($modifications, true);
                if (!is_array($modifications)) {
                    return ToolResult::error('modifications must be a valid JSON array.');
                }
            }

            $options = [];
            if (isset($args['width'])) {
                $options['width'] = (int) $args['width'];
            }
            if (isset($args['height'])) {
                $options['height'] = (int) $args['height'];
            }
            if (isset($args['transparent'])) {
                $options['transparent'] = (bool) $args['transparent'];
            }
            if (isset($args['metadata'])) {
                $options['metadata'] = $args['metadata'];
            }

            $result = $this->service->createImage($args['template_id'], $modifications, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
