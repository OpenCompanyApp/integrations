<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\Integrations\SignNow\SignNowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SignNowCreateDocument implements Tool
{
    /**
     * @param SignNowService $service The SignNow API service instance
     */
    public function __construct(
        private SignNowService $service,
    ) {}

    /**
     * Unique tool identifier.
     */
    public function name(): string
    {
        return 'signnow_create_document';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Upload a file to SignNow to create a new document. The file must be a PDF. Returns the new document ID and details.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'file_path' => ['type' => 'string', 'required' => true, 'description' => 'Absolute path to the PDF file to upload.'],
            'file_name' => ['type' => 'string', 'description' => 'Name for the uploaded file. Defaults to the basename of file_path.'],
        ];
    }

    /**
     * Execute the create document tool call.
     *
     * @param array<string, mixed> $args Tool arguments
     * @return ToolResult The result containing the new document info or error
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SignNow integration is not configured.');
            }

            if (empty($args['file_path'])) {
                return ToolResult::error('file_path is required.');
            }

            $filePath = $args['file_path'];
            $fileName = $args['file_name'] ?? basename($filePath);

            $result = $this->service->createDocument($filePath, $fileName);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
