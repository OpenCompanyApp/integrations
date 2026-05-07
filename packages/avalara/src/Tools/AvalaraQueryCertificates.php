<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all certificates for a company.
 *
 * Executes the official Avalara AvaTax REST API operation QueryCertificates.
 */
class AvalaraQueryCertificates extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_certificates';
}