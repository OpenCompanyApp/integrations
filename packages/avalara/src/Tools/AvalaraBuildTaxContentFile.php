<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Build a multi-location tax content file.
 *
 * Executes the official Avalara AvaTax REST API operation BuildTaxContentFile.
 */
class AvalaraBuildTaxContentFile extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_build_tax_content_file';
}