<?php

namespace OpenCompany\Integrations\VoyageAi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve Voyage AI file content by ID.
 *
 * Supports text/plain and application/json Accept headers for output and
 * error file retrieval.
 */
class VoyageAiRetrieveFileContent extends AbstractVoyageAiTool implements Tool
{
    public function name(): string
    {
        return 'voyage_ai_retrieve_file_content';
    }

    public function description(): string
    {
        return 'Retrieve raw content for a Voyage AI file, such as batch output or error JSONL.';
    }

    public function parameters(): array
    {
        return [
            'file_id' => ['type' => 'string', 'required' => true, 'description' => 'Voyage AI file ID.'],
            'accept' => ['type' => 'string', 'enum' => ['text/plain', 'application/json'], 'description' => 'Accept header. Defaults to text/plain.'],
        ];
    }

    /**
     * Execute the retrieve file content API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments with file_id and optional accept.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Voyage AI integration is not configured.');
            }

            $accept = (string) ($args['accept'] ?? 'text/plain');
            $this->assertEnum('accept', $accept, ['text/plain', 'application/json']);

            return ToolResult::success($this->service->retrieveFileContent($this->requireString($args, 'file_id'), $accept));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
