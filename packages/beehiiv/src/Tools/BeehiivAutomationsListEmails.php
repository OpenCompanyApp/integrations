<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List automation emails.
 *
 * Executes the official beehiiv API operation automations_listEmails.
 */
class BeehiivAutomationsListEmails extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_automations_list_emails';
}
