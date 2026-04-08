<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single Wufoo entry by its identifier.
 *
 * Calls GET /entries/{id}.json on the Wufoo API and returns the full
 * entry data including all field values and metadata.
 */
class WufooGetEntry implements Tool
{
    /**
     * Create a new WufooGetEntry tool instance.
     *
     * @param  WufooService  $service  The Wufoo API service instance.
     */
    public function __construct(
        private WufooService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'wufoo_get_entry';
    }

    /**
     * Get the human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get a single Wufoo form entry by its identifier. Returns all field values and submission metadata for the entry.';
    }

    /**
     * Get the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'entry_id' => ['type' => 'string', 'required' => true, 'description' => 'The entry identifier to retrieve.'],
        ];
    }

    /**
     * Execute the get entry operation.
     *
     * @param  array<string, mixed>  $args  The tool arguments. Must contain 'entry_id'.
     * @return ToolResult The result containing the entry data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wufoo integration is not configured.');
            }

            $entryId = $args['entry_id'] ?? '';

            if (empty($entryId)) {
                return ToolResult::error('entry_id is required.');
            }

            $result = $this->service->getEntry($entryId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
