<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List workflows.
 *
 * Executes the official Box API operation get_workflows.
 */
class BoxGetWorkflows extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_workflows';
}
