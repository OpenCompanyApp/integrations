<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Invite users to Tally organization workspaces.
 */
class TallyCreateOrganizationInvite extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_create_organization_invite';
    }

    public function description(): string
    {
        return 'Invite users to one or more Tally workspaces inside an organization.';
    }

    public function parameters(): array
    {
        return [
            'organization_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally organization ID.'],
            'workspace_ids' => ['type' => 'array', 'required' => true, 'description' => 'Workspace IDs to invite users to.', 'items' => ['type' => 'string']],
            'emails' => ['type' => 'string', 'required' => true, 'description' => 'Comma- or semicolon-separated email addresses.'],
        ];
    }

    /**
     * Execute the create organization invite request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createOrganizationInvite(
            $this->requiredString($args, 'organization_id', 'Organization ID'),
            is_array($args['workspace_ids'] ?? null) ? $args['workspace_ids'] : throw new \InvalidArgumentException('Workspace IDs are required.'),
            $this->requiredString($args, 'emails', 'Emails'),
        ));
    }
}
