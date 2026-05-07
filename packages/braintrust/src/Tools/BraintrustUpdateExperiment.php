<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Patch a Braintrust experiment.
 */
class BraintrustUpdateExperiment extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_update_experiment';
    protected const DESCRIPTION = 'Patch a Braintrust experiment.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/experiment/{experiment_id}';
    protected const PATH_PARAMS = ['experiment_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['experiment_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust experiment UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Patch body with fields to update.']];
}
