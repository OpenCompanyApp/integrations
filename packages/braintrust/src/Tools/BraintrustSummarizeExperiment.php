<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Summarize a Braintrust experiment.
 */
class BraintrustSummarizeExperiment extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_summarize_experiment';
    protected const DESCRIPTION = 'Summarize metrics for a Braintrust experiment.';
    protected const PATH = '/v1/experiment/{experiment_id}/summarize';
    protected const PATH_PARAMS = ['experiment_id'];
    protected const PARAMETERS = ['experiment_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust experiment UUID.']];
}
