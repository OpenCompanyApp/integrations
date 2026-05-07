<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Creates nexus for a list of addresses..
 *
 * Executes the official Avalara AvaTax REST API operation DeclareNexusByAddress.
 */
class AvalaraDeclareNexusByAddress extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_declare_nexus_by_address';
}