<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Fetch rows from a Braintrust experiment.
 */
class BraintrustFetchExperiment extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_fetch_experiment';
    protected const DESCRIPTION = 'Fetch rows or spans from a Braintrust experiment.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/experiment/{experiment_id}/fetch';
    protected const PATH_PARAMS = ['experiment_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['experiment_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust experiment UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Fetch body with filters, cursor, limit, or ids.']];
}
