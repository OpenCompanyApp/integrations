<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Insert rows into a Braintrust experiment.
 */
class BraintrustInsertExperiment extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_insert_experiment';
    protected const DESCRIPTION = 'Insert rows or spans into a Braintrust experiment.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/experiment/{experiment_id}/insert';
    protected const PATH_PARAMS = ['experiment_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['experiment_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust experiment UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Insert body matching Braintrust experiment insert schema.']];
}
