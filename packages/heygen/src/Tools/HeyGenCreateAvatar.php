<?php

namespace OpenCompany\Integrations\HeyGen\Tools;

use OpenCompany\Integrations\HeyGen\HeyGenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for creating a new custom avatar in HeyGen.
 *
 * Submits a training video or image to create a new avatar that can be used
 * in subsequent video generation requests.
 */
class HeyGenCreateAvatar implements Tool
{
    /**
     * Create a new HeyGenCreateAvatar tool instance.
     *
     * @param  HeyGenService  $service  The HeyGen API service.
     */
    public function __construct(
        private HeyGenService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'heygen_create_avatar';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Create a new custom avatar in HeyGen by providing a training video URL and a name. The avatar will be available for video generation once training completes.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'video_url' => ['type' => 'string', 'required' => true, 'description' => 'URL of the training video for the avatar (2-5 min single-person video).'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'A name for the new avatar.'],
            'description' => ['type' => 'string', 'description' => 'Optional description for the avatar.'],
        ];
    }

    /**
     * Execute the create avatar tool.
     *
     * @param  array  $args  The tool arguments matching the parameter definitions.
     * @return ToolResult The result containing the new avatar details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HeyGen integration is not configured.');
            }

            $body = [
                'video_url' => $args['video_url'],
                'name' => $args['name'],
            ];

            if (isset($args['description'])) {
                $body['description'] = $args['description'];
            }

            $result = $this->service->createAvatar($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
