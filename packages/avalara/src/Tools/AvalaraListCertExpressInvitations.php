<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List CertExpress invitations.
 *
 * Executes the official Avalara AvaTax REST API operation ListCertExpressInvitations.
 */
class AvalaraListCertExpressInvitations extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_cert_express_invitations';
}