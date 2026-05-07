<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\Integrations\SignNow\SignNowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for one SignNow document.
 */
class SignNowGetDocument implements Tool
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
        return 'signnow_get_document';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get full details for a specific SignNow document by ID, including fields, signers, and document status.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique document identifier.'],
        ];
    }

    /**
     * Execute the get document tool call.
     *
     * @param array<string, mixed> $args Tool arguments
     * @return ToolResult The result containing document details or error
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SignNow integration is not configured.');
            }

            if (empty($args['document_id'])) {
                return ToolResult::error('document_id is required.');
            }

            $result = $this->service->getDocument($args['document_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
