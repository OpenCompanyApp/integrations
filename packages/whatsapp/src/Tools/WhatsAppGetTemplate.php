<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a WhatsApp message template by Graph template ID.
 */
class WhatsAppGetTemplate extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_get_template';
    }

    public function description(): string
    {
        return 'Get a WhatsApp message template by Graph template ID.';
    }

    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'Message template Graph ID.'],
        ];
    }

    /**
     * Retrieve a message template.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getTemplate($this->requiredString($args, 'template_id')));
    }
}
