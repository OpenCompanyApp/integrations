<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List subscriber activity for a MailerLite automation.
 */
class MailerLiteListAutomationActivity extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_list_automation_activity';
    }

    public function description(): string
    {
        return 'List subscriber activity for an automation.';
    }

    public function parameters(): array
    {
        return [
            'automation_id' => ['type' => 'string', 'required' => true, 'description' => 'Automation ID.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum rows to return.'],
        ];
    }

    /**
     * Execute the automation activity listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listAutomationActivity(
            $this->required($args, 'automation_id'),
            $this->only($args, ['page', 'limit']),
        ));
    }
}
