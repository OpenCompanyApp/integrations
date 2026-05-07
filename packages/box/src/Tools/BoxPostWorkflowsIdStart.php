<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Starts workflow based on request body.
 *
 * Executes the official Box API operation post_workflows_id_start.
 */
class BoxPostWorkflowsIdStart extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_workflows_id_start';
}
