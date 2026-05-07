<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get upload session.
 *
 * Executes the official Box API operation get_files_upload_sessions_id.
 */
class BoxGetFilesUploadSessionsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_files_upload_sessions_id';
}
