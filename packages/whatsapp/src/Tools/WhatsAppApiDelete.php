<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a safe relative WhatsApp Graph API path with DELETE.
 */
class WhatsAppApiDelete extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_api_delete';
    }

    public function description(): string
    {
        return 'Call a safe relative Meta Graph API path with DELETE for WhatsApp endpoints not yet modeled as first-class tools.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Graph API path.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /**
     * Call a safe relative DELETE path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiDelete(
            $this->requiredString($args, 'path'),
            $this->arrayArg($args, 'params'),
        ));
    }
}
