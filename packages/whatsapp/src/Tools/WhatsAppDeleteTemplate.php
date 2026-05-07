<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a WhatsApp message template by name and optional template ID.
 */
class WhatsAppDeleteTemplate extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_delete_template';
    }

    public function description(): string
    {
        return 'Delete a WhatsApp message template by name and optional template ID.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Template name.'],
            'template_id' => ['type' => 'string', 'description' => 'Optional template ID for a specific language variant.'],
        ];
    }

    /**
     * Delete a message template.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteTemplate(
            $this->requiredString($args, 'name'),
            $this->string($args, 'template_id') ?: null,
        ));
    }
}
