<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List certificate attributes used by a company.
 *
 * Executes the official Avalara AvaTax REST API operation ListCertificateAttributes.
 */
class AvalaraListCertificateAttributes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_certificate_attributes';
}