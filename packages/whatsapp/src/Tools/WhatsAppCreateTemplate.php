<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a WhatsApp message template on the configured business account.
 */
class WhatsAppCreateTemplate extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_create_template';
    }

    public function description(): string
    {
        return 'Create a WhatsApp message template on the configured WhatsApp Business Account.';
    }

    public function parameters(): array
    {
        return [
            'template' => ['type' => 'object', 'required' => true, 'description' => 'Template creation payload with name, language, category, and components.'],
        ];
    }

    /**
     * Create a message template.
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

            return $this->service->createTemplate($template);
        });
    }
}
