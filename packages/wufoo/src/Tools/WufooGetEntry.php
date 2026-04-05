<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WufooGetEntry implements Tool
{
    /**
     * Create a new WufooGetEntry tool instance.
     */
    public function __construct(
        private WufooService $service,
    ) {}

    /**
     * Get the tool's machine name.
     */
    public function name(): string
    {
        return 'wufoo_get_entry';
    }

    /**
     * Get a description of what this tool does.
     */
    public function description(): string
    {
        return 'Get a single form entry by its unique entry ID. Returns all field values and metadata for the entry.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'entry_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique entry identifier.'],
        ];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wufoo integration is not configured.');
            }

            $result = $this->service->getEntry($args['entry_id']);
            $entries = $result['Entries'] ?? [];

            if (empty($entries)) {
                return ToolResult::error("Entry '{$args['entry_id']}' not found.");
            }

            return ToolResult::success([
                'entry' => $entries[0],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
