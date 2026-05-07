<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Commit upload session.
 *
 * Executes the official Box API operation post_files_upload_sessions_id_commit.
 */
class BoxPostFilesUploadSessionsIdCommit extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_files_upload_sessions_id_commit';
}
