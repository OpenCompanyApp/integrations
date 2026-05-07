<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List people visible to the authenticated Webex token.
 */
class WebexListPeople extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_list_people';
    }

    public function description(): string
    {
        return 'List Webex people by email, display name, organization, or pagination filters.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'description' => 'Filter by email.'],
            'displayName' => ['type' => 'string', 'description' => 'Filter by display name.'],
            'id' => ['type' => 'string', 'description' => 'Filter by person ID.'],
            'orgId' => ['type' => 'string', 'description' => 'Filter by organization ID.'],
            'max' => ['type' => 'integer', 'description' => 'Maximum results to return.'],
        ];
    }

    /**
     * Fetch people.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listPeople($this->only($args, ['email', 'displayName', 'id', 'orgId', 'max'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
