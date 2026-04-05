<?php

namespace OpenCompany\Integrations\Mindee\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mindee\MindeeService;

/**
 * Tool for parsing custom documents using a Mindee custom endpoint.
 *
 * Uses a user-defined endpoint ID to parse documents according to a
 * custom model trained in the Mindee API builder.
 */
class MindeeParseCustom implements Tool
{
    /**
     * Create a new MindeeParseCustom tool instance.
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
        return 'mindee_parse_custom';
    }

    /**
     * Get the tool's human-readable description.
     */
    public function description(): string
    {
        return 'Parse a document using a custom Mindee API endpoint. Requires an endpoint_id from your custom model trained in the Mindee API builder.';
    }

    /**
     * Get the tool's parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'endpoint_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The custom endpoint ID from your Mindee dashboard (e.g., "username/endpoint_name/v1").',
            ],
            'document' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The document to parse — either a file path or a base64-encoded string of the file content.',
            ],
            'file_name' => [
                'type' => 'string',
                'description' => 'Optional filename for the document (used when providing base64 content).',
            ],
        ];
    }

    /**
     * Execute the custom document parsing tool.
     *
     * @param array<string, mixed> $args Tool arguments containing 'endpoint_id', 'document', and optional 'file_name'.
     * @return ToolResult The parsed custom document data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mindee integration is not configured.');
            }

            $endpointId = $args['endpoint_id'] ?? '';
            $document = $args['document'] ?? '';
            $fileName = $args['file_name'] ?? null;

            if (empty($endpointId)) {
                return ToolResult::error('The endpoint_id parameter is required. Provide your custom endpoint ID from the Mindee dashboard.');
            }

            if (empty($document)) {
                return ToolResult::error('The document parameter is required. Provide a file path or base64-encoded content.');
            }

            $result = $this->service->parseCustom($endpointId, $document, $fileName);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
