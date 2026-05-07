<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List segment subscriber IDs OAuth Scope: segments:read.
 *
 * Executes the official beehiiv API operation segments_expand_results.
 */
class BeehiivSegmentsExpandResults extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_segments_expand_results';
}
