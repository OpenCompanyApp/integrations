<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Remove an existing MailerLite subscriber from a group.
 */
class MailerLiteUnassignSubscriberFromGroup extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_unassign_subscriber_from_group';
    }

    public function description(): string
    {
        return 'Remove an existing subscriber from a group by subscriber ID and group ID.';
    }

    public function parameters(): array
    {
        return [
            'subscriber_id' => ['type' => 'string', 'required' => true, 'description' => 'Existing subscriber ID.'],
            'group_id' => ['type' => 'string', 'required' => true, 'description' => 'Existing group ID.'],
        ];
    }

    /**
     * Execute the group unassignment.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->unassignSubscriberFromGroup(
            $this->required($args, 'subscriber_id'),
            $this->required($args, 'group_id'),
        ));
    }
}
