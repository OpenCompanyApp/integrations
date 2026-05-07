<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Cancel a pending Tally organization invite.
 */
class TallyCancelOrganizationInvite extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_cancel_organization_invite';
    }

    public function description(): string
    {
        return 'Cancel a pending Tally organization invite.';
    }

    public function parameters(): array
    {
        return [
            'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally organization ID.'],
            'invite_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally invite ID.'],
        ];
    }

    /**
     * Execute the cancel organization invite request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->cancelOrganizationInvite(
            $this->requiredString($args, 'organization_id', 'Organization ID'),
            $this->requiredString($args, 'invite_id', 'Invite ID'),
        ));
    }
}
