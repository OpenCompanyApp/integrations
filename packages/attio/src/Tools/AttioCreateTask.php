<?php

namespace OpenCompany\Integrations\Attio\Tools;

/** Create an Attio task. */
class AttioCreateTask extends AbstractAttioTool
{
    protected const NAME = 'attio_create_task';
    protected const DESCRIPTION = 'Create an Attio task with content, deadline, linked records, and assignees.';
    protected const METHOD = 'POST';
    protected const PATH = '/v2/tasks';
    protected const BODY_KEYS = ['content_plaintext', 'deadline_at', 'linked_records', 'assignees'];
    protected const WRAP_DATA = true;
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'content_plaintext' => ['type' => 'string', 'description' => 'Task content.'],
        'deadline_at' => ['type' => 'string', 'description' => 'Deadline date or timestamp.'],
        'linked_records' => ['type' => 'array', 'description' => 'Linked record objects.'],
        'assignees' => ['type' => 'array', 'description' => 'Assignee actor references.'],
        'body' => ['type' => 'object', 'description' => 'Raw task body. If data is omitted, fields are wrapped as data.'],
    ];
}
