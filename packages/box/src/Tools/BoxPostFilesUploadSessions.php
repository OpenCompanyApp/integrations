<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create upload session.
 *
 * Executes the official Box API operation post_files_upload_sessions.
 */
class BoxPostFilesUploadSessions extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_files_upload_sessions';
}
