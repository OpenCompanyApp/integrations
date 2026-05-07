<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get domain control verification by domainControlVerificationId.
 *
 * Executes the official Avalara AvaTax REST API operation GetDcvById.
 */
class AvalaraGetDcvById extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_dcv_by_id';
}