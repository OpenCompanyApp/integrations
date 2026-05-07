<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported subscription (ServiceTypes).
 *
 * Executes the official Avalara AvaTax REST API operation ListServiceTypes.
 */
class AvalaraListServiceTypes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_service_types';
}