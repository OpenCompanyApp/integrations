<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a safe raw PUT request against the MailerLite API.
 */
class MailerLiteApiPut extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_api_put';
    }

    public function description(): string
    {
        return 'Call a relative MailerLite API path with PUT for endpoints not yet wrapped by a dedicated tool.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative API path. Absolute URLs are rejected.'],
            'payload' => ['type' => 'object', 'description' => 'JSON body.'],
        ];
    }

    /**
     * Execute the raw PUT request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiPut(
            $this->required($args, 'path'),
            is_array($args['payload'] ?? null) ? $args['payload'] : [],
        ));
    }
}
