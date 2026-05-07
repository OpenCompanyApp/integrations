<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create a CertExpress invitation.
 *
 * Executes the official Avalara AvaTax REST API operation CreateCertExpressInvitation.
 */
class AvalaraCreateCertExpressInvitation extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_cert_express_invitation';
}