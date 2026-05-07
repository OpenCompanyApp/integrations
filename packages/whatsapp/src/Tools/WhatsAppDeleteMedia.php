<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete uploaded WhatsApp media by media ID.
 */
class WhatsAppDeleteMedia extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_delete_media';
    }

    public function description(): string
    {
        return 'Delete an uploaded WhatsApp media object by media ID.';
    }

    public function parameters(): array
    {
        return [
            'media_id' => ['type' => 'string', 'required' => true, 'description' => 'WhatsApp media ID.'],
        ];
    }

    /**
     * Delete a media object.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteMedia($this->requiredString($args, 'media_id')));
    }
}
