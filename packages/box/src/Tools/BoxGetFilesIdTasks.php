<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List tasks on file.
 *
 * Executes the official Box API operation get_files_id_tasks.
 */
class BoxGetFilesIdTasks extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_files_id_tasks';
}
