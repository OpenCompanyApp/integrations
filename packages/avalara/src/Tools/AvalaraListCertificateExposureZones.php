<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List certificate exposure zones used by a company.
 *
 * Executes the official Avalara AvaTax REST API operation ListCertificateExposureZones.
 */
class AvalaraListCertificateExposureZones extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_certificate_exposure_zones';
}