<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Delete an Attio task. */
class AttioDeleteTask extends AbstractAttioTool
{
    protected const NAME = 'attio_delete_task';
    protected const DESCRIPTION = 'Delete an Attio task by task ID.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v2/tasks/{task_id}';
    protected const REQUIRED = ['task_id'];
    protected const PARAMETERS = [
        'task_id' => ['type' => 'string', 'required' => true, 'description' => 'Task UUID.'],
    ];
}
