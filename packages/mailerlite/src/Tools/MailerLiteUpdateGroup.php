<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a MailerLite subscriber group.
 */
class MailerLiteUpdateGroup extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_update_group';
    }

    public function description(): string
    {
        return 'Update a subscriber group name.';
    }

    public function parameters(): array
    {
        return [
            'group_id' => ['type' => 'string', 'required' => true, 'description' => 'Group ID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Updated group name.'],
        ];
    }

    /**
     * Execute the group update.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateGroup(
            $this->required($args, 'group_id'),
            ['name' => $this->required($args, 'name')],
        ));
    }
}
