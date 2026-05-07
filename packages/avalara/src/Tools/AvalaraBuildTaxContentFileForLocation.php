<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Build a tax content file for a single location.
 *
 * Executes the official Avalara AvaTax REST API operation BuildTaxContentFileForLocation.
 */
class AvalaraBuildTaxContentFileForLocation extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_build_tax_content_file_for_location';
}