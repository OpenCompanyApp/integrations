<?php

namespace OpenCompany\Integrations\Box\Tools;

use OpenCompany\Integrations\Box\BoxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BoxGetFile implements Tool
{
    /**
     * Create a new BoxGetFile tool instance.
     */
    public function __construct(
        private BoxService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'box_get_file';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get metadata for a Box file by ID. Returns the file name, size, type, created/modified dates, parent folder, and shared link info.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'file_id' => ['type' => 'string', 'required' => true, 'description' => 'The Box file ID.'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Box integration is not configured.');
            }

            $result = $this->service->getFile($args['file_id']);

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'type' => $result['type'] ?? 'file',
                'name' => $result['name'] ?? null,
                'size' => $result['size'] ?? null,
                'extension' => $result['extension'] ?? null,
                'mime_type' => $result['mime_type'] ?? null,
                'created_at' => $result['created_at'] ?? null,
                'modified_at' => $result['modified_at'] ?? null,
                'description' => $result['description'] ?? null,
                'parent' => $result['parent'] ?? null,
                'shared_link' => $result['shared_link'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
