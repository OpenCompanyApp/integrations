<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Call a safe relative WhatsApp Graph API path with GET.
 */
class WhatsAppApiGet extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_api_get';
    }

    public function description(): string
    {
        return 'Call a safe relative Meta Graph API path with GET for WhatsApp endpoints not yet modeled as first-class tools.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Relative Graph API path, such as /me or /{waba_id}/message_templates.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /**
     * Call a safe relative GET path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->apiGet(
            $this->requiredString($args, 'path'),
            $this->arrayArg($args, 'params'),
        ));
    }
}
