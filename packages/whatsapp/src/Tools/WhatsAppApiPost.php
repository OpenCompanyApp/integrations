<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a safe relative WhatsApp Graph API path with POST.
 */
class WhatsAppApiPost extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_api_post';
    }

    public function description(): string
    {
        return 'Call a safe relative Meta Graph API path with POST for WhatsApp endpoints not yet modeled as first-class tools.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Graph API path.'],
            'payload' => ['type' => 'object', 'description' => 'JSON request body.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /**
     * Call a safe relative POST path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiPost(
            $this->requiredString($args, 'path'),
            $this->arrayArg($args, 'payload'),
            $this->arrayArg($args, 'params'),
        ));
    }
}
