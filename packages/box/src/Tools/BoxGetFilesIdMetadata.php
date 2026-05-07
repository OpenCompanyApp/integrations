<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List metadata instances on file.
 *
 * Executes the official Box API operation get_files_id_metadata.
 */
class BoxGetFilesIdMetadata extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_files_id_metadata';
}
