<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Webex room membership.
 */
class WebexDeleteMembership extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_delete_membership';
    }

    public function description(): string
    {
        return 'Remove a person from a Webex room by membership ID.';
    }

    public function parameters(): array
    {
        return [
            'membership_id' => ['type' => 'string', 'required' => true, 'description' => 'Membership ID.'],
        ];
    }

    /**
     * Delete a room membership.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['membership_id'])) {
                return ToolResult::error('membership_id is required.');
            }

            return ToolResult::success($this->service->deleteMembership((string) $args['membership_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
