<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the Delete the certificates that match the RepositoryCertificateQuery Argo CD API operation.
 */
class ArgoCdCertificateDeleteCertificate extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_certificate_delete_certificate';
}
