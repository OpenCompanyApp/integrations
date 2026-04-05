<?php

namespace OpenCompany\Integrations\Bannerbear\Tools;

use OpenCompany\Integrations\Bannerbear\BannerbearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BannerbearCreateVideo implements Tool
{
    public function __construct(
        private BannerbearService $service,
    ) {}

    public function name(): string
    {
        return 'bannerbear_create_video';
    }

    public function description(): string
    {
        return 'Generate a video from a Bannerbear template. Provide a template ID and an array of modifications per scene. The video is generated asynchronously — use get_video to check status and retrieve the final URL.';
    }

    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'The template UID (e.g., "01H8XYZ..."). Use list_templates to find available templates.'],
            'modifications' => ['type' => 'array', 'required' => true, 'description' => 'Array of modification objects for scenes. Each scene entry has a "name" (layer name) and one of: "text", "image_url", "color", or "barcode". Pass as JSON or array.'],
            'fps' => ['type' => 'integer', 'description' => 'Frames per second for the output video (default: template setting).'],
            'trim' => ['type' => 'string', 'description' => 'Trim the video. Pass as "start,end" in seconds (e.g., "0,5").'],
            'metadata' => ['type' => 'string', 'description' => 'Custom metadata string to attach (max 500 chars).'],
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
            if (isset($args['fps'])) {
                $options['fps'] = (int) $args['fps'];
            }
            if (isset($args['trim'])) {
                $options['trim'] = $args['trim'];
            }
            if (isset($args['metadata'])) {
                $options['metadata'] = $args['metadata'];
            }

            $result = $this->service->createVideo($args['template_id'], $modifications, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
