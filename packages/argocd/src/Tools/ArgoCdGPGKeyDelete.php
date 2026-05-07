<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the Delete specified GPG public key from the server's configuration Argo CD API operation.
 */
class ArgoCdGPGKeyDelete extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_g_p_g_key_delete';
}
