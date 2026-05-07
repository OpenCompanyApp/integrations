<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * List Braintrust roles.
 */
class BraintrustListRoles extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_list_roles';
    protected const DESCRIPTION = 'List Braintrust access-control roles.';
    protected const PATH = '/v1/role';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional filters and pagination.']];
}
