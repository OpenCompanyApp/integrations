<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create upload session for existing file.
 *
 * Executes the official Box API operation post_files_id_upload_sessions.
 */
class BoxPostFilesIdUploadSessions extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_files_id_upload_sessions';
}
