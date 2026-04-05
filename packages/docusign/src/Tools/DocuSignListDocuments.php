<?php

namespace OpenCompany\Integrations\DocuSign\Tools;

use OpenCompany\Integrations\DocuSign\DocuSignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List documents attached to a DocuSign envelope.
 *
 * Returns a list of document summaries including IDs, names, types, and sizes.
 */
class DocuSignListDocuments implements Tool
{
    /**
     * Create a new DocuSignListDocuments tool instance.
     */
    public function __construct(
        private DocuSignService $service,
    ) {}

    /**
     * The unique tool identifier.
     */
    public function name(): string
    {
        return 'docusign_list_documents';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'List documents in a DocuSign envelope. Returns document IDs, names, types (content or summary), and page counts. Use document IDs to download individual documents.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'envelope_id' => ['type' => 'string', 'required' => true, 'description' => 'The envelope ID to list documents for.'],
        ];
    }

    /**
     * Execute the tool call.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DocuSign integration is not configured.');
            }

            $result = $this->service->listDocuments($args['envelope_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
