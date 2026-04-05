<?php

namespace OpenCompany\Integrations\Box\Tools;

use OpenCompany\Integrations\Box\BoxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BoxDownloadFile implements Tool
{
    /**
     * Create a new BoxDownloadFile tool instance.
     */
    public function __construct(
        private BoxService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'box_download_file';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Download a file from Box by its ID. Returns the raw file contents. Use this to retrieve file data for processing.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'file_id' => ['type' => 'string', 'required' => true, 'description' => 'The Box file ID to download.'],
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

            $content = $this->service->downloadFile($args['file_id']);

            return ToolResult::success([
                'file_id' => $args['file_id'],
                'content' => $content,
                'size' => strlen($content),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
