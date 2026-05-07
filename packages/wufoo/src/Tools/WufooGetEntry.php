<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to find a single Wufoo entry by form and entry identifier.
 *
 * Uses the documented form entries endpoint with an EntryId filter.
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
        return 'Find a single Wufoo form entry by form ID and entry ID using the documented form entries endpoint.';
    }

    /**
     * Get the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or title identifier.'],
            'entry_id' => ['type' => 'string', 'required' => true, 'description' => 'The entry identifier to retrieve.'],
        ];
    }

    /**
     * Execute the get entry operation.
     *
     * @param  array<string, mixed>  $args  The tool arguments. Must contain form_id and entry_id.
     * @return ToolResult The result containing the entry data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wufoo integration is not configured.');
            }

            $formId = trim((string) ($args['form_id'] ?? ''));
            $entryId = trim((string) ($args['entry_id'] ?? ''));

            if ($formId === '') {
                return ToolResult::error('form_id is required.');
            }
            if (empty($entryId)) {
                return ToolResult::error('entry_id is required.');
            }

            $result = $this->service->getEntry($formId, $entryId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
