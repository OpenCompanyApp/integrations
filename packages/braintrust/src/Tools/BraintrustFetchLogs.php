<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Fetch project log events from Braintrust.
 */
class BraintrustFetchLogs extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_fetch_logs';
    protected const DESCRIPTION = 'Fetch project log rows. Use body for POST filters or query for simple GET-style filters.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/project_logs/{project_id}/fetch';
    protected const PATH_PARAMS = ['project_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['project_id' => ['type' => 'string', 'required' => true, 'description' => 'Braintrust project UUID.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Fetch request body with filters, cursor, limit, or ids.']];
}
