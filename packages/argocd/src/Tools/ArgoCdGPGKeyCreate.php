<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

/**
 * Execute the Create one or more GPG public keys in the server's configuration Argo CD API operation.
 */
class ArgoCdGPGKeyCreate extends AbstractArgoCdOperationTool
{
    protected const TOOL_NAME = 'argocd_g_p_g_key_create';
}
