<?php

namespace OpenCompany\Integrations\Bitly\Tools;

use OpenCompany\Integrations\Bitly\BitlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve details for a specific Bitly group.
 *
 * Calls GET /groups/{groupGuid} to fetch group metadata including
 * the name, GUID, organization, and default domain.
 */
class BitlyGetGroup implements Tool
{
    /**
     * Create a new BitlyGetGroup tool instance.
     *
     * @param BitlyService $service The Bitly API service
     */
    public function __construct(
        private BitlyService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier
     */
    public function name(): string
    {
        return 'bitly_get_group';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does
     */
    public function description(): string
    {
        return 'Retrieve details for a specific Bitly group by its GUID.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array Parameter definitions keyed by parameter name
     */
    public function parameters(): array
    {
        return [
            'group_guid' => ['type' => 'string', 'required' => true, 'description' => 'The GUID of the group to retrieve.'],
        ];
    }

    /**
     * Execute the tool: fetch the specified group's details.
     *
     * @param array $args Tool arguments containing the group_guid
     *
     * @return ToolResult The group data or an error message
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bitly integration is not configured.');
            }

            $groupGuid = $args['group_guid'] ?? '';
            if (empty($groupGuid)) {
                return ToolResult::error('group_guid is required.');
            }

            $result = $this->service->getGroup($groupGuid);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
