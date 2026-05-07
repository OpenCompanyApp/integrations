<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Query Braintrust data with BTQL.
 */
class BraintrustQueryBtql extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_query_btql';
    protected const DESCRIPTION = 'Run a Braintrust SQL query against logs, experiments, or datasets. Use fmt=json for agent-readable output.';
    protected const METHOD = 'POST';
    protected const PATH = '/btql';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'BTQL body, for example {"query":"SELECT * FROM project_logs(\\\"project-id\\\") LIMIT 10","fmt":"json"}.']];
}
