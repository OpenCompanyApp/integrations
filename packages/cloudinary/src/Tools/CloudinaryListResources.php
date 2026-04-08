<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

use OpenCompany\Integrations\Cloudinary\CloudinaryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List media resources in a Cloudinary cloud.
 *
 * Supports filtering by resource type, prefix, and pagination via
 * max_results / next_cursor.
 */
class CloudinaryListResources implements Tool
{
    /**
     * Create a new CloudinaryListResources tool instance.
     */
    public function __construct(
        private CloudinaryService $service,
    ) {}

    /**
     * The tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'cloudinary_list_resources';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List media resources in your Cloudinary cloud. Filter by resource type (image, video, raw) and prefix. Supports pagination with max_results and next_cursor.';
    }

    /**
     * Parameter schema for the list-resources tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'description' => 'Resource type to list: "image", "video", or "raw". Defaults to "image".'],
            'max_results' => ['type' => 'integer', 'description' => 'Maximum number of resources to return (max 500, default 10).'],
            'next_cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response to get the next page.'],
            'prefix' => ['type' => 'string', 'description' => 'Only include resources whose public ID starts with this prefix (e.g. "blog/").'],
        ];
    }

    /**
     * Execute the list-resources request.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cloudinary integration is not configured.');
            }

            $type = $args['type'] ?? 'image';
            $maxResults = isset($args['max_results']) ? (int) $args['max_results'] : null;
            $nextCursor = $args['next_cursor'] ?? null;
            $prefix = $args['prefix'] ?? null;

            $result = $this->service->listResources($type, $maxResults, $nextCursor, $prefix);

            $resources = array_map(function (array $resource): array {
                return [
                    'public_id' => $resource['public_id'] ?? null,
                    'format' => $resource['format'] ?? null,
                    'resource_type' => $resource['resource_type'] ?? null,
                    'type' => $resource['type'] ?? null,
                    'secure_url' => $resource['secure_url'] ?? null,
                    'width' => $resource['width'] ?? null,
                    'height' => $resource['height'] ?? null,
                    'bytes' => $resource['bytes'] ?? null,
                    'created_at' => $resource['created_at'] ?? null,
                    'folder' => $resource['folder'] ?? null,
                ];
            }, $result['resources'] ?? []);

            return ToolResult::success([
                'resources' => $resources,
                'resource_count' => count($resources),
                'next_cursor' => $result['next_cursor'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
