<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of communications service types.
 *
 * Executes the official Avalara AvaTax REST API operation ListCommunicationsServiceTypes.
 */
class AvalaraListCommunicationsServiceTypes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_communications_service_types';
}