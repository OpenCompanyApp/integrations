<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Get retention on file.
 *
 * Executes the official Box API operation get_file_version_retentions_id.
 */
class BoxGetFileVersionRetentionsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_file_version_retentions_id';
}
