<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

use OpenCompany\Integrations\Cloudinary\CloudinaryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Cloudinary resource.
 *
 * Returns the full asset metadata including dimensions, format, bytes,
 * derived resources, tags, and context metadata.
 */
class CloudinaryGetResource implements Tool
{
    /**
     * Create a new CloudinaryGetResource tool instance.
     */
    public function __construct(
        private CloudinaryService $service,
    ) {}

    /**
     * The tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'cloudinary_get_resource';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details of a specific Cloudinary resource by its type and public ID. Returns full asset metadata including dimensions, format, URL, tags, and derived resources.';
    }

    /**
     * Parameter schema for the get-resource tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Resource type: "image", "video", or "raw".'],
            'public_id' => ['type' => 'string', 'required' => true, 'description' => 'The public ID of the resource (e.g. "blog/hero-image").'],
        ];
    }

    /**
     * Execute the get-resource request.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cloudinary integration is not configured.');
            }

            $type = $args['type'];
            $publicId = $args['public_id'];

            $result = $this->service->getResource($type, $publicId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
