<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get segment OAuth Scope: segments:read.
 *
 * Executes the official beehiiv API operation segments_show.
 */
class BeehiivSegmentsShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_segments_show';
}
