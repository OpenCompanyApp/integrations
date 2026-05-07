<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Patch a Braintrust project.
 */
class BraintrustUpdateProject extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_update_project';
    protected const DESCRIPTION = 'Patch a Braintrust project by project_id.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/project/{project_id}';
    protected const PATH_PARAMS = ['project_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['project_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust project UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Patch body with fields to update.']];
}
