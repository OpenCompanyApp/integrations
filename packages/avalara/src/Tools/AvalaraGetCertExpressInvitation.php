<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single CertExpress invitation.
 *
 * Executes the official Avalara AvaTax REST API operation GetCertExpressInvitation.
 */
class AvalaraGetCertExpressInvitation extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_cert_express_invitation';
}