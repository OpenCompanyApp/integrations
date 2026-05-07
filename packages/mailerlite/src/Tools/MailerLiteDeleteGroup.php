<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a MailerLite subscriber group.
 */
class MailerLiteDeleteGroup extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_delete_group';
    }

    public function description(): string
    {
        return 'Delete a subscriber group by ID.';
    }

    public function parameters(): array
    {
        return [
            'group_id' => ['type' => 'string', 'required' => true, 'description' => 'Group ID.'],
        ];
    }

    /**
     * Execute the group deletion.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteGroup($this->required($args, 'group_id')));
    }
}
