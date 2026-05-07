<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of communications transaction/service type pairs.
 *
 * Executes the official Avalara AvaTax REST API operation ListCommunicationsTSPairs.
 */
class AvalaraListCommunicationsTSPairs extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_communications_ts_pairs';
}