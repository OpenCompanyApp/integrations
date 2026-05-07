<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve geolocation information for a specified US or Canadian address.
 *
 * Executes the official Avalara AvaTax REST API operation ResolveAddress.
 */
class AvalaraResolveAddress extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_resolve_address';
}