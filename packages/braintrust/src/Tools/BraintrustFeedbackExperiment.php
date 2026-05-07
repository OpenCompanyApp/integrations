<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Record feedback on Braintrust experiment rows.
 */
class BraintrustFeedbackExperiment extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_feedback_experiment';
    protected const DESCRIPTION = 'Record feedback for rows in a Braintrust experiment.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/experiment/{experiment_id}/feedback';
    protected const PATH_PARAMS = ['experiment_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['experiment_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust experiment UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Feedback body matching Braintrust feedback schema.']];
}
