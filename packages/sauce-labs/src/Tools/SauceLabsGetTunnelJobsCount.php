<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** Get running job count for a Sauce Connect tunnel. */
class SauceLabsGetTunnelJobsCount extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_get_tunnel_jobs_count'; protected const DESCRIPTION = 'Get current running jobs for one Sauce Connect tunnel.'; protected const METHOD = 'getTunnelJobsCount'; protected const ARGUMENTS = ['username', 'tunnel_id']; }
