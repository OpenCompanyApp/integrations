<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get publications by subscription email OAuth Scope: publications:read.
 *
 * Executes the official beehiiv API operation workspaces_publications-by-subscription-email.
 */
class BeehiivWorkspacesPublicationsBySubscriptionEmail extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_workspaces_publications_by_subscription_email';
}
