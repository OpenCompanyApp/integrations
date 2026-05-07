<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Cancel a SignNow free-form invite.
 */
class SignNowCancelFreeformInvite extends AbstractSignNowTool implements Tool
{
    public function name(): string
    {
        return 'signnow_cancel_freeform_invite';
    }

    public function description(): string
    {
        return 'Cancel a SignNow free-form invite by invite ID.';
    }

    public function parameters(): array
    {
        return [
            'invite_id' => ['type' => 'string', 'required' => true, 'description' => 'Invite ID.'],
        ];
    }

    /**
     * Cancel a free-form invite.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['invite_id'])) {
                return ToolResult::error('invite_id is required.');
            }

            return ToolResult::success($this->service->cancelFreeformInvite((string) $args['invite_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
