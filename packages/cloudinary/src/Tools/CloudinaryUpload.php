<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

use OpenCompany\Integrations\Cloudinary\CloudinaryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upload an image to Cloudinary.
 *
 * Accepts a file (URL, base64 data URI, or local path), an optional public ID,
 * and an optional folder. Returns the uploaded asset details including the
 * secure URL, dimensions, format, and bytes.
 */
class CloudinaryUpload implements Tool
{
    /**
     * Create a new CloudinaryUpload tool instance.
     */
    public function __construct(
        private CloudinaryService $service,
    ) {}

    /**
     * The tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'cloudinary_upload';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Upload an image to Cloudinary. Provide a file URL or base64 data URI, an optional public ID, and an optional folder path. Returns the uploaded asset details.';
    }

    /**
     * Parameter schema for the upload tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'file' => ['type' => 'string', 'required' => true, 'description' => 'The file to upload — a remote URL (e.g. "https://example.com/photo.jpg") or a base64 data URI (e.g. "data:image/png;base64,...").'],
            'public_id' => ['type' => 'string', 'description' => 'The public ID to assign to the uploaded asset. If omitted, Cloudinary generates a random ID.'],
            'folder' => ['type' => 'string', 'description' => 'The folder to store the asset in (e.g. "blog/images").'],
        ];
    }

    /**
     * Execute the upload.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cloudinary integration is not configured.');
            }

            $file = $args['file'];
            $publicId = $args['public_id'] ?? null;
            $folder = $args['folder'] ?? null;

            $result = $this->service->upload($file, $publicId, $folder);

            return ToolResult::success([
                'public_id' => $result['public_id'] ?? null,
                'secure_url' => $result['secure_url'] ?? null,
                'url' => $result['url'] ?? null,
                'format' => $result['format'] ?? null,
                'width' => $result['width'] ?? null,
                'height' => $result['height'] ?? null,
                'bytes' => $result['bytes'] ?? null,
                'resource_type' => $result['resource_type'] ?? null,
                'created_at' => $result['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
