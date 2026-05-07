<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all communication certificates..
 *
 * Executes the official Avalara AvaTax REST API operation ListCommunicationCertificates.
 */
class AvalaraListCommunicationCertificates extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_communication_certificates';
}