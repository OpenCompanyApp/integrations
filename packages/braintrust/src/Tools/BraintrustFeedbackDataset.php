<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Record feedback on Braintrust dataset rows.
 */
class BraintrustFeedbackDataset extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_feedback_dataset';
    protected const DESCRIPTION = 'Record feedback for rows in a Braintrust dataset.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/dataset/{dataset_id}/feedback';
    protected const PATH_PARAMS = ['dataset_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['dataset_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust dataset UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Feedback body matching Braintrust feedback schema.']];
}
