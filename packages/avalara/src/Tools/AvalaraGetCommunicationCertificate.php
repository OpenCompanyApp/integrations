<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single communication certificate..
 *
 * Executes the official Avalara AvaTax REST API operation GetCommunicationCertificate.
 */
class AvalaraGetCommunicationCertificate extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_communication_certificate';
}