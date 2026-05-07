<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * List Braintrust organizations.
 */
class BraintrustListOrganizations extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_list_organizations';
    protected const DESCRIPTION = 'List Braintrust organizations visible to the API key.';
    protected const PATH = '/v1/organization';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional filters and pagination.']];
}
