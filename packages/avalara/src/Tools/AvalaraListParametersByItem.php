<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the parameters by companyCode and itemCode..
 *
 * Executes the official Avalara AvaTax REST API operation ListParametersByItem.
 */
class AvalaraListParametersByItem extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_parameters_by_item';
}