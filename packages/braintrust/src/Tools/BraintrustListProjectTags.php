<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * List Braintrust project tags.
 */
class BraintrustListProjectTags extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_list_project_tags';
    protected const DESCRIPTION = 'List Braintrust project tags.';
    protected const PATH = '/v1/project_tag';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional filters and pagination.']];
}
