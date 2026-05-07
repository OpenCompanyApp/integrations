<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all users.
 *
 * Executes the official Avalara AvaTax REST API operation QueryUsers.
 */
class AvalaraQueryUsers extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_users';
}