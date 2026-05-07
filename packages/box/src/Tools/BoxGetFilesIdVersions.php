<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List all file versions.
 *
 * Executes the official Box API operation get_files_id_versions.
 */
class BoxGetFilesIdVersions extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_files_id_versions';
}
