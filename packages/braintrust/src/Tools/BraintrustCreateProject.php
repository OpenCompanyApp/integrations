<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Create a Braintrust project.
 */
class BraintrustCreateProject extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_create_project';
    protected const DESCRIPTION = 'Create a Braintrust project using the official /v1/project request body.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/project';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Create project body, usually including name and optional organization metadata.']];
}
