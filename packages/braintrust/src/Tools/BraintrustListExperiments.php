<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * List Braintrust experiments.
 */
class BraintrustListExperiments extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_list_experiments';
    protected const DESCRIPTION = 'List Braintrust experiments. Metadata filters may be passed as an object in query.metadata.';
    protected const PATH = '/v1/experiment';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional filters such as project_id, project_name, name, metadata, limit, or cursor.']];
}
