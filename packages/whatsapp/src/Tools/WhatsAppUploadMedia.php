<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upload a local media file to WhatsApp Cloud API media storage.
 */
class WhatsAppUploadMedia extends AbstractWhatsAppTool
{
    public function name(): string
    {
        return 'whatsapp_upload_media';
    }

    public function description(): string
    {
        return 'Upload a local image, video, audio, sticker, or document file to WhatsApp media storage.';
    }

    public function parameters(): array
    {
        return [
            'file_path' => ['type' => 'string', 'required' => true, 'description' => 'Readable local file path.'],
            'mime_type' => ['type' => 'string', 'required' => true, 'description' => 'MIME type such as image/jpeg or application/pdf.'],
        ];
    }

    /**
     * Upload media from a local path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->uploadMedia(
            $this->requiredString($args, 'file_path'),
            $this->requiredString($args, 'mime_type'),
        ));
    }
}
