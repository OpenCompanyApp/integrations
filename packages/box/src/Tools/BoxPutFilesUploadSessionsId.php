<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Upload part of file.
 *
 * Executes the official Box API operation put_files_upload_sessions_id.
 */
class BoxPutFilesUploadSessionsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_files_upload_sessions_id';
}
