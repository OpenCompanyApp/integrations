<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** List Sauce Labs VDC jobs. */
class SauceLabsListJobs extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_list_jobs'; protected const DESCRIPTION = 'List Sauce Labs VDC jobs for a username, defaulting to the configured username.'; protected const METHOD = 'listJobs'; protected const ARGUMENTS = ['username']; protected const OPTIONAL = ['username']; protected const USE_QUERY = true; }
