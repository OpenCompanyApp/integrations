<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a MailerLite batch request.
 */
class MailerLiteBatch extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_batch';
    }

    public function description(): string
    {
        return 'Execute up to 50 MailerLite API requests in one batch. Paths must be relative API paths such as api/fields.';
    }

    public function parameters(): array
    {
        return [
            'requests' => ['type' => 'array', 'required' => true, 'description' => 'Array of objects with method, path, and optional body.'],
        ];
    }

    /**
     * Execute the batch request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->batch($this->required($args, 'requests')));
    }
}
