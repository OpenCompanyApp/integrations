<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * List Braintrust users.
 */
class BraintrustListUsers extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_list_users';
    protected const DESCRIPTION = 'List Braintrust users visible to the API key.';
    protected const PATH = '/v1/user';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional filters and pagination.']];
}
