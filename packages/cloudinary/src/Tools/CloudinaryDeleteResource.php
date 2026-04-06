<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

use OpenCompany\Integrations\Cloudinary\CloudinaryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a media resource from Cloudinary.
 *
 * Removes the asset identified by its type and public ID. This action
 * is irreversible — the asset and all its derived resources are permanently
 * deleted.
 */
class CloudinaryDeleteResource implements Tool
{
    /**
     * Create a new CloudinaryDeleteResource tool instance.
     */
    public function __construct(
        private CloudinaryService $service,
    ) {}

    /**
     * The tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'cloudinary_delete_resource';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Delete a media resource from Cloudinary by its type and public ID. This permanently removes the asset and all its derived resources.';
    }

    /**
     * Parameter schema for the delete-resource tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Resource type: "image", "video", or "raw".'],
            'public_id' => ['type' => 'string', 'required' => true, 'description' => 'The public ID of the resource to delete (e.g. "blog/old-photo").'],
        ];
    }

    /**
     * Execute the delete-resource request.
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

            $result = $this->service->deleteResource($type, $publicId);

            return ToolResult::success([
                'deleted' => $result['deleted'] ?? [$publicId => 'deleted'],
                'message' => "Resource '{$publicId}' ({$type}) has been deleted.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
