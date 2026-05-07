<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a draft MailerLite automation.
 */
class MailerLiteCreateAutomation extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_create_automation';
    }

    public function description(): string
    {
        return 'Create a draft automation. Use payload for advanced automation fields or name for a simple draft.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'description' => 'Automation name.'],
            'payload' => ['type' => 'object', 'description' => 'Full automation payload.'],
        ];
    }

    /**
     * Execute the automation creation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createAutomation($this->payload($args, ['name'])));
    }
}
