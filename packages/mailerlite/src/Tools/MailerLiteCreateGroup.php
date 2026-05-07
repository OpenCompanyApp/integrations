<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a MailerLite subscriber group.
 */
class MailerLiteCreateGroup extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_create_group';
    }

    public function description(): string
    {
        return 'Create a subscriber group by name.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Group name.'],
        ];
    }

    /**
     * Execute the group creation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createGroup([
            'name' => $this->required($args, 'name'),
        ]));
    }
}
