<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List segments OAuth Scope: segments:read.
 *
 * Executes the official beehiiv API operation segments_index.
 */
class BeehiivSegmentsIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_segments_index';
}
