<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Retrieve a Braintrust experiment by ID.
 */
class BraintrustGetExperiment extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_get_experiment';
    protected const DESCRIPTION = 'Get a Braintrust experiment by experiment_id.';
    protected const PATH = '/v1/experiment/{experiment_id}';
    protected const PATH_PARAMS = ['experiment_id'];
    protected const PARAMETERS = ['experiment_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust experiment UUID.']];
}
