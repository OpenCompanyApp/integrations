<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Remove upload session.
 *
 * Executes the official Box API operation delete_files_upload_sessions_id.
 */
class BoxDeleteFilesUploadSessionsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_delete_files_upload_sessions_id';
}
