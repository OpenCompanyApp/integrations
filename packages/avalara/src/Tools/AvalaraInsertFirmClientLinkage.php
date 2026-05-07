<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Insert a full FirmClientLinkage record.
 *
 * Executes the official Avalara AvaTax REST API operation InsertFirmClientLinkage.
 */
class AvalaraInsertFirmClientLinkage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_insert_firm_client_linkage';
}