<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a WhatsApp message template by Graph template ID.
 */
class WhatsAppUpdateTemplate extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_update_template';
    }

    public function description(): string
    {
        return 'Update a WhatsApp message template by Graph template ID.';
    }

    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'Message template Graph ID.'],
            'template' => ['type' => 'object', 'required' => true, 'description' => 'Template update payload.'],
        ];
    }

    /**
     * Update a message template.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(function () use ($args): array {
            $template = $this->arrayArg($args, 'template');
            if ($template === []) {
                throw new \InvalidArgumentException('template is required.');
            }

            return $this->service->updateTemplate($this->requiredString($args, 'template_id'), $template);
        });
    }
}
