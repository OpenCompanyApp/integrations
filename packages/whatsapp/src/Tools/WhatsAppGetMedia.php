<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve WhatsApp media metadata and its temporary download URL.
 */
class WhatsAppGetMedia extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_get_media';
    }

    public function description(): string
    {
        return 'Get WhatsApp media metadata and the temporary download URL for a media ID.';
    }

    public function parameters(): array
    {
        return [
            'media_id' => ['type' => 'string', 'required' => true, 'description' => 'WhatsApp media ID.'],
        ];
    }

    /**
     * Retrieve media metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getMedia($this->requiredString($args, 'media_id')));
    }
}
