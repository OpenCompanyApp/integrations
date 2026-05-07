<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * List Braintrust projects visible to the API key.
 */
class BraintrustListProjects extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_list_projects';
    protected const DESCRIPTION = 'List Braintrust projects. Pass optional filters and pagination in query.';
    protected const PATH = '/v1/project';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional Braintrust list query parameters such as limit, starting_after, project_name, org_name, or slug.']];
}
