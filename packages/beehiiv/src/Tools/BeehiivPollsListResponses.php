<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List poll responses OAuth Scope: polls:read.
 *
 * Executes the official beehiiv API operation polls_list_responses.
 */
class BeehiivPollsListResponses extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_polls_list_responses';
}
