<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Delete a Braintrust project by ID.
 */
class BraintrustDeleteProject extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_delete_project';
    protected const DESCRIPTION = 'Delete a Braintrust project by project_id.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/project/{project_id}';
    protected const PATH_PARAMS = ['project_id'];
    protected const PARAMETERS = ['project_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust project UUID.']];
}
