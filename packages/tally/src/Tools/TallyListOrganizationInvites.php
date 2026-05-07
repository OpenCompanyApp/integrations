<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List pending invites for a Tally organization.
 */
class TallyListOrganizationInvites extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_list_organization_invites';
    }

    public function description(): string
    {
        return 'List pending invites for a Tally organization.';
    }

    public function parameters(): array
    {
        return [
            'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally organization ID.'],
        ];
    }

    /**
     * Execute the list organization invites request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listOrganizationInvites(
            $this->requiredString($args, 'organization_id', 'Organization ID'),
        ));
    }
}
