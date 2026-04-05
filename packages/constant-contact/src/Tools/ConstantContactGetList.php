<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single contact list by ID in Constant Contact.
 *
 * Retrieves detailed information about a specific contact list,
 * including its name, membership count, and creation date.
 */
class ConstantContactGetList implements Tool
{
    /**
     * Create a new ConstantContactGetList tool instance.
     */
    public function __construct(
        private ConstantContactService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'constantcontact_get_list';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details for a single Constant Contact list by its list ID.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The Constant Contact list ID.'],
        ];
    }

    /**
     * Execute the tool: fetch a single contact list from Constant Contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Constant Contact integration is not configured.');
            }

            if (empty($args['list_id'])) {
                return ToolResult::error('list_id is required.');
            }

            $result = $this->service->getList($args['list_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
