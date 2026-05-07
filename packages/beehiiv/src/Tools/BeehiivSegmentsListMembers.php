<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List segment subscribers OAuth Scope: segments:read.
 *
 * Executes the official beehiiv API operation segments_list_members.
 */
class BeehiivSegmentsListMembers extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_segments_list_members';
}
