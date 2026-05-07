<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * List Braintrust groups.
 */
class BraintrustListGroups extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_list_groups';
    protected const DESCRIPTION = 'List Braintrust access-control groups.';
    protected const PATH = '/v1/group';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional filters and pagination.']];
}
