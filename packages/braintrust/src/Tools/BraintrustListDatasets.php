<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * List Braintrust datasets.
 */
class BraintrustListDatasets extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_list_datasets';
    protected const DESCRIPTION = 'List Braintrust datasets. Pass optional filters and pagination in query.';
    protected const PATH = '/v1/dataset';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional filters such as project_id, project_name, name, metadata, limit, or cursor.']];
}
