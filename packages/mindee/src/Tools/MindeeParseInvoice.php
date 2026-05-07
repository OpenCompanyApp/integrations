<?php

namespace OpenCompany\Integrations\Mindee\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mindee\MindeeService;

/**
 * Tool for parsing invoice documents using the Mindee API.
 *
 * Extracts structured data from invoice PDFs or images, including
 * supplier information, line items, totals, dates, and tax details.
 */
class MindeeParseInvoice implements Tool
{
    /**
     * Create a new MindeeParseInvoice tool instance.
     *
     * @param MindeeService $service The Mindee API service.
     */
    public function __construct(
        private MindeeService $service,
    ) {}

    /**
     * Get the tool's identifier name.
     */
    public function name(): string
    {
        return 'mindee_parse_invoice';
    }

    /**
     * Get the tool's human-readable description.
     */
    public function description(): string
    {
        return 'Parse an invoice document (PDF or image) and extract structured data including supplier, line items, totals, dates, and tax details.';
    }

    /**
     * Get the tool's parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'document' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The document to parse — either a file path or a base64-encoded string of the file content.',
            ],
            'file_name' => [
                'type' => 'string',
                'description' => 'Optional filename for the document (used when providing base64 content).',
            ],
            'options' => [
                'type' => 'object',
                'description' => 'Additional query parameters for the Mindee endpoint.',
            ],
        ];
    }

    /**
     * Execute the invoice parsing tool.
     *
     * @param array<string, mixed> $args Tool arguments containing 'document' and optional 'file_name'.
     * @return ToolResult The parsed invoice data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mindee integration is not configured.');
            }

            $document = $args['document'] ?? '';
            $fileName = $args['file_name'] ?? null;
            $options = is_array($args['options'] ?? null) ? $args['options'] : [];

            if (empty($document)) {
                return ToolResult::error('The document parameter is required. Provide a file path or base64-encoded content.');
            }

            $result = $this->service->parseInvoice($document, $fileName, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
