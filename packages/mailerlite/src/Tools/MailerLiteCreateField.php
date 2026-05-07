<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a custom subscriber field in MailerLite.
 */
class MailerLiteCreateField extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_create_field';
    }

    public function description(): string
    {
        return 'Create a custom subscriber field. Type must be text, number, or date.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Field name.'],
            'type' => ['type' => 'string', 'required' => true, 'enum' => ['text', 'number', 'date'], 'description' => 'Field type.'],
        ];
    }

    /**
     * Execute the field creation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createField([
            'name' => $this->required($args, 'name'),
            'type' => $this->required($args, 'type'),
        ]));
    }
}
