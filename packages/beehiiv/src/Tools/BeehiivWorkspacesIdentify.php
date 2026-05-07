<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Identify workspace OAuth Scope: identify:read.
 *
 * Executes the official beehiiv API operation workspaces_identify.
 */
class BeehiivWorkspacesIdentify extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_workspaces_identify';
}
