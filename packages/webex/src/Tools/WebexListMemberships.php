<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Webex room memberships.
 */
class WebexListMemberships extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_list_memberships';
    }

    public function description(): string
    {
        return 'List memberships for Webex rooms by room, person, email, or pagination filters.';
    }

    public function parameters(): array
    {
        return [
            'roomId' => ['type' => 'string', 'description' => 'Filter by room ID.'],
            'personId' => ['type' => 'string', 'description' => 'Filter by person ID.'],
            'personEmail' => ['type' => 'string', 'description' => 'Filter by person email.'],
            'max' => ['type' => 'integer', 'description' => 'Maximum results to return.'],
        ];
    }

    /**
     * Fetch room memberships.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listMemberships($this->only($args, ['roomId', 'personId', 'personEmail', 'max'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
