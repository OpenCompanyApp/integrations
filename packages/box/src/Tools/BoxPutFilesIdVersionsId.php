<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Restore file version.
 *
 * Executes the official Box API operation put_files_id_versions_id.
 */
class BoxPutFilesIdVersionsId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_files_id_versions_id';
}
