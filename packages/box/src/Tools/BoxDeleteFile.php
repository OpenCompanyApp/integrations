<?php

namespace OpenCompany\Integrations\Box\Tools;

use OpenCompany\Integrations\Box\BoxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BoxDeleteFile implements Tool
{
    /**
     * Create a new BoxDeleteFile tool instance.
     */
    public function __construct(
        private BoxService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'box_delete_file';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Delete a file from Box by its ID. This action moves the file to the trash. Use with caution — deleted files can be restored from the trash within the retention period.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'file_id' => ['type' => 'string', 'required' => true, 'description' => 'The Box file ID to delete.'],
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

            $this->service->deleteFile($args['file_id']);

            return ToolResult::success("File '{$args['file_id']}' has been deleted. It can be restored from the trash.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
