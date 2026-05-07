<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported usage of extra parameters for classification of a item..
 *
 * Executes the official Avalara AvaTax REST API operation ListClassificationParametersUsage.
 */
class AvalaraListClassificationParametersUsage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_classification_parameters_usage';
}