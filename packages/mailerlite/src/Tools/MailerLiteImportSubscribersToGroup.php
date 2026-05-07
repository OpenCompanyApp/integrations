<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Bulk import subscribers into a MailerLite group.
 */
class MailerLiteImportSubscribersToGroup extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_import_subscribers_to_group';
    }

    public function description(): string
    {
        return 'Bulk import subscriber payloads into a group and return the import progress URL.';
    }

    public function parameters(): array
    {
        return [
            'group_id' => ['type' => 'string', 'required' => true, 'description' => 'Group ID.'],
            'subscribers' => ['type' => 'array', 'required' => true, 'description' => 'Array of subscriber objects to import.'],
        ];
    }

    /**
     * Execute the group import.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->importSubscribersToGroup(
            $this->required($args, 'group_id'),
            $this->required($args, 'subscribers'),
        ));
    }
}
