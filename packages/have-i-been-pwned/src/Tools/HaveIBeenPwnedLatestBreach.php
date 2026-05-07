<?php

namespace OpenCompany\Integrations\HaveIBeenPwned\Tools;

/**
 * Retrieve the most recently added public breach.
 */
class HaveIBeenPwnedLatestBreach extends AbstractHaveIBeenPwnedTool
{
    protected const NAME = 'hibp_latest_breach';
    protected const DESCRIPTION = 'Retrieve the most recently added breach based on HIBP AddedDate.';
    protected const METHOD = 'latestBreach';
}
