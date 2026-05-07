<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Retrieve a Braintrust project by ID.
 */
class BraintrustGetProject extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_get_project';
    protected const DESCRIPTION = 'Get a Braintrust project by project_id.';
    protected const PATH = '/v1/project/{project_id}';
    protected const PATH_PARAMS = ['project_id'];
    protected const PARAMETERS = ['project_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust project UUID.']];
}
