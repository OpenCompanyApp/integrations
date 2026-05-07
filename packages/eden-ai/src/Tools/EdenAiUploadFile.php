<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

/**
 * Upload a file to Eden AI V3 file storage.
 */
class EdenAiUploadFile extends AbstractEdenAiTool
{
    public const NAME = 'edenai_upload_file';
    public const DESCRIPTION = 'Upload a local file to Eden AI V3 persistent file storage.';
    public const PARAMETERS = [
        'file_path' => ['type' => 'string', 'required' => true, 'description' => 'Local file path to upload.'],
        'purpose' => ['type' => 'string', 'description' => 'Optional upload purpose, such as ocr-processing.'],
    ];

    /**
     * Upload a file.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->uploadFile(
            $this->requiredString($args, 'file_path', 'file_path'),
            isset($args['purpose']) ? (string) $args['purpose'] : null
        );
    }
}
