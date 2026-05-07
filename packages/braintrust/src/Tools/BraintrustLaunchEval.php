<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Launch a Braintrust eval.
 */
class BraintrustLaunchEval extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_launch_eval';
    protected const DESCRIPTION = 'Launch a Braintrust eval using the official /v1/eval request body.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/eval';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Eval launch body with project, data, task, scores, and metadata fields as supported by Braintrust.']];
}
