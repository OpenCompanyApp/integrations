<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Delete a Braintrust experiment.
 */
class BraintrustDeleteExperiment extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_delete_experiment';
    protected const DESCRIPTION = 'Delete a Braintrust experiment by experiment_id.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/experiment/{experiment_id}';
    protected const PATH_PARAMS = ['experiment_id'];
    protected const PARAMETERS = ['experiment_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust experiment UUID.']];
}
