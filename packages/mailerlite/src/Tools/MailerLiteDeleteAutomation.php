<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a MailerLite automation.
 */
class MailerLiteDeleteAutomation extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_delete_automation';
    }

    public function description(): string
    {
        return 'Delete an automation by ID.';
    }

    public function parameters(): array
    {
        return [
            'automation_id' => ['type' => 'string', 'required' => true, 'description' => 'Automation ID.'],
        ];
    }

    /**
     * Execute the automation deletion.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteAutomation($this->required($args, 'automation_id')));
    }
}
