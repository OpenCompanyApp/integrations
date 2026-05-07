<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List file version retentions.
 *
 * Executes the official Box API operation get_file_version_retentions.
 */
class BoxGetFileVersionRetentions extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_file_version_retentions';
}
