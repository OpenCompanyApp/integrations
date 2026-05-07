<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Remove a user from a Tally organization.
 */
class TallyRemoveOrganizationUser extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_remove_organization_user';
    }

    public function description(): string
    {
        return 'Remove a user from a Tally organization.';
    }

    public function parameters(): array
    {
        return [
            'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally organization ID.'],
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally user ID.'],
        ];
    }

    /**
     * Execute the remove organization user request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->removeOrganizationUser(
            $this->requiredString($args, 'organization_id', 'Organization ID'),
            $this->requiredString($args, 'user_id', 'User ID'),
        ));
    }
}
