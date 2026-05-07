<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a MailerLite automation by ID.
 */
class MailerLiteGetAutomation extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_get_automation';
    }

    public function description(): string
    {
        return 'Get an automation by ID, including its configured steps and stats.';
    }

    public function parameters(): array
    {
        return [
            'automation_id' => ['type' => 'string', 'required' => true, 'description' => 'Automation ID.'],
        ];
    }

    /**
     * Execute the automation fetch.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getAutomation($this->required($args, 'automation_id')));
    }
}
