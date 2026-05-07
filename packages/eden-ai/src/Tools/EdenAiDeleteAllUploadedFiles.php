<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

/**
 * Delete all uploaded Eden AI V3 files.
 */
class EdenAiDeleteAllUploadedFiles extends AbstractEdenAiTool
{
    public const NAME = 'edenai_delete_all_uploaded_files';
    public const DESCRIPTION = 'Delete all Eden AI V3 uploaded files for the authenticated user.';
    public const PARAMETERS = [];

    /**
     * Delete all uploaded files.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deleteAllUploadedFiles();
    }
}
