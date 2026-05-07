<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

/** List assets for one Sauce Labs VDC job. */
class SauceLabsListJobAssets extends AbstractSauceLabsTool { protected const NAME = 'sauce_labs_list_job_assets'; protected const DESCRIPTION = 'List logs, videos, screenshots, and other assets for one VDC job.'; protected const METHOD = 'listJobAssets'; protected const ARGUMENTS = ['username', 'job_id']; }
