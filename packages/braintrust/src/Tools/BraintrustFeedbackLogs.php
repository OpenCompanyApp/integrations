<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Record feedback on project log rows.
 */
class BraintrustFeedbackLogs extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_feedback_logs';
    protected const DESCRIPTION = 'Record feedback for project log rows.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/project_logs/{project_id}/feedback';
    protected const PATH_PARAMS = ['project_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['project_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust project UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Feedback body matching Braintrust feedback schema.']];
}
