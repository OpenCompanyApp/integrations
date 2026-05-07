<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Create a Braintrust experiment.
 */
class BraintrustCreateExperiment extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_create_experiment';
    protected const DESCRIPTION = 'Create a Braintrust experiment.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/experiment';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Create experiment body, usually including project_id and name.']];
}
