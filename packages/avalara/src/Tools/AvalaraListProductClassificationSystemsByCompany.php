<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all product classification systems available to a company based on its nexus..
 *
 * Executes the official Avalara AvaTax REST API operation ListProductClassificationSystemsByCompany.
 */
class AvalaraListProductClassificationSystemsByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_product_classification_systems_by_company';
}