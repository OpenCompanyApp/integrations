<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the list of all valid unit of basis.
 *
 * Executes the official Avalara AvaTax REST API operation ListAllUnitOfBasis.
 */
class AvalaraListAllUnitOfBasis extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_all_unit_of_basis';
}