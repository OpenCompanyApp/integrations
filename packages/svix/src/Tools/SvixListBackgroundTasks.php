<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Background Tasks using the official Svix API.
 */
class SvixListBackgroundTasks extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.background-task.list';
}
