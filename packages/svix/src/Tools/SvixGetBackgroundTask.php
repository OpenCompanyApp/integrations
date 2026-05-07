<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Background Task using the official Svix API.
 */
class SvixGetBackgroundTask extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.background-task.get';
}
