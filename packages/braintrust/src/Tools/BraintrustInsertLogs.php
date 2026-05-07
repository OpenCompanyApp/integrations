<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Insert project log events into Braintrust.
 */
class BraintrustInsertLogs extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_insert_logs';
    protected const DESCRIPTION = 'Insert events into project logs for a Braintrust project.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/project_logs/{project_id}/insert';
    protected const PATH_PARAMS = ['project_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['project_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust project UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Insert body with events or rows matching Braintrust logging schema.']];
}
