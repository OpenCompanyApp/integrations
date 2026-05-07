<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Assign an existing MailerLite subscriber to a group.
 */
class MailerLiteAssignSubscriberToGroup extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_assign_subscriber_to_group';
    }

    public function description(): string
    {
        return 'Assign an existing subscriber to a group by subscriber ID and group ID.';
    }

    public function parameters(): array
    {
        return [
            'subscriber_id' => ['type' => 'string', 'required' => true, 'description' => 'Existing subscriber ID.'],
            'group_id' => ['type' => 'string', 'required' => true, 'description' => 'Existing group ID.'],
        ];
    }

    /**
     * Execute the group assignment.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->assignSubscriberToGroup(
            $this->required($args, 'subscriber_id'),
            $this->required($args, 'group_id'),
        ));
    }
}
